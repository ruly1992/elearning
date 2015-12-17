<?php

namespace Model;

class Reminder extends \Cartalyst\Sentinel\Reminders\EloquentReminder
{
	protected $connection = 'user';
}