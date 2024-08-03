<?php

namespace Geekbrains\Application1\Controllers;

use Geekbrains\Application1\Render;
use Geekbrains\Application1\Models\User;

class UserController
{

    public function actionIndex()
    {
        $users = User::getAllUsersFromStorage();

        $render = new Render();

        if (!$users) {
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Список пуст или не найден"
                ]
            );
        } else {
            return $render->renderPage(
                'user-index.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'users' => $users
                ]
            );
        }
    }

    public function actionSave()
    {
        $render = new Render();

        $newUserGET = $_GET;
        $newUser = new User($newUserGET['name']);
        $newUser->setBirthdayFromString($newUserGET['birthday']);
        // /user/save/?name=Иван&birthday=05-05-1991
        if ($newUser->addUser($newUserGET)) {
            return $render->renderPage(
                'save-user.twig',
                [
                    'title' => 'Добавление пользователя',
                    'name' => $newUser->getUserName(),
                    'birthday' => $newUserGET['birthday']
                ]
            );
        } else {
            return $render->renderPage(
                'user-empty.twig',
                [
                    'title' => 'Список пользователей в хранилище',
                    'message' => "Ошибка при попытке записи пользователя в файл. Запись не добавлена"
                ]
            );
        }
    }
}
