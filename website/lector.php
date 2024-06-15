<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$correoUsuario = $_SESSION['correo'];
$idMultimedia = $_GET['idMultimedia'];

$checkOwner = Book::CheckBookOwner($correoUsuario, $idMultimedia);
$directory = Book::TakeDirectoryBook($correoUsuario, $idMultimedia);

//var_dump('Directorio: ' . $directory);
//var_dump('Check book owner: ' . $checkOwner);

// Verificar que reciba parametros de GET de idUsuario que corresponda al usuario de la sesion
if (isset($_GET['idUsuario']) && $_GET['idUsuario'] == $idUsuario && isset($_GET['idMultimedia']) && $_GET['idMultimedia'] == $checkOwner) {
	$embed = '<embed src="' . $directory . '#toolbar=0&navpanes=0&scrollbar=0" width="1550" height="800>';
} else {
	echo 'No es el dueño del libro';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:1px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class=" d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<?php include "includes/lateral.php"; ?>
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_content">

				<?php include "includes/header.php"; ?>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-fluid">
							<div class="content flex-row-fluid" id="kt_content">
								<?php
								echo $embed;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	include_once 'includes/scripts.php';
	?>
</body>

</html>