<?php

namespace Library\Media\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
	protected $connection = 'elib';
}