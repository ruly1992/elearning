<?php

namespace Model;

class SentinelPersistence extends \Cartalyst\Sentinel\Persistences\EloquentPersistence
{
	protected $connection = 'user';
}