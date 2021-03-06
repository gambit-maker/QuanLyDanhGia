<?php
// require MySql Connection
require('database/DBController.php');

// require Account Class
require('database/Account.php');

// require PhieuKhaoSat Class
require('database/PhieuKhaoSat.php');

// require LopHocPhan class
require('database/LopHocPhan.php');

//require InfoSmallTable class
require('database/InfoSmallTable.php');

$db = new DBController();
$account = new Account($db);
$phieuKhaoSat = new PhieuKhaoSat($db);
$lopHocPhan = new LopHocPhan($db);
$infoSmallTable = new InfoSmallTable($db);
