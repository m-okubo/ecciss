<?php
namespace ecciss\models;

class BaseModel extends \ecciss\Model
{
    public function __construct()
    {
        $this->setLayout('index.phtml');
    }
}
