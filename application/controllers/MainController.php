<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $sortParams = explode('-', $_GET['sort'], 2);
        $correctSortList = [
            'name',
            'email',
            'done',
        ];
        $order = in_array($sortParams[0], $correctSortList) ? $sortParams[0] : 'id';
        $direction = ($sortParams[1] === 'desc') ? 'DESC' : 'ASC';
        $page = (is_numeric($_GET['page']) && $_GET['page'] > 1) ? (int) ($_GET['page'] - 1) : 0;
        $countOnPage = 3;

        $result = $this->model->getTasks($order, $direction, $page, $countOnPage);
        $vars = [
            'tasks' => $result['tasks'],
            'currentPage' => $page + 1,
            'totalPages' => ceil($result['totalPages'] / $countOnPage),
            'disabled' => $_SESSION['isAdmin'] ? '' : ' disabled',
            'flashMessage' => $_SESSION['flashMessage'],
        ];

        $_SESSION['flashMessage'] = '';

        $this->view->render('Главная страница', $vars);
    }

    public function newAction()
    {
        $vars['errorText'] = '';

        if (!empty($_POST)) {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['text'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $vars['errorText'] .= 'Email не валиден<br/><br/>';
                } else {
                    if ($this->model->newTask($_POST['name'], $_POST['email'], $_POST['text'])) {
                        $_SESSION['flashMessage'] = 'Задача успешно добавлена<br/><br/>';
                        header('location: ./');
                        exit;
                    }
                }
            } else {
                $vars['errorText'] .= 'Все поля обязательны к заполнению<br/><br/>';
            }
        }

        $this->view->render('Создать задачу', $vars);
    }

    public function changeStatusAction()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        if ($_SESSION['isAdmin']) {
            if (!empty($post['task']) && !empty($post['text']) && ($post['done'] === true || $post['done'] === false)) {
                $this->model->changeStatus((int) $post['task'], $post['text'], (int) $post['done']);
            }
        } else {
            echo 'Ошибка авторизации. Войдите под своим логином на странице "Администратор".';
        }
    }
}
