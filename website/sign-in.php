<?php
session_start();

include "classes/Database.php";
include "classes/User.php";
include "classes/AuditLogs.php";
include "classes/Time.php";
include "classes/Discord.php";
include "classes/Messages.php";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: index");
}
$messageSuccess = Messages::SuccessfullCreate();
$statusCreated = $_GET['successCreated'];
$error = '';

if ($_POST) {
	$user = $_POST['user'];
	$pass = $_POST['contrasenia'];
	$encriptada = md5($pass);
	$usuario = User::GetUserByUsernameAndPassword($user, $encriptada)[0];
	$userPass = $usuario['password'];

	if ($usuario && $usuario['verified'] == 1 && $encriptada == $userPass) {
		$_SESSION["loggedin"] = true;
		$_SESSION["username"] = $usuario['username'];
		$_SESSION["id"] = $usuario['id'];
		$_SESSION["correo"] = $usuario['correo'];
		$url = "http://$_SERVER[HTTP_HOST]/";
		$userLogged = true;
		IP::UpdateIP();
		AuditLogs::AddNewLog("Inicio de sesion exitoso", "1");
		Discord::SendWebhook("Successful login", "**__Credentials:__** \n" . "**Username:** " . "`" . $_POST['user'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `✅` The account has **logged in successfully.**" . "\n\n `🌎` **URL:** $url");
		header("location: welcome");
	} elseif ($usuario && $usuario['verified'] == 0) {
		$error = Messages::AccountNotVerified();
		Discord::SendWebhook("Account not verified", "**__Credentials:__** \n" . "**Username:** " . "`" . $_POST['user'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `⚠` Tried to login to the panel but the account is **not verified.**" . "\n\n `🌎` **URL:** $url");
	} else {
		$error = Messages::CredentialErrors();
		Discord::SendWebhook("Attempt to login", "**__Credentials:__** \n" . "**Username:** " . "`" . $_POST['user'] . "`" . "\n **Password:** " . "`" . $_POST['contrasenia'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `⛔` Tried to login to the panel but the account does **not exist or the password is incorrect.**" . "\n\n `🌎` **URL:** $url");
	}
}

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
					echo $error;
					?>
					<?php
					// Si recibe en la url el parametro errorEmailAlreadyExists, muestra el mensaje de error
					if ($statusCreated == 'true') {
						echo $messageSuccess;
					}
					?>
					<div class="w-lg-500px bg-body rounded shadow-lg p-10 p-lg-15 mx-auto" id="loginForm">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="post">
							<div class="text-center mb-10">
								<h1 class="text-dark mb-3">Inicia sesión en tu cuenta</h1>
								<div class="text-gray-400 fw-bold fs-4">No tienes una cuenta?
									<button id="crearCuenta" name="crearCuenta" type="button" class="btn mb-auto btn-link fw-bolder" id="kt_login_signup">Crear una cuenta</button>
								</div>
							</div>
							<div class="fv-row mb-0">
								<div class="input-group input-group-solid">
									<span class="input-group-text">
										<i class="fa-solid fa-user fs-4"></i>
									</span>
									<div class="ms-2 flex-grow-1">
										<input placeholder="usuario o correo" id="username" class="form-control form-control-lg form-control-solid" type="username" name="user" autocomplete="off" />
									</div>
								</div>
							</div>
							<div class="mb-10 mt-10 fv-row" data-kt-password-meter="true">
								<div class="input-group input-group-solid">
									<span class="input-group-text">
										<i id="iconPass" class="fa-solid fa-lock fs-4"></i>
									</span>
									<div class="ms-2 flex-grow-1">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder="contraseña" id="contrasenia" name="contrasenia" autocomplete="off" />
										<span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
											<i class="text-danger bi bi-eye-slash fs-2"></i>
											<i class="text-success bi bi-eye fs-2 d-none"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="submit" id="kt_password_reset_submit" class="btn btn-sm btn-light-primary me-4"> Iniciar sesión </button>
								<a href="forgot-password" class="btn btn-sm btn-light">Olvidé mi contraseña</a>
							</div>
						</form>
					</div>
				</div>
				<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
					<div class="d-flex flex-center fw-bold fs-6">
						<form action="http://96510a3bc581.sn.mynetname.net:9001/sign-in" method="post">
							<input type="hidden" name="user" value="visitante">
							<input type="hidden" id="contrasenia" name="contrasenia" value="Xc^Wy8$8C6^UzF">
							<input type="submit" name="btnVisitante" id="btnVisitante" class="w-100 btn btn-sm btn-secondary" value="Entrar como visitante">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script type="text/javascript">
		$("#crearCuenta").click(function() {
			window.location.href = "sign-up";
		});
	</script>
	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>