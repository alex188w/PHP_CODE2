<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Render;
use Geekbrains\Application1\Domain\Models\User;

class UserController
{

    public function actionIndex()
    {
        $render = new Render();
        $users = User::getAllUsersFromStorage();

        if (!$users) {
            return $render->renderPage(
                'users/user-info.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]
            );
        } else {
            return $render->renderPage(
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

            return $render->renderPage(
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

    function actionShow()
    {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
        if (User::exists($id)) {
            $user = User::getUserFromStorageById($id);
            $render = new Render();
            return $render->renderPage(
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
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
        if (User::exists($id)) {
            $user = new User();
            $user->setUserId($_GET['id']);

            $arrayData = [];

            if (isset($_GET['name']))
                $arrayData['user_name'] = $_GET['name'];

            if (isset($_GET['lastname'])) {
                $arrayData['user_lastname'] = $_GET['lastname'];
            }

            $user->updateUser($arrayData);
        } else {
            throw new \Exception("Пользователь не существует");
        }

        $render = new Render();
        return $render->renderPage(
            'users/user-info.twig',
            [
                'title' => 'Пользователь обновлен',
                'message' => "Обновлен пользователь с id = " . $user->getUserId()
            ]
        );
    }

    public function actionDelete(): string
    {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
        if (User::exists($id)) {
            $user = User::getUserFromStorageById($id);
            User::deleteFromStorage($id);

            $render = new Render();

            return $render->renderPage(
                'users/user-info.twig',
                [
                    'title' => 'Удаление пользоателя',
                    'message' => "Пользователь: " . $user . " - удален из хранилища"
                ]
            );
        } else {
            throw new \Exception("Пользователь с таким id не существует");
        }
    }
}
