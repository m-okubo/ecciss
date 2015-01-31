<?php
namespace ecciss\models;

class LoginModel extends BaseModel implements PublicPage
{
    public function indexAction()
    {
    }

    public function loginAction()
    {
        if ($_POST['login_id'] != 'test') {
            $this->setView('login/index');

            return;
        }
        $_SESSION['login_id'] = $_POST['login_id'];

        $this->redirect('welcome');
    }

    public function getLayout()
    {
        return null;
    }
}