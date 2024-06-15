<?php
// Obtener session id de signup.php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$userData = User::GetUserById($idUsuario)[0];
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>

<body id="kt_body" class="bg-body">
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-column flex-column-fluid">
			<div class="d-flex flex-column flex-column-fluid text-center p-10 py-lg-15">
				<a class="mb-5 pt-lg-10">
					<img alt="Logo" src="https://i.imgur.com/2q9HYzi.png" class="h-80px mb-5" />
				</a>
				<div class="pt-lg-10 mb-10">
					<h1 class="fw-bolder fs-2qx text-gray-800 mb-7">¡Bienvenido de nuevo <span class="text-primary"><?php echo '' . $userData['nombre'] . ''; ?>
							<div class="ms-2 symbol symbol-circle symbol-40px">
								<img src="<?php echo '' . $userData['profile_pic'] . ''; ?>" alt="" />
							</div>
						</span>! 😎</h1>

					<div class="fw-bold fs-3 text-muted mb-10">Estamos felices de que estés de vuelta
						<br />Realizaste un inicio de sesión <span class="text-success"> seguro </span> con tu nombre de usuario.
					</div>
					<div class="text-center">
						<a href="index" class="btn btn-base btn-light-dark mb-10"><i class="fa-solid fa-arrow-right-to-bracket fs-2 me-2"></i>Continuar al sitio</a>
					</div>
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/17.png"></div>
				</div>
				<div class="d-flex flex-center flex-column-auto p-10">
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="about-us" class="text-muted text-hover-primary px-2">Sobre nosotros</a>
						<a href="mailto:agras@agrasystems.us" class="text-muted text-hover-primary px-2">Contacto</a>
						<a href="logout" class="text-muted text-hover-danger px-2">Cerrar sesión</a>
					</div>
				</div>
			</div>
		</div>
		<script src=" assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
</body>

</html>