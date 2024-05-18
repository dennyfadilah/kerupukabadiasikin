<?php

require 'config/config.php';

function userLoginCheck($username)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "
    SELECT 
        *
    FROM
        users
    WHERE
        username = '$username'
    ");

    return $result;
}

function userRegisterCheck($data)
{
    global $koneksi;


    $checkUsername = mysqli_query($koneksi, "
    SELECT
        username,
        email
    FROM
        users
    WHERE
        email = '" . $data['email'] . "'
    OR
        username = '" . $data['username'] . "'
    ");

    if ($checkUsername && mysqli_num_rows($checkUsername) > 0) {
        return false; // Username atau email sudah digunakan
    } else {
        // Insert data baru ke dalam database
        $stmt = $koneksi->prepare("INSERT INTO users (nama_user, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $data['nama_user'], $data['email'], $data['username'], $data['password']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}


function getAllUsers()
{
    global $koneksi;

    $result = mysqli_query($koneksi, "SELECT * FROM users");

    return $result;
}

function editUser($data)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "UPDATE users SET nama_user = '$data[nama_user]', email = '$data[email]', username = '$data[username]', password = '$data[password]' WHERE id_user = $data[id_user]");

    return $result;
}

function deleteUser($id_user)
{
    global $koneksi;

    $result = mysqli_query($koneksi, "DELETE FROM users WHERE id_user = $id_user");

    return $result;
}
