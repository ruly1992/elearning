<?php

namespace Library\Config;

use Illuminate\Database\Capsule\Manager as Capsule;

class Config
{
    protected $db;

    public function __construct()
    {
        $this->db = Capsule::connection('portal');
    }

    public function set($key, $value = '')
    {
        if (is_array($key)) {
            foreach ($key as $k => $value) {
                $this->set($k, $value);
            }
        } else {
            $config = $this->get($key);

            if ($config) {
                $this->db->table('settings')
                            ->where('key', $key)
                            ->update(compact('value'));
            } else {
                $this->db->table('settings')
                            ->create(compact('key', 'value'));
            }
        }

        return;
    }

    public function get($key)
    {
        $config = $this->db->table('settings')
                        ->where('key', $key)
                        ->first();

        return $config ? $config->value : '';
    }
}