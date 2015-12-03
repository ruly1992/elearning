<?php

namespace Library\Sentinel;

use Cartalyst;
use Cartalyst\Sentinel\Persistences\IlluminatePersistenceRepository;

class SentinelBootstrapper extends Cartalyst\Sentinel\Native\SentinelBootstrapper
{
    protected function createPersistence()
    {
        $session = $this->createSession();

        $cookie = $this->createCookie();

        $model = $this->config['persistences']['model'];

        return new IlluminatePersistenceRepository($session, $cookie, $model);
    }
}