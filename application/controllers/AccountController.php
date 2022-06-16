<?php

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{
    public function loginAction()
    {
        $vars['errorText'] = '';

        if ($_SESSION['isAdmin']) {
            $vars['errorText'] .= 'Вы уже авторизованы<br/><br/>';
            $vars['isAdmin'] = true;
        } else {
            if (!empty($_POST)) {
                if (!empty($_POST['login']) && !empty($_POST['password'])) {
                    if ($this->model->login($_POST['login'], $_POST['password'])) {
                        $_SESSION['isAdmin'] = true;
                        header('location: ./');
                        exit;
                    } else {
                        $vars['errorText'] .= 'Логин и пароль неверные<br/><br/>';
                    }
                } else {
                    $vars['errorText'] .= 'Все поля обязательны к заполнению<br/><br/>';
                }
            }
        }

        $this->view->render('Вход', $vars);
    }

    public function logoutAction()
    {
        $_SESSION['isAdmin'] = false;
        header('location: ./');
        exit;
    }
}
