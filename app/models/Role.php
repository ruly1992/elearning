<?php

namespace Model;

class Role extends \Cartalyst\Sentinel\Roles\EloquentRole
{
	protected $connection = 'user';
}