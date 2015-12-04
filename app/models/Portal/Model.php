<?php

namespace Model\Portal;

use Model\Model as BaseModel;

abstract class Model extends BaseModel
{
    protected $connection = 'portal';
}