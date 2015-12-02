<?php

namespace Model;

class Throttle extends \Cartalyst\Sentinel\Throttling\EloquentThrottle
{
	protected $connection = 'user';
}