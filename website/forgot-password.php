<?php
include "classes/Database.php";
include "classes/User.php";
include "classes/AuditLogs.php";
include "classes/Time.php";
include "classes/Discord.php";
include "classes/Messages.php";

$updatedPwMsg = Messages::PasswordUpdated();
$notUpdatedPwMsg = Messages::PasswordNotUpdated();
$status = $_GET['emailInfo'];

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>


<body id="kt_body" class="app-blank">
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
				<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<?php
					if ($status == '2') {
						echo $notUpdatedPwMsg;
					} else if ($status == '1'  && $_GET['newPass']) {
						echo $updatedPwMsg;
					}
					?>
					<div class="w-lg-500px p-10">
						<form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="emailData.php" method="POST">
							<div class="text-center mb-10">
								<h1 class="text-dark fw-bolder mb-3">Restablecer contraseña</h1>
								<div class="text-gray-500 fw-semibold fs-6">Introduce tu correo electrónico para restablecer tu contraseña</div>
							</div>
							<div class="fv-row mb-8 fv-plugins-icon-container">
								<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="submit" name="submit_email" id="kt_password_reset_submit" class="btn btn-sm btn-primary me-4">
									Restablecer contraseña
								</button>
								<a href="sign-in" class="btn btn-sm btn-light">Volver</a>
							</div>
						</form>
					</div>
				</div>
				<div class="d-flex flex-center flex-wrap px-5">
					<div class="d-flex fw-semibold text-primary fs-base">
						<a href="sign-in" class="text-muted text-hover-primary px-2">Iniciar sesion</a>
						<a href="mailto:agras@agrasystems.us" class="text-muted text-hover-primary px-2">Contacto</a>
					</div>
				</div>
			</div>
			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2">
				<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
					<img alt="Logo" src="assets/media/illustrations/dozzy-1/4-dark.png" class="h-60px h-lg-500px" data-stories_space_upload_el_handled="1">
				</div>
			</div>
		</div>
	</div>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/custom/authentication/reset-password/reset-password.js"></script>
	<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
		<defs id="SvgjsDefs1002"></defs>
		<polyline id="SvgjsPolyline1003" points="0,0"></polyline>
		<path id="SvgjsPath1004" d="M0 0 "></path>
	</svg>
</body>
<script type="text/javascript">
	// Limitar el inout con id 'nomLibro' a 10 caracteres, si se pasa de 10 caracteres, se muestra un alert
	$('#email').on('input', function() {
		if ($(this).val().length > 50) {
			$(this).val($(this).val().slice(0, 50));
			alert("El correo ingresado no es");
		}
	});
</script>

</html>