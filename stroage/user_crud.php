<?php


function save_user($mysqli, $name, $email, $password, $role)
{
    $sql = "INSERT INTO `user` (`username`,`email`,`password`,`role`) VALUE ('$name','$email','$password',$role)";
    return $mysqli->query($sql);
}

function get_user_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `user` WHERE `id`=$id";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

function get_user_with_email($mysqli, $email)
{
    $sql = "SELECT * FROM `user` WHERE `email`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

function get_users($mysqli)
{
    $sql = "SELECT * FROM `user`";
    return $mysqli->query($sql);
}
