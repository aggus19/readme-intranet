<?php
include '../../classes/VPS.php';
$vpsData = new VPS();
echo '' . $vpsData->GetDiskSpace() . ' ';
