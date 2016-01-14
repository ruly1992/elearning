<?php

namespace Library\Pagination;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Pagination\Presenter;
use Illuminate\Pagination\BootstrapThreePresenter;

class BootstrapCustomPresenter extends BootstrapThreePresenter
{
	protected $template;

	public function __construct(Paginator $paginator, $template = null)
	{
		parent::__construct($paginator, null);

		$this->template = $template;
	}

	public function render()
	{
		$paginator 	= $this->paginator;
		$template	= $this->template ?: 'bootstrap';

		ob_start();

		include(__DIR__.'/../../template/pagination_'.$template.'.php');

		return ob_get_clean();
	}
}