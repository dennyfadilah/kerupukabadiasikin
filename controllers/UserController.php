<?php

require 'config/config.php';
require_once 'models/UserModel.php';

function users()
{
    global $koneksi;
    $result = getAllUsers();

    if ($result) {
        require_once 'views/users.php';
    } else {
        echo mysqli_error($koneksi);
    }
}

function addDataUser()
{
    $data = [
        'nama_user' => htmlspecialchars($_POST['nama_user']),
        'email' => htmlspecialchars($_POST["email"]),
        'username' => htmlspecialchars($_POST["username"]),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];

    $result = userRegisterCheck($data);

    return $result ? true : false;
}

function editDataUser($id_user)
{
    $data = [
        'id_user' => $id_user,
        'nama_user' => htmlspecialchars($_POST['nama_user']),
        'email' => htmlspecialchars($_POST["email"]),
        'username' => htmlspecialchars($_POST["username"]),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];

    $result = editUser($data);
    return $result ? true : false;
}

function deleteDataUser($id_user)
{
    $result = deleteUser($id_user);
    return $result ? true : false;
}
