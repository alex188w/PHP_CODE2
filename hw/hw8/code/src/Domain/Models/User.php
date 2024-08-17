<?php

namespace Geekbrains\Application1\Domain\Models;

use Geekbrains\Application1\Application\Application;
use Geekbrains\Application1\Infrastructure\Storage;

class User
{

    private ?int $idUser;
    private ?string $userName;
    private ?string $userLastName;
    private ?int $userBirthday;
    private ?string $login;
    private ?string $password;

    // private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(
        int $idUser = null,
        string $name = null,
        string $lastName = null,
        int $birthday = null,
        string $login = null,
        string $password = null
    ) {
        $this->idUser = $idUser;
        $this->userName = $name;
        $this->userLastName = $lastName;
        $this->userBirthday = $birthday;
        $this->login = $login;
        $this->password = $password;
    }

    public function getUserId(): ?int
    {
        return $this->idUser;
    }

    public function setUserId(int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function getUserBirthday(): ?int
    {
        return $this->userBirthday;
    }

    public function setBirthdayFromString(string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public function getUserLogin(): string
    {
        return $this->login;
    }

    public function __toString()
    {
        return 'Полное имя: ' . $this->getUserName() . ' ' . $this->getUserLastName() . ' день рождения: ' . date('d.m.Y', $this->getUserBirthday());
    }

    public static function getAllUsersFromStorage(): array
    {
        $sql = "SELECT * FROM users";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();
        $result = $handler->fetchAll();

        $users = [];

        foreach ($result as $item) {
            $user = new User($item['id_user'], $item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp'], $item['login']);
            $users[] = $user;
        }

        return $users;
    }

    public static function validateRequestData(): bool
    {
        $result = true;

        if (!(
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['lastname']) && !empty($_POST['lastname']) &&
            isset($_POST['birthday']) && !empty($_POST['birthday']) &&
            isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['password']) && !empty($_POST['password'])
        )) {
            $result = false;
        }

        if (preg_match('/<([^>]+)>/', $_POST['name']) || preg_match('/<([^>]+)>/', $_POST['lastname'])) {
            $result =  false;
        }

        if (!preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])) {
            $result =  false;
        }

        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $result = false;
        }

        return $result;
    }

    public function setParamsFromRequestData(): void
    {
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->login = htmlspecialchars($_POST['login']);
        $this->setBirthdayFromString($_POST['birthday']);
    }

    public function saveToStorage()
    {
        $sql = "INSERT INTO users(login, user_name, user_lastname, user_birthday_timestamp) VALUES (:user_login, :user_name, :user_lastname, :user_birthday)";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'user_login' => $this->login,
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday
        ]);
    }

    public static function exists(int $id): bool
    {
        $sql = "SELECT count(id_user) as user_count FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute([
            'id_user' => $id
        ]);

        $result = $handler->fetchAll();

        if (count($result) > 0 && $result[0]['user_count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserFromStorageById(int $id): User
    {
        $sql = "SELECT * FROM users WHERE id_user = :id";
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $id]);
        $result = $handler->fetch();

        return new User(
            $result['id_user'],           
            $result['user_name'],
            $result['user_lastname'],
            $result['user_birthday_timestamp'],
            $result['login']
            // $result['password']
        );
    }

    public function updateUser(array $userDataArray): void
    {
        $sql = "UPDATE users SET ";

        $counter = 0;
        foreach ($userDataArray as $key => $value) {
            $sql .= $key . " = :" . $key;

            if ($counter != count($userDataArray) - 1) {
                $sql .= ",";
            }

            $counter++;
        }

        $sql .= " WHERE id_user = " . $this->getUserId();
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute($userDataArray);
    }

    public static function deleteFromStorage(int $user_id): void
    {
        $sql = "DELETE FROM users WHERE id_user = :id_user";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id_user' => $user_id]);
    }

    public static function destroyToken(): array
    {
        $userSql = "UPDATE users SET token = :token WHERE id_user = :id";

        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['token' => md5(bin2hex(random_bytes(16))), 'id' => $_SESSION['auth']['id_user']]);
        $result = $handler->fetchAll();

        return $result[0] ?? [];
    }

    public static function verifyToken(string $token): array
    {
        $userSql = "SELECT * FROM users WHERE token = :token";
        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['token' => $token]);
        $result = $handler->fetchAll();

        return $result[0] ?? [];
    }

    public static function setToken(int $userID, string $token): void
    {
        $userSql = "UPDATE users SET token = :token WHERE id_user = :id";

        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['id' => $userID, 'token' => $token]);

        setcookie(
            'auth_token',
            $token,
            time() + 60 * 60 * 24 * 30,
            '/'
        );
    }
}
