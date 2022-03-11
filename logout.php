<?php
    session_start();
	unset($_SESSION['doc_id']);
	session_destroy();
    header('Location: login.php');
?>