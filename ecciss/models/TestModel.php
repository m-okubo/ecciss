<?php
namespace ecciss\models;

class TestModel extends Model
{
	public $name;

	public function indexAction()
	{
		$this->name = 'Taro';
	}
}