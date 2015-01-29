<?php
namespace ecciss\models;

class TestModel extends BaseModel
{
    public $name;

    public function indexAction()
    {
        $this->name = 'Taro';
    }
}