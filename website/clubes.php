<?php
include_once 'includes/general.php';
$idUsuario = $_SESSION['id'];
$correo = $_SESSION['correo'];
$clubesData = Clubes::GetAllClubes();
$userData =  User::GetUserById($idUsuario);
$usuario = new User($idUsuario);
Discord::SendWebhook("New click on page (clubes de lectura)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on clubes.php.**" . "\n\n `🌎` **URL:** $url");
$messageAlreadyInClub = Messages::AlreadyInClub();
$status = $_GET['status'];
$clubId = $_GET['clubId'];
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
							<ol class="breadcrumb breadcrumb-dot text-muted fs-6 fw-bold">
								<li class="breadcrumb-item pe-3"><a href="#" class="pe-3">Panel</a></li>
								<li class="breadcrumb-item px-3 text-muted">Clubes de Lectura</li>
							</ol>
						</div>
					</div>
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<?php
							if ($status == 'alreadyMember' && $clubId) {
								echo Messages::AlreadyInClub();
							} else if ($status == 'joined' && $clubId) {
								echo Messages::JoinedClub();
							} else if ($status == 'leftClub' && $clubId) {
								echo Messages::LeftClub();
							}
							?>
							<div class="card mb-5 mb-xl-8" id="todosClubes">
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Clubes de Lectura</span>
										<span class="text-muted mt-1 fw-bold fs-7">Aquí podrás ver todos los clubes de lectura que hay en la plataforma.</span>
									</h3>
									<div class="card-toolbar">
										<button type="button" class="btn btn-sm btn-icon bg-light-primary btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<span class="svg-icon svg-icon-2">
												<i class="fs-xl-3 text-white fa-solid fa-gear"></i>
											</span>
										</button>
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
											<div class="menu-item px-3">
												<div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Acciones</div>
											</div>
											<div class="separator mb-3 opacity-75"></div>
											<div class="menu-item px-3">
												<a id="optionTodos" class="menu-link px-3">Ver todos los clubes</a>
											</div>
											<?php
											if ($_SESSION['username'] == 'visitante') {
											} else {
												echo '
											<div class="menu-item px-3">
											<a id="misClubes" href="#" class="menu-link px-3">Ver mis clubes</a>
											</div>';
											} ?>
											<div class="separator mt-3 opacity-75"></div>
										</div>
									</div>
								</div>
								<div class="card-body py-3" id="todosClubes">
									<div class="table-responsive">
										<table class="table align-middle gs-0 gy-4" id="kt_permissions_table">
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													<th class="ps-4 min-w-300px rounded-start">Nombre del Club</th>
													<th class="min-w-125px">Descripcion</th>
													<th class="min-w-150px">Rating</th>
													<th class="min-w-200px text-end rounded-end"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($_SESSION['username'] == 'visitante') {
													$botonUnirse = '';
												} else {
													$botonUnirse = '<a href="joinClub?idClub=' . $value['codigo_club'] . '" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Unirse</a>';
												}
												foreach ($clubesData as $key => $value) {
													echo
													'
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<div class="symbol symbol-50px me-5">
																<span class="symbol-label bg-light">
																	<i class="text-primary fs-xl-1 fa-solid fa-cube"></i>
																</span>
															</div>
															<div class="d-flex justify-content-start flex-column">
																<a class="text-dark fw-bolder text-hover-primary mb-1 fs-6">' . $value['nombre'] . ' <span class="text-muted fw-bold fs-8">(#' . $value['codigo_club'] . ')</span></a>
																<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['genero'] . '</span>
															</div>
														</div>
													</td>
													<td>
														<a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"></a>
														<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['descripcion'] . '</span>
													</td>
													<td>
														<div class="rating">
														' . $value['rating'] . '
														</div>
													</td>
													<td class="text-end">
														<a href="club?idClub=' . $value['codigo_club'] . '" target=_blank class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">Ver club</a>
														' . $botonUnirse . '
													</td>
												</tr>
												';
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div style="display: none;" class="card mb-5 mb-xl-8" id="misClubesDiv">
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Mis clubes de Lectura</span>
										<span class="text-muted mt-1 fw-bold fs-7">Aquí podrás ver todos los clubes de lectura que formas parte.</span>
									</h3>
									<div class="card-toolbar">
										<button type="button" class="btn btn-sm btn-icon bg-light-primary btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
											<span class="svg-icon svg-icon-2">
												<i class="fs-xl-3 text-white fa-solid fa-gear"></i>
											</span>
										</button>
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
											<div class="menu-item px-3">
												<div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Acciones</div>
											</div>
											<div class="separator mb-3 opacity-75"></div>
											<div class="menu-item px-3">
												<a id="optionTodos2" href="#" class="menu-link px-3">Ver todos los clubes</a>
											</div>
											<?php
											if ($_SESSION['username'] == 'visitante') {
											} else {
												echo '
											<div class="menu-item px-3">
											<a id="misClubes" href="#" class="menu-link px-3">Ver mis clubes</a>
										</div>';
											} ?>

											<div class="separator mt-3 opacity-75"></div>
										</div>
									</div>
								</div>
								<div class="card-body py-3" id="misClubesTable">
									<div class="table-responsive">
										<table class="table align-middle table-row-bordered fs-6 gy-5 mb-0" id="kt">
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													<th class="ps-4 min-w-300px rounded-start">Nombre del Club</th>
													<th class="min-w-125px">Descripcion</th>
													<th class="min-w-150px">Rating</th>
													<th class="min-w-200px text-end rounded-end"></th>
												</tr>
											</thead>
											<tbody class="fw-bold text-gray-600">
												<?php
												$userHasClub = Clubes::CheckIfUserHasClub($correo);
												$dataClubUser = Clubes::GetInfoFromUserClub();
												if (count($userHasClub) > 0) {
													foreach ($dataClubUser as $key => $value) {
														echo
														'
																<tr>
																	<td>
																		<div class="d-flex align-items-center">
																			<div class="symbol symbol-50px me-5">
																				<span class="symbol-label bg-light">
																					<i class="text-primary fs-xl-1 fa-solid fa-cube"></i>
																				</span>
																			</div>
																			<div class="d-flex justify-content-start flex-column">
																				<a class="text-dark fw-bolder text-hover-primary mb-1 fs-6">' . $value['nombre'] . ' <span class="text-muted fw-bold fs-8">(#' . $value['codigo_club'] . ')</span></a>
																				<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['genero'] . '</span>
																			</div>
																		</div>
																	</td>
																	<td>
																		<a class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"></a>
																		<span class="text-muted fw-bold text-muted d-block fs-7">' . $value['descripcion'] . '</span>
																	</td>
																	<td>
																		<div class="rating">
																		' . $value['rating'] . '
																		</div>
																	</td>
																	<td class="text-end">
																		<a href="club?idClub=' . $value['codigo_club'] . '" target=_blank class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2">Ver club</a>
																		<a href="leaves?idClub= ' . $value['codigo_club'] . '" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4">Abandonar</a>
																	</td>
																</tr>';
													}
												} else {
													echo
													'
												<tr>
													<td>
														<div class="d-flex align-items-center">
															<span class="ms-2 text-muted fw-bold text-muted d-block fs-7">No se encontraron clubes asociados</span>
														</div>
													</td>
													<td>
													</td>
													<td>
													</td>
												</tr>
												';
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
					<script src="assets/plugins/global/plugins.bundle.js"></script>
					<script src="assets/js/scripts.bundle.js"></script>
					<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
					<script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
					<script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
					<script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
					<script src="assets/js/custom/widgets.js"></script>
					<script src="assets/js/custom/apps/chat/chat.js"></script>
					<script src="assets/js/custom/utilities/modals/create-app.js"></script>
					<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
					<script src="assets/js/custom/apps/calendar/calendar.js"></script>
					<script src="assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
					<script type="text/javascript">
						// Previamente esconder el div con id "misClubes", una vez se toca en "misClubes" se muestra el div con id "misClubes"
						$(document).ready(function() {
							$("#misClubesDiv").hide();
							$("#misClubes").click(function() {
								$("#misClubesDiv").show();
								$("#todosClubes").hide();
							});
						});
						// Al tocar en el div con id "optionTodos" se esconde el div con id "misClubes" y se muestra el div con id "todosClubes"
						$(document).ready(function() {
							$("#optionTodos2").click(function() {
								$("#misClubesDiv").hide();
								$("#todosClubes").show();
							});
						});
					</script>

</body>

</html>