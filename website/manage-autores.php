<?php
include_once 'includes/general.php';
include_once 'includes/adminPerms.php';
$idUsuario = $_SESSION['id'];
$usuario = new User($idUsuario);
Discord::SendWebhook("New click on page (manage-autores)",  "**Username:** " . "`" . $usuario->GetUserById($idUsuario)[0]['username'] . "`" . "\n **IP:** " . "`" . IP::GetIP() . " (" . IP::GetLocationFromIP(IP::GetIP()) . ")" . "`" . "\n **Date:** " . "`" . Time::EpochToDate(Time::GetCurrentTime()) . "`" . "\n\n `🔎` **Clicked on manage-autores.**" . "\n\n `🌎` **URL:** $url");

if (isset($_POST['btnEnviar'])) {
	$nombreAutor = $_POST['nombreAutor'];
	$apeAutor = $_POST['apeAutor'];
	$nacionAutor = $_POST['nacionAutor'];
	$fechaNAutor = Time::ConvertDateToDB($_POST['fechaNAutor']);
	$queryInsertarAutor = 	Autores::AddNewAutor($nombreAutor, $apeAutor, $nacionAutor, $fechaNAutor);
	if ($queryInsertarAutor == true) {
		header("Location: manage-autores?successCreate=1");
	} else {
		header("Location: manage-autores?error");
	}
}

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
								<li class="breadcrumb-item px-3"><a href="manage-autores" class=" text-muted pe-3">Autores</a></li>
							</ol>
						</div>
					</div>
					<div class="post d-flex flex-column-fluid" id="kt_post">
						<div id="kt_content_container" class="container-fluid">
							<?php
							//  Mostrar en una variable al usuario que no se encontro.
							if (isset($_GET['invalidAutor'])) {
								echo '
								<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
									<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-triangle-exclamation"></i>
									</span>
								<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Autor no encontrado! 😔</h4>
										<span class="text-white">No pudimos encontrar al autor solicitado.</span>
								</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe success, mostrar mensaje de exito.
							elseif (isset($_GET['successEdit']) && $_GET['successEdit'] == '1') {
								echo '
									<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
									</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Autor modificado con exito! 😎</h4>
										<span class="text-white">El autor se modificó correctamente.</span>
								</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe usuario eliminado, mostrar mensaje de exito.
							elseif (isset($_GET['successCreate']) && $_GET['successCreate'] == '1') {
								echo '
									<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
									</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Autor creado con exito! 😎</h4>
										<span class="text-white">El autor se creó correctamente.</span>
								</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe usuario eliminado, mostrar mensaje de exito.
							elseif (isset($_GET['deletedAutor']) && $_GET['id']) {
								echo '
									<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-check-circle"></i>
									</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Autor eliminado con exito! 😎</h4>
										<span class="text-white">El autor (#' . $_GET['id'] . ') | (' . $_GET['nombre'] . ') se eliminó correctamente.</span>
										</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							} // Si recibe error, mostrar mensaje de error.
							elseif (isset($_GET['error'])) {
								echo '
									<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row w-100 p-5 mt-10 mb-5">
										<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
											<i style="font-size: 30px;" class="mt-2 text-white fa-solid fa-exclamation-circle"></i>
										</span>
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 text-white">Error! 😢</h4>
										<span class="text-white">Ocurrió un error al intentar modificar el autor.</span>
									</div>
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
											</svg>
										</span>
									</button>
								</div>';
							}
							?>
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
									<div class="card-toolbar">
										<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
											<button type="button" class="btn btn-sm btn-primary fs-6" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user"> Añadir autor <i class="me-2 bi bi-plus-circle"></i> </button>
										</div>


										<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered mw-650px">
												<div class="modal-content">
													<div class="modal-header" id="kt_modal_add_user_header">
														<h2 class="fw-bolder text-white">Datos del autor</h2>
														<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
																	<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
																</svg>
															</span>
														</div>
													</div>

													<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
														<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="kt_sign_in_form" method="post">
															<div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Nombre</label>
																	<input type="text" name="nombreAutor" id="nombreAutor" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nombre" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Apellido</label>
																	<input type="text" name="apeAutor" id="apeAutor" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Apellido" required>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Nacionalidad</label>
																	<select class="form-select form-select-solid" id="nacionAutor" name="nacionAutor" data-control="select2" data-placeholder="Selecciona una opcion" data-allow-clear="true" multiple="multiple">
																		<option></option>
																		<option value="Afganistán" id="AF">Afganistán</option>
																		<option value="Albania" id="AL">Albania</option>
																		<option value="Alemania" id="DE">Alemania</option>
																		<option value="Andorra" id="AD">Andorra</option>
																		<option value="Angola" id="AO">Angola</option>
																		<option value="Anguila" id="AI">Anguila</option>
																		<option value="Antártida" id="AQ">Antártida</option>
																		<option value="Antigua y Barbuda" id="AG">Antigua y Barbuda</option>
																		<option value="Antillas holandesas" id="AN">Antillas holandesas</option>
																		<option value="Arabia Saudí" id="SA">Arabia Saudí</option>
																		<option value="Argelia" id="DZ">Argelia</option>
																		<option value="Argentina" id="AR">Argentina</option>
																		<option value="Armenia" id="AM">Armenia</option>
																		<option value="Aruba" id="AW">Aruba</option>
																		<option value="Australia" id="AU">Australia</option>
																		<option value="Austria" id="AT">Austria</option>
																		<option value="Azerbaiyán" id="AZ">Azerbaiyán</option>
																		<option value="Bahamas" id="BS">Bahamas</option>
																		<option value="Bahrein" id="BH">Bahrein</option>
																		<option value="Bangladesh" id="BD">Bangladesh</option>
																		<option value="Barbados" id="BB">Barbados</option>
																		<option value="Bélgica" id="BE">Bélgica</option>
																		<option value="Belice" id="BZ">Belice</option>
																		<option value="Benín" id="BJ">Benín</option>
																		<option value="Bermudas" id="BM">Bermudas</option>
																		<option value="Bhután" id="BT">Bhután</option>
																		<option value="Bielorrusia" id="BY">Bielorrusia</option>
																		<option value="Birmania" id="MM">Birmania</option>
																		<option value="Bolivia" id="BO">Bolivia</option>
																		<option value="Bosnia y Herzegovina" id="BA">Bosnia y Herzegovina</option>
																		<option value="Botsuana" id="BW">Botsuana</option>
																		<option value="Brasil" id="BR">Brasil</option>
																		<option value="Brunei" id="BN">Brunei</option>
																		<option value="Bulgaria" id="BG">Bulgaria</option>
																		<option value="Burkina Faso" id="BF">Burkina Faso</option>
																		<option value="Burundi" id="BI">Burundi</option>
																		<option value="Cabo Verde" id="CV">Cabo Verde</option>
																		<option value="Camboya" id="KH">Camboya</option>
																		<option value="Camerún" id="CM">Camerún</option>
																		<option value="Canadá" id="CA">Canadá</option>
																		<option value="Chad" id="TD">Chad</option>
																		<option value="Chile" id="CL">Chile</option>
																		<option value="China" id="CN">China</option>
																		<option value="Chipre" id="CY">Chipre</option>
																		<option value="Ciudad estado del Vaticano" id="VA">Ciudad estado del Vaticano</option>
																		<option value="Colombia" id="CO">Colombia</option>
																		<option value="Comores" id="KM">Comores</option>
																		<option value="Congo" id="CG">Congo</option>
																		<option value="Corea" id="KR">Corea</option>
																		<option value="Corea del Norte" id="KP">Corea del Norte</option>
																		<option value="Costa del Marfíl" id="CI">Costa del Marfíl</option>
																		<option value="Costa Rica" id="CR">Costa Rica</option>
																		<option value="Croacia" id="HR">Croacia</option>
																		<option value="Cuba" id="CU">Cuba</option>
																		<option value="Dinamarca" id="DK">Dinamarca</option>
																		<option value="Djibouri" id="DJ">Djibouri</option>
																		<option value="Dominica" id="DM">Dominica</option>
																		<option value="Ecuador" id="EC">Ecuador</option>
																		<option value="Egipto" id="EG">Egipto</option>
																		<option value="El Salvador" id="SV">El Salvador</option>
																		<option value="Emiratos Arabes Unidos" id="AE">Emiratos Arabes Unidos</option>
																		<option value="Eritrea" id="ER">Eritrea</option>
																		<option value="Eslovaquia" id="SK">Eslovaquia</option>
																		<option value="Eslovenia" id="SI">Eslovenia</option>
																		<option value="España" id="ES">España</option>
																		<option value="Estados Unidos" id="US">Estados Unidos</option>
																		<option value="Estonia" id="EE">Estonia</option>
																		<option value="c" id="ET">Etiopía</option>
																		<option value="Ex-República Yugoslava de Macedonia" id="MK">Ex-República Yugoslava de Macedonia</option>
																		<option value="Filipinas" id="PH">Filipinas</option>
																		<option value="Finlandia" id="FI">Finlandia</option>
																		<option value="Francia" id="FR">Francia</option>
																		<option value="Gabón" id="GA">Gabón</option>
																		<option value="Gambia" id="GM">Gambia</option>
																		<option value="Georgia" id="GE">Georgia</option>
																		<option value="Georgia del Sur y las islas Sandwich del Sur" id="GS">Georgia del Sur y las islas Sandwich del Sur</option>
																		<option value="Ghana" id="GH">Ghana</option>
																		<option value="Gibraltar" id="GI">Gibraltar</option>
																		<option value="Granada" id="GD">Granada</option>
																		<option value="Grecia" id="GR">Grecia</option>
																		<option value="Groenlandia" id="GL">Groenlandia</option>
																		<option value="Guadalupe" id="GP">Guadalupe</option>
																		<option value="Guam" id="GU">Guam</option>
																		<option value="Guatemala" id="GT">Guatemala</option>
																		<option value="Guayana" id="GY">Guayana</option>
																		<option value="Guayana francesa" id="GF">Guayana francesa</option>
																		<option value="Guinea" id="GN">Guinea</option>
																		<option value="Guinea Ecuatorial" id="GQ">Guinea Ecuatorial</option>
																		<option value="Guinea-Bissau" id="GW">Guinea-Bissau</option>
																		<option value="Haití" id="HT">Haití</option>
																		<option value="Holanda" id="NL">Holanda</option>
																		<option value="Honduras" id="HN">Honduras</option>
																		<option value="Hong Kong R. A. E" id="HK">Hong Kong R. A. E</option>
																		<option value="Hungría" id="HU">Hungría</option>
																		<option value="India" id="IN">India</option>
																		<option value="Indonesia" id="ID">Indonesia</option>
																		<option value="Irak" id="IQ">Irak</option>
																		<option value="Irán" id="IR">Irán</option>
																		<option value="Irlanda" id="IE">Irlanda</option>
																		<option value="Isla Bouvet" id="BV">Isla Bouvet</option>
																		<option value="Isla Christmas" id="CX">Isla Christmas</option>
																		<option value="Isla Heard e Islas McDonald" id="HM">Isla Heard e Islas McDonald</option>
																		<option value="Islandia" id="IS">Islandia</option>
																		<option value="Islas Caimán" id="KY">Islas Caimán</option>
																		<option value="Islas Cook" id="CK">Islas Cook</option>
																		<option value="Islas de Cocos o Keeling" id="CC">Islas de Cocos o Keeling</option>
																		<option value="Islas Faroe" id="FO">Islas Faroe</option>
																		<option value="Islas Fiyi" id="FJ">Islas Fiyi</option>
																		<option value="Islas Malvinas Islas Falkland" id="FK">Islas Malvinas Islas Falkland</option>
																		<option value="Islas Marianas del norte" id="MP">Islas Marianas del norte</option>
																		<option value="Islas Marshall" id="MH">Islas Marshall</option>
																		<option value="Islas menores de Estados Unidos" id="UM">Islas menores de Estados Unidos</option>
																		<option value="Islas Palau" id="PW">Islas Palau</option>
																		<option value="Islas Salomón" d="SB">Islas Salomón</option>
																		<option value="Islas Tokelau" id="TK">Islas Tokelau</option>
																		<option value="Islas Turks y Caicos" id="TC">Islas Turks y Caicos</option>
																		<option value="Islas Vírgenes EE.UU." id="VI">Islas Vírgenes EE.UU.</option>
																		<option value="Islas Vírgenes Reino Unido" id="VG">Islas Vírgenes Reino Unido</option>
																		<option value="Israel" id="IL">Israel</option>
																		<option value="Italia" id="IT">Italia</option>
																		<option value="Jamaica" id="JM">Jamaica</option>
																		<option value="Japón" id="JP">Japón</option>
																		<option value="Jordania" id="JO">Jordania</option>
																		<option value="Kazajistán" id="KZ">Kazajistán</option>
																		<option value="Kenia" id="KE">Kenia</option>
																		<option value="Kirguizistán" id="KG">Kirguizistán</option>
																		<option value="Kiribati" id="KI">Kiribati</option>
																		<option value="Kuwait" id="KW">Kuwait</option>
																		<option value="Laos" id="LA">Laos</option>
																		<option value="Lesoto" id="LS">Lesoto</option>
																		<option value="Letonia" id="LV">Letonia</option>
																		<option value="Líbano" id="LB">Líbano</option>
																		<option value="Liberia" id="LR">Liberia</option>
																		<option value="Libia" id="LY">Libia</option>
																		<option value="Liechtenstein" id="LI">Liechtenstein</option>
																		<option value="Lituania" id="LT">Lituania</option>
																		<option value="Luxemburgo" id="LU">Luxemburgo</option>
																		<option value="Macao R. A. E" id="MO">Macao R. A. E</option>
																		<option value="Madagascar" id="MG">Madagascar</option>
																		<option value="Malasia" id="MY">Malasia</option>
																		<option value="Malawi" id="MW">Malawi</option>
																		<option value="Maldivas" id="MV">Maldivas</option>
																		<option value="Malí" id="ML">Malí</option>
																		<option value="Malta" id="MT">Malta</option>
																		<option value="Marruecos" id="MA">Marruecos</option>
																		<option value="Martinica" id="MQ">Martinica</option>
																		<option value="Mauricio" id="MU">Mauricio</option>
																		<option value="Mauritania" id="MR">Mauritania</option>
																		<option value="Mayotte" id="YT">Mayotte</option>
																		<option value="México" id="MX">México</option>
																		<option value="Micronesia" id="FM">Micronesia</option>
																		<option value="Moldavia" id="MD">Moldavia</option>
																		<option value="Mónaco" id="MC">Mónaco</option>
																		<option value="Mongolia" id="MN">Mongolia</option>
																		<option value="Montserrat" id="MS">Montserrat</option>
																		<option value="Mozambique" id="MZ">Mozambique</option>
																		<option value="Namibia" id="NA">Namibia</option>
																		<option value="Nauru" id="NR">Nauru</option>
																		<option value="Nepal" id="NP">Nepal</option>
																		<option value="Nicaragua" id="NI">Nicaragua</option>
																		<option value="Níger" id="NE">Níger</option>
																		<option value="Nigeria" id="NG">Nigeria</option>
																		<option value="Niue" id="NU">Niue</option>
																		<option value="Norfolk" id="NF">Norfolk</option>
																		<option value="Noruega" id="NO">Noruega</option>
																		<option value="Nueva Caledonia" id="NC">Nueva Caledonia</option>
																		<option value="Nueva Zelanda" id="NZ">Nueva Zelanda</option>
																		<option value="Omán" id="OM">Omán</option>
																		<option value="Panamá" id="PA">Panamá</option>
																		<option value="Papua Nueva Guinea" id="PG">Papua Nueva Guinea</option>
																		<option value="Paquistán" id="PK">Paquistán</option>
																		<option value="Paraguay" id="PY">Paraguay</option>
																		<option value="Perú" id="PE">Perú</option>
																		<option value="Pitcairn" id="PN">Pitcairn</option>
																		<option value="Polinesia francesa" id="PF">Polinesia francesa</option>
																		<option value="Polonia" id="PL">Polonia</option>
																		<option value="Portugal" id="PT">Portugal</option>
																		<option value="Puerto Rico" id="PR">Puerto Rico</option>
																		<option value="Qatar" id="QA">Qatar</option>
																		<option value="Reino Unido" id="UK">Reino Unido</option>
																		<option value="República Centroafricana" id="CF">República Centroafricana</option>
																		<option value="República Checa" id="CZ">República Checa</option>
																		<option value="República de Sudáfrica" id="ZA">República de Sudáfrica</option>
																		<option value="República Democrática del Congo Zaire" id="CD">República Democrática del Congo Zaire</option>
																		<option value="República Dominicana" id="DO">República Dominicana</option>
																		<option value="Reunión" id="RE">Reunión</option>
																		<option value="Ruanda" id="RW">Ruanda</option>
																		<option value="Rumania" id="RO">Rumania</option>
																		<option value="Rusia" id="RU">Rusia</option>
																		<option value="Samoa" id="WS">Samoa</option>
																		<option value="Samoa occidental" id="AS">Samoa occidental</option>
																		<option value="San Kitts y Nevis" id="KN">San Kitts y Nevis</option>
																		<option value="San Marino" id="SM">San Marino</option>
																		<option value="San Pierre y Miquelon" id="PM">San Pierre y Miquelon</option>
																		<option value="San Vicente e Islas Granadinas" id="VC">San Vicente e Islas Granadinas</option>
																		<option value="Santa Helena" id="SH">Santa Helena</option>
																		<option value="Santa Lucía" id="LC">Santa Lucía</option>
																		<option value="Santo Tomé y Príncipe" id="ST">Santo Tomé y Príncipe</option>
																		<option value="Senegal" id="SN">Senegal</option>
																		<option value="Serbia y Montenegro" id="YU">Serbia y Montenegro</option>
																		<option value="Sychelles" id="SC">Seychelles</option>
																		<option value="Sierra Leona" id="SL">Sierra Leona</option>
																		<option value="Singapur" id="SG">Singapur</option>
																		<option value="Siria" id="SY">Siria</option>
																		<option value="Somalia" id="SO">Somalia</option>
																		<option value="Sri Lanka" id="LK">Sri Lanka</option>
																		<option value="Suazilandia" id="SZ">Suazilandia</option>
																		<option value="Sudán" id="SD">Sudán</option>
																		<option value="Suecia" id="SE">Suecia</option>
																		<option value="Suiza" id="CH">Suiza</option>
																		<option value="Surinam" id="SR">Surinam</option>
																		<option value="Svalbard" id="SJ">Svalbard</option>
																		<option value="Tailandia" id="TH">Tailandia</option>
																		<option value="Taiwán" id="TW">Taiwán</option>
																		<option value="Tanzania" id="TZ">Tanzania</option>
																		<option value="Tayikistán" id="TJ">Tayikistán</option>
																		<option value="Territorios británicos del océano Indico" id="IO">Territorios británicos del océano Indico</option>
																		<option value="Territorios franceses del sur" id="TF">Territorios franceses del sur</option>
																		<option value="Timor Oriental" id="TP">Timor Oriental</option>
																		<option value="Togo" id="TG">Togo</option>
																		<option value="Tonga" id="TO">Tonga</option>
																		<option value="Trinidad y Tobago" id="TT">Trinidad y Tobago</option>
																		<option value="Túnez" id="TN">Túnez</option>
																		<option value="Turkmenistán" id="TM">Turkmenistán</option>
																		<option value="Turquía" id="TR">Turquía</option>
																		<option value="Tuvalu" id="TV">Tuvalu</option>
																		<option value="Ucrania" id="UA">Ucrania</option>
																		<option value="Uganda" id="UG">Uganda</option>
																		<option value="Uruguay" id="UY">Uruguay</option>
																		<option value="Uzbekistán" id="UZ">Uzbekistán</option>
																		<option value="Vanuatu" id="VU">Vanuatu</option>
																		<option value="Venezuela" id="VE">Venezuela</option>
																		<option value="Vietnam" id="VN">Vietnam</option>
																		<option value="Wallis y Futuna" id="WF">Wallis y Futuna</option>
																		<option value="Yemen" id="YE">Yemen</option>
																		<option value="Zambia" id="ZM">Zambia</option>
																		<option value="Zimbabue" id="ZW">Zimbabue</option>
																	</select>
																</div>
																<div class="fv-row mb-7">
																	<label class="text-white required fw-bold fs-6 mb-2"> Nacimiento</label>
																	<input type="date" name="fechaNAutor" id="fechaNAutor" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="XXXX-XX-XX" required>
																</div>
															</div>
															<div class="text-center pt-15">
																<input type="submit" name="btnEnviar" class="btn btn-primary" value="Agregar">
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card-body pt-0">
									<table class="table align-middle table-row-bordered fs-6 gy-5 mb-0" id="kt_permissions_table">
										<thead>
											<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
												<th class="min-w-125px">ID Autor</th>
												<th class="min-w-250px">Nombre & Nacionalidad</th>
												<th class="min-w-125px">Fecha (nacimiento)</th>
												<th class="text-center min-w-100px">Accion</th>
											</tr>
										</thead>
										<tbody class="fw-bold text-gray-600">
											<?php

											$a = Autores::GetAllAutores();
											foreach ($a as $x => $value) {
												echo '
												<tr>
													<td>
												 		<span class="badge badge-light-dark"><strong><i class="text-dark fas fa-user"> </i> <span class="fw-bold fs-7">' . $value['id_autor'] . ' </strong>  </span>  <a class="ms-2 text-gray-userTable fw-bolder text-hover-primary mb-1 fs-6"> </td>
													</td>
													<td>
														<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1">' . $value['nombre'] . ' ' . $value['apellido'] . '</a>
															<span class="fw-bolder text-gray-600 text-hover-warning ">' . $value['nacionalidad'] . '</span>
														</div>
													</td>
													<td>
														<div class="d-flex flex-column">
															<a class="text-primary-600 text-hover-primary mb-1"> Fecha de nacimiento: <span class="fw-bolder  text-gray-600 text-hover-warning ">' .  $value['fechaNacimiento'] . '</span>  </a>
														</div>
													</td>
													<td class="text-center">
														<a class="btn btn-sm btn-light-danger me-3" href="deletes?idAutor=' . $value['id_autor'] . '" > <i class="fa-solid fa-trash-can"></i> Eliminar </a>
														<a class="btn btn-sm btn-light-warning me-3" href="editAutor?idAutor=' . $value['id_autor'] . '" > <i class="fa-solid fa-pen-to-square"></i> Editar </a>
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
	<script type="text/javascript">
		$('#nombreAutor').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("El nombre de la persona supera el limite de 30 caracteres");
			}
		});
		$('#apeAutor').on('input', function() {
			if ($(this).val().length > 30) {
				$(this).val($(this).val().slice(0, 30));
				alert("El apellido de la persona supera el limite de 30 caracteres");
			}
		});
		// En el select NacionAutor una vez se seleccione una, automaticamente deshabilita para que no se pueda cambiar
		$('#NacionAutor').on('change', function() {
			$(this).attr('disabled', true);
		});

		$("#fechaNAutor").change(function() {
			var fechaNAutor = $("#fechaNAutor").val();
			var fechaActual = new Date();
			var fechaNacDate = new Date(fechaNAutor);
			if (fechaNacDate > fechaActual) {
				alert("La fecha de nacimiento no puede ser mayor a la fecha actual");
				$("#fechaNAutor").val("");
			}
		});
	</script>
	<?php
	include_once 'includes/scripts.php';
	?>

</body>

</html>