<?php include_once (__DIR__.'/../../template/header.php');
session_unset();
header('Location: ' . $_SERVER['HTTP_REFERER']);
