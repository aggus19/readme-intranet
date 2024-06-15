<?php
// Actualizar esta informacion unicamente en el div con id "redinfo"
include '../../classes/VPS.php';
$vpsData = new VPS();
echo ' <div id="raminfo" class="text-center text-white fw-bolder fs-4 mb-4 mt-3"> <i class="text-white me-sm-2 fs-sm-2 fa-solid fa-battery-full"></i> Activo desde:  <span class="text-hover-warning"> ' . $vpsData->SystemUptime() . ' </div>	';
