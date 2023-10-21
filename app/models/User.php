<?php

declare(strict_types=1);

namespace app\models;

class User extends Model {

    public string $table = 'users';

    public readonly int $id;
    public readonly string $email;
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $avatar;
    public readonly string $password;
}
?>