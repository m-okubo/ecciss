<?php
namespace ecciss\models;

class LoginModel extends BaseModel implements PublicPage
{
    public function indexAction()
    {
    }

    public function loginAction()
    {
        $isValid = true;

        if (empty($_POST['login_id'])) {
            $parameters = array($this->labels['login_id']);
            $this->errors['login_id'] = $this->getMessage('required', $parameters);

            $isValid = false;
        }

        if (empty($_POST['password'])) {
            $parameters = array($this->labels['password']);
            $this->errors['password'] = $this->getMessage('required', $parameters);

            $isValid = false;
        }

        if (!$isValid) {
            $this->setView('login/index');

            return;
        }

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