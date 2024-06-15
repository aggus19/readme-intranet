<?php
// Actualizar esta informacion unicamente en el div con id "redinfo"
include '../../classes/VPS.php';
$vpsData = new VPS();
echo ' <div id="redinfo" class="text-white fw-bolder"> <i style="color: white; font-size: 23px;" class="me-sm-2 bi bi-wifi"> </i> Internet: ' . $vpsData->GetOutgoingTraffic() . ' </div>	';
