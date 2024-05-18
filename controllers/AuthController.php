<?php

require_once 'models/UserModel.php';
require 'config/config.php';

function login()
{
    require_once 'views/login.php';
}

function loginCheck($username, $password)
{

    global $dir;

    $result = userLoginCheck($username);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $rowPassword = $row["password"];

        // Memeriksa apakah password yang dimasukkan cocok dengan hash yang disimpan di database
        if (password_verify($password, $rowPassword)) {
            $_SESSION['login'] = true;
            $_SESSION['nama_user'] = $row['nama_user'];
            header('Location: ' . $dir);
            exit;
        } else {
            // Password salah
            $_SESSION['error_message'] = "Username atau Password salah!";
            header('Location: ' . $dir . '/login');
            exit;
        }
    } else {
        // Username tidak ditemukan
        $_SESSION['error_message'] = "Username atau Password salah!";
        header('Location: ' . $dir . '/login');
        exit;
    }
}

function register()
{
    require_once 'views/register.php';
}

function registerCheck()
{
    global $dir;

    $data = [
        'nama_user' => htmlspecialchars($_POST['nama_user']),
        'email' => htmlspecialchars($_POST["email"]),
        'username' => htmlspecialchars($_POST["username"]),
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ];

    $result = userRegisterCheck($data);

    if ($result) {
        header('Location: ' . $dir . '/login');
        exit;
    } else {
        $_SESSION['error_message'] = "Email atau Username sudah terdaftar!";
        header('Location: ' . $dir . '/register');
        exit;
    }
}

function logout()
{
    session_destroy();
    echo '<script>window.location.replace("login");</script>';
    exit;
}
