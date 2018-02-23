<?php include_once ('template/header.php');
session_unset();
header('Location: ' . $_SERVER['HTTP_REFERER']);
