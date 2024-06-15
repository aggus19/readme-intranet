<?php

include_once 'includes/general.php';
include_once 'includes/adminPerms.php';
$idUsuario = $_SESSION['id'];
$usuario = new User($idUsuario);
Discord::SendWebhook("New click on page (auditLogs)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on auditLogs.php.**" . "\n\n `🌎` **URL:** $url");
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<?php
	include_once 'includes/head.php';
	?>
</head>


<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
		<div class="page d-flex flex-row flex-column-fluid">
			<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<?php include "includes/lateral.php"; ?>
			</div>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<?php include "includes/header.php"; ?>
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="toolbar" id="kt_toolbar">
						<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
							<ol class="breadcrumb breadcrumb-line text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="index" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item pe-3"><a class="pe-3">Gestión</a></li>
								<li class="breadcrumb-item px-3"><a href="auditLogs" class=" text-muted pe-3">Registro de auditoría</a></li>
							</ol>
						</div>
					</div>
					<div class=" post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<div class=" card card-flush">
								<div class="card-header mt-6">
									<div class="card-title">
										<div class="d-flex align-items-center position-relative my-1 me-5">
											<span class="svg-icon svg-icon-1 position-absolute ms-6">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<input type="text" data-kt-permissions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Buscar" />
										</div>
									</div>
								</div>
								<div class="card-body pt-0">
									<table class="table align-middle table-row-bordered fs-6 gy-5 mb-0" id="kt_permissions_table">
										<thead>
											<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
												<th class="min-w-125px">Cuenta</th>
												<th class="min-w-250px">Descripcion (accion & tipo)</th>
												<th class="min-w-250px">Detalles (localidad & ip)</th>
												<th class="text-center min-w-100px">Fecha</th>
											</tr>
										</thead>
										<tbody class="fw-bold text-gray-600">
											<?php

											$a = AuditLogs::GetAllLogs();
											foreach ($a as $x => $value) {
												echo '
												<tr>
												 	<td>
														<span class="badge badge-light-dark"><strong><i class="text-dark fas fa-user"> </i> <span class="fw-bold fs-7">(#' . $value['userId'] . ') ' . $value['username'] . ' </strong>  </span>  <a class="ms-2 text-gray-userTable fw-bolder text-hover-primary fs-6">
												 	</td>
												 	<td>
												 		<div class="d-flex flex-column">
														 <a class="text-primary-600 mb-1"> <span class="mb-2 text-hover-primary badge badge-light-primary"><i class="text-warning fa-solid fa-arrow-pointer"></i></span> Acción: <span class="fw-bolder text-gray-600 text-hover-warning "> ' .  $value['info'] . '</span>  </a>
														</div>
												 	</td>
													<td>
												 		<div class="d-flex flex-column">
														 <a class="text-primary-600 mb-1"> <span class="mb-2 text-hover-primary badge badge-light-primary"><i class="text-warning fa-solid fa-wifi"></i></span> Dirección IP: <span class="fw-bolder text-gray-600 text-hover-warning "> ' .  $value['ip'] . ' (' .  $value['localidad'] . ')</span>  </a>
														</div>
												 	</td>
													<td class="text-center">
													<a class="text-primary-600 mb-1"> <span class="mb-2 text-hover-primary badge badge-light-primary"><i class="text-warning fa-solid fa-calendar-days"></i></span> Fecha realizado: <span class="fw-bolder text-gray-600 text-hover-warning "> ' .  $value['date'] . '</span>  </a>
													</td>
												 </tr>';
											}
											if (count($a) == 0) {
												echo '
												<tr>
													<td colspan="5">
														<div class="text-center text-danger fs-6 fw-bold">No se encontraron registros </div>
													</td>
												</tr>';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
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