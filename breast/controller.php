<?php
session_start();
require("dbcon.php");
require("fuctions.php");
if (isset($_GET['sublog'])){signup();}
// if (!isset( $_SESSION['username'])) { header("location:index.php"); }






?>