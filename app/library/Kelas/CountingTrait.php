<?php

namespace Library\Kelas;

trait CountingTrait
{
	public function countRequirements()
	{
		return $this->model->requirements->count();
	}

	public function countMemberActive()
	{
		return $this->model->memberActive->count();
	}

	public function countMemberPending()
	{
		return $this->model->memberPending->count();
	}

	public function countMemberFinished()
	{
		return $this->model->memberFinished->count();
	}

	public function countMembers()
	{
		return $this->model->members->count();
	}
}