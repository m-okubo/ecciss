<?php
namespace ecciss\models;

class BaseModel extends \ecciss\Model
{
    public function __construct()
    {
        parent::__construct();

        // Disable cache
        session_cache_limiter('nocache');
        // Start session
        session_start();

        if (!($this instanceof PublicPage)) {
            if (empty($_SESSION['login_id'])) {
                $this->redirect('login');
            }
        }

        $this->setLayout('index.phtml');
    }

    public function logoutAction()
    {
        $_SESSION = array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        session_destroy();

        $this->redirect('login');
    }
}
