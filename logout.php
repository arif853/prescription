<?php

session_start();

if(isset($_SESSION['user_name']))
{
	unset($_SESSION['user_name']);
	die;
}

header("Location: login.php");
die;