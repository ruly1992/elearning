<?php

namespace Model\Portal;

use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;
use Symfony\Component\HttpFoundation\Request;

class Page extends Model
{
	protected $guarded = [];
	public $timestamps = false;
}