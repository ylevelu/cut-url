<?php

include_once "config.php";
include_once "functions.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../profile.php");
    die;
}

if ($_GET['user_id'] == $_SESSION['user']['id']){
    delete_link($_GET['id']);
    $_SESSION['success'] = "Ссылка успешно удалена!";
    header('Location: ../profile.php');
    die;
}

$_SESSION['error'] = "Ссылка Вам не принадлежит";
header('Location: ../profile.php');
die;
