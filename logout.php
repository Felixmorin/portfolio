<?php
include 'acces.php';

session_start();
session_destroy();
header("location: login.php");
?>