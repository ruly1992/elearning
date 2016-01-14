<?php

namespace Model;

class Activation extends \Cartalyst\Sentinel\Activations\EloquentActivation
{
    protected $connection = 'user';
}