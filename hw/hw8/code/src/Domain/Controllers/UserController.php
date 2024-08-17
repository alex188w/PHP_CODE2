<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Application\Auth;
use Geekbrains\Application1\Domain\Models\User;

class UserController extends AbstractController
{
    protected array $actionsPermissions = [
        'actionHash' => ['admin', 'some'],
        'actionIndex' => ['admin', 'some'],
        'actionLogout' => ['admin', 'some'],
        'actionSave' => ['admin'],
        'actionEdit' => ['admin'],
        'actionShow' => ['admin'],        
        'actionDellete' => ['admin']
    ];

    public function actionIndex(): string
    {
        $users = User::getAllUsersFromStorage();

        $render = new Render();
        if (!$users) {
            return $render->renderPage(
                'users/user-info.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]
            );
        } else {
            return $render->renderPageWithForm(
                'pages/user-index.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]
            );
        }
    }

    public function actionSave(): string
    {
        if (User::validateRequestData()) {
            $user = new User();
            $user->setParamsFromRequestData();
            $user->saveToStorage();

            $render = new Render();
            return $render->renderPageWithForm(
                'users/user-info.twig',
                [
                    'title' => 'Пользователь создан',
                    'message' => "Пользователь: " . $user->getUserName() . " " . $user->getUserLastName() . " - добавлен в хранилище"
                ]
            );
        } else {
            throw new \Exception("Переданные данные некорректны");
        }
    }

    public function actionEdit(): string
    {
        $render = new Render();
        $action = '/user/save';
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
            $action = '/user/update';
            $userData = User::getUserFromStorageById($userId);
        }
        return $render->renderPageWithForm(
            'users/user-form.twig',
            [
                'title' => 'Форма создания/редактирования пользователя',
                // 'user_data' => $userData ?? [],
                'action' => $action,
                'id_user' => $userData?->getUserId() ?? '',            
                'user_name' => $userData?->getUserName() ?? '',
                'user_lastname' => $userData?->getUserLastName() ?? '',
                'user_birthday' => $userData?->getUserBirthday() ?? '',
                'user_login' => $userData?->getUserLogin() ?? ''
            ]
        );
    }

    public function actionAuth(): string
    {
        $render = new Render();

        return $render->renderPageWithForm(
            'users/user-auth.twig',
            [
                'title' => 'Форма логина'
            ]
        );
    }

    public function actionHash(): string
    {
        return Auth::getPasswordHash($_GET['pass_string']);
    }

    public function actionLogin(): string
    {
        $result = false;

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $result = Application::$auth->proceedAuth($_POST['login'], $_POST['password']);
        }

        if (!$result) {
            if ($_POST['login'] == "") {
                $messege_err = "Ошибка. Заполните поле логин!";
            } elseif ($_POST['password'] == "1") {
                $messege_err = "Ошибка. Заполните поле пароль!";
            } else {
                $messege_err = "Ошибка. Введены некорректные логин-пароль!";
            }
            $render = new Render();
            return $render->renderPageWithForm(
                'users/user-auth.twig',
                [
                    'title' => 'Форма логина',
                    'auth_success' => false,
                    'auth_error' => $messege_err
                ]
            );
        } else {
            header('Location: /');
            return "";
        }
    }

    public function actionLogout(): void
    {
        session_destroy();
        unset($_SESSION['user_name']);
        header("Location: /");
        die();
    }

    public function actionShow(): string
    {
        $id = $_GET['user_id'];       
        if (User::exists($id)) {
            $user = User::getUserFromStorageById($id);
            $render = new Render();
            return $render->renderPageWithForm(
                'users/user-info.twig',
                [
                    'title' => 'Информация о пользователе',
                    'message' => 'Информация о выбранном пользователе: ' . $user
                ]
            );            
        } else {
            throw new \Exception("Пользователь не существует");
        }        
    }

    public function actionUpdate(): string
    {
        $id = $_POST['user_id'];
        echo "id = ", $id;
        if (User::exists($id)) {
            $user = User::getUserFromStorageById($id);
            $user->setUserId($id);

            $arrayData = [];
            if (isset($_POST['name']))
                $arrayData['user_name'] = $_POST['name'];

            if (isset($_POST['lastname'])) {
                $arrayData['user_lastname'] = $_POST['lastname'];
            }

            if (isset($_POST['login'])) {
                $arrayData['login'] = $_POST['login'];
            }
            $user->updateUser($arrayData);
        } else {
            throw new \Exception("Пользователь не существует");
        }

        $render = new Render();
        return $render->renderPageWithForm(
            'users/user-info.twig',
            [
                'title' => 'Пользователь обновлен',
                'message' => "Обновлен пользователь с id = " . $user->getUserId()
            ]
        );
    }

    public function actionDelete(): string
    {
        $id = $_GET['user_id'];
        if (User::exists($id)) {
            $user = User::getUserFromStorageById($id);
            User::deleteFromStorage($id);

            $render = new Render();
            return $render->renderPageWithForm(
                'users/user-info.twig',
                [
                    'title' => 'Удаление пользователя',
                    'message' => "Пользователь: " .  $user . " - удален из хранилища"
                ]
            );
        } else {
            throw new \Exception("Пользователь не существует");
        }
    }
}
