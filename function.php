<?php
// require MySql Connection
require('database/DBController.php');

// require Account Class
require('database/Account.php');

// require PhieuKhaoSat Class
require('database/PhieuKhaoSat.php');

$db = new DBController();
$account = new Account($db);
$phieuKhaoSat = new PhieuKhaoSat($db);
