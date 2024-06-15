<?php
include '../../classes/Database.php';
include '../../classes/Time.php';
include '../../classes/User.php';
$totalUsers = User::GetAdminsCount();
echo '' .  $totalUsers . '';
