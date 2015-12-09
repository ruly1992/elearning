<?php

namespace Model\Forum;

use Model\Model as BaseModel;

abstract class Model extends BaseModel
{
	protected $connection = 'forum';
}