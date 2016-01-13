<?php

namespace Model;

use Cartalyst\Sentinel\Users\UserInterface;
use Carbon\Carbon;

class Reminder extends \Cartalyst\Sentinel\Reminders\EloquentReminder
{
	protected $connection = 'user';
	protected $expires = 259200;

    public function createModel(array $data = [])
    {
        $class = Reminder::class;

        return new $class($data);
    }

	public function createCode(UserInterface $user)
	{
        $reminder = $this;

        $code = $this->generateReminderCode();

        $reminder->fill([
            'code'      => $code,
            'completed' => false,
        ]);

        $reminder->user_id = $user->id;

        $reminder->save();

        return $reminder;
	}

    /**
     * {@inheritDoc}
     */
    public function exists(UserInterface $user, $code = null)
    {
        $expires = $this->expires();

        $reminder = $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $user->getUserId())
            ->where('completed', false)
            ->where('created_at', '>', $expires);

        if ($code) {
            $reminder->where('code', $code);
        }

        return $reminder->first() ?: false;
    }

    /**
     * {@inheritDoc}
     */
    public function complete(UserInterface $user, $code, $password)
    {
        $expires = $this->expires();

        $reminder = $this
            ->createModel()
            ->newQuery()
            ->where('user_id', $user->getUserId())
            ->where('code', $code)
            ->where('completed', false)
            ->where('created_at', '>', $expires)
            ->first();

        if ($reminder === null) {
            return false;
        }

        $credentials = compact('password');

        $valid = $this->validateUser($credentials, $user->getUserId());

        if ($valid === false) {
            return false;
        }

        sentinel()->update($user->getUserId(), $credentials);

        $reminder->fill([
            'completed'    => true,
            'completed_at' => Carbon::now(),
        ]);

        $reminder->save();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function removeExpired()
    {
        $expires = $this->expires();

        return $this
            ->createModel()
            ->newQuery()
            ->where('completed', false)
            ->where('created_at', '<', $expires)
            ->delete();
    }

    /**
     * Returns the expiration date.
     *
     * @return \Carbon\Carbon
     */
    protected function expires()
    {
        return Carbon::now()->subSeconds($this->expires);
    }


    protected function generateReminderCode()
    {
        return str_random(32);
    }

    protected function validateUser(array $credentials, $id = null)
    {
        $instance = new User;

        $loginNames = $instance->getLoginNames();

        // We will simply parse credentials which checks logins and passwords
        list($logins, $password, $credentials) = $this->parseCredentials($credentials, $loginNames);

        if ($id === null) {
            if (empty($logins)) {
                throw new InvalidArgumentException('No [login] credential was passed.');
            }

            if (empty($password)) {
                throw new InvalidArgumentException('You have not passed a [password].');
            }
        }

        return true;
    }

    protected function parseCredentials(array $credentials, array $loginNames)
    {
        if (isset($credentials['password'])) {
            $password = $credentials['password'];

            unset($credentials['password']);
        } else {
            $password = null;
        }

        $passedNames = array_intersect_key($credentials, array_flip($loginNames));

        if (count($passedNames) > 0) {
            $logins = [];

            foreach ($passedNames as $name => $value) {
                $logins[$name] = $credentials[$name];
                unset($credentials[$name]);
            }
        } elseif (isset($credentials['login'])) {
            $logins = $credentials['login'];
            unset($credentials['login']);
        } else {
            $logins = [];
        }

        return [$logins, $password, $credentials];
    }
}