<?php
include "classes/Database.php";
include "classes/User.php";
include "classes/AuditLogs.php";
include "classes/Time.php";
include "classes/Discord.php";
include "classes/Messages.php";

$errorEmai = Messages::EmailAlreadyInUse();
$statusError = $_GET['errorEmailAlreadyExists'];

$msgErrorProcess = Messages::ErrorProcess();
$errorProccess = $_GET['errorProcess'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once "includes/head.php";
	?>
</head>

<body id="kt_body" class="bg-body">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #1b1b29">
				<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
						<a href="../../demo1/dist/index.html" class="py-9 mb-5">
							<img alt="Logo" src="assets/media/logos/ReadMe-B.png" class="h-150px" />
						</a>
						<h1 class="fw-bolder fs-2qx pb-5 pb-md-10 text-white">Sistema de Biblioteca Digital</h1>
						<p class="fw-bold fs-2 text-white">Bienvenido al sistema de biblioteca digital,
							<br /> por favor inicie sesión para continuar
						</p>
						</p>
					</div>
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/dozzy-1/1.png"></div>
				</div>
			</div>
			<div class="d-flex flex-column flex-lg-row-fluid py-10">
				<div class="d-flex flex-center flex-column flex-column-fluid">
					<?php
					// Si recibe en la url el parametro errorEmailAlreadyExists, muestra el mensaje de error
					if ($statusError == 'true' && $_GET['email']) {
						echo $errorEmai;
					} else if ($errorProccess == 'true') {
						echo $msgErrorProcess;
					}
					?>
					<div id="crearCuentaDiv" name="crearCuentaDiv" class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<form action="register.php" class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_sign_up_form" method="post">
							<div class="mb-10 text-center">
								<h1 class="text-dark mb-3">Crea tu cuenta</h1>
								<div class="text-gray-400 fw-bold fs-4">Ya tienes una cuenta?
									<button id="iniciarSR" name="iniciarSR" type="button" class="btn mb-auto btn-link fw-bolder" id="kt_login_signup">Iniciar sesion</button>
								</div>
							</div>
							<div class="d-flex align-items-center mb-10">
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
								<div class="border-bottom border-gray-300 mw-50 w-100"></div>
							</div>
							<div class="row fv-row mb-7 fv-plugins-icon-container">
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Nombre</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Nombre" id="nombre" name="nombre" autocomplete="off">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								<div class="col-xl-6">
									<label class="form-label fw-bolder text-dark fs-6">Apellido</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Apellido" id="apellido" name="apellido" autocomplete="off">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								<div class="fv-row mt-5 fv-plugins-icon-container">
									<label class="form-label fw-bolder text-dark fs-6">Nombre de usuario</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="Usuario" id="nomUsuario" name="nomUsuario" autocomplete="off">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								<div class="fv-row mt-5 fv-plugins-icon-container">
									<label class="form-label fw-bolder text-dark fs-6">Fecha de nacimiento</label>
									<input class="form-control form-control-lg form-control-solid" type="date" id="fechaNac" name="fechaNac" autocomplete="off">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
								<div class="fv-row mt-5 fv-plugins-icon-container">
									<label class="form-label fw-bolder text-dark fs-6">Celular</label>
									<input class="form-control form-control-lg form-control-solid" type="number" maxlength="9" placeholder="xxx-xxx-xxx" id="celular" name="celular" autocomplete="off">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="fv-row mb-7 fv-plugins-icon-container">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="ejemplo@agrasystems.us" name="email" id="email" autocomplete="off">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							<div class="mb-10 fv-row fv-plugins-icon-container" data-kt-password-meter="true">
								<div class="mb-1">
									<label class="form-label fw-bolder text-dark fs-6">Contraseña</label>
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="**********" id="passwordUser" name="passwordUser" autocomplete="off">
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="bi bi-eye-slash fs-2"></i>
											<i class="bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
									<div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
										<div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
									</div>
								</div>
								<div class="text-muted">Usa al menos 8 caracteres con una combinación de letras, números y símbolos.</div>
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							<div class="fv-row mb-10 fv-plugins-icon-container">
								<label class="form-check form-check-custom form-check-solid form-check-inline">
									<input class="form-check-input" type="checkbox" name="toc" value="1">
									<span class="form-check-label fw-bold text-gray-700 fs-6">Acepto
										<a href="#" class="link-primary">los términos y condiciones</a>.
									</span>
								</label>
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
							<div class="text-center">
								<input name="btnRegister" name="btnRegister" type="submit" class="btn btn-sm btn-light-success w-100 mb-5" value="Crear cuenta">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#iniciarSR").click(function() {
			window.location.href = "sign-in";
		});
		$("#fechaNac").change(function() {
			var fechaNac = $("#fechaNac").val();
			var fechaActual = new Date();
			var fechaNacDate = new Date(fechaNac);
			if (fechaNacDate > fechaActual) {
				alert("La fecha de nacimiento no puede ser mayor a la fecha actual");
				$("#fechaNac").val("");
			}
		});
		// Limitar caracteres del campo nombre a 25, el campo apellido a 25 y el campo usuario a 30, el campo celular a 9, email a 50 y password a 50
		$("#nombre").keyup(function() {
			var nombre = $("#nombre").val();
			if (nombre.length > 25) {
				$("#nombre").val(nombre.substring(0, 25));
			}
		});
		$("#apellido").keyup(function() {
			var apellido = $("#apellido").val();
			if (apellido.length > 25) {
				$("#apellido").val(apellido.substring(0, 25));
			}
		});
		$("#nomUsuario").keyup(function() {
			var usuario = $("#nomUsuario").val();
			if (usuario.length > 30) {
				$("#nomUsuario").val(usuario.substring(0, 30));
			}
		});
		$("#celular").keyup(function() {
			var celular = $("#celular").val();
			if (celular.length > 9) {
				$("#celular").val(celular.substring(0, 9));
			}
		});
		$("#email").keyup(function() {
			var email = $("#email").val();
			if (email.length > 50) {
				$("#email").val(email.substring(0, 50));
			}
		});
		$("#passwordUser").keyup(function() {
			var passwordUser = $("#passwordUser").val();
			if (passwordUser.length > 50) {
				$("#passwordUser").val(passwordUser.substring(0, 50));
			}
		});
	</script>

	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>