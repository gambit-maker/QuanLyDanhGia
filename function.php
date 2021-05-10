<?php
// require MySql Connection
require('database/DBController.php');

// require Account Class
require('database/Account.php');

$db = new DBController();
$account = new Account($db);
