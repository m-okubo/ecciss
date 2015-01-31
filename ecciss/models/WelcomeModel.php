<?php
namespace ecciss\models;

class WelcomeModel extends BaseModel
{
    public $name;

    public function indexAction()
    {
        $this->name = $_SESSION['login_id'];
    }
}