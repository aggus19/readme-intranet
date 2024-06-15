<?php
$id = $_SESSION['id'];
$visitante = $_SESSION['username'] == 'visitante';
$permsLevel = User::GetUserLevelPerms($id);
$logoReadme = Panel::GetLogoReadme();
?>
<div class="aside-logo flex-column-auto" id="kt_aside_logo">
	<a href="index">
		<img alt="Logo" id="logoAgras" src="<?php echo $logoReadme; ?>" class="h-85px logo" />
	</a>
	<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-white aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
		<span class="svg-icon svg-icon-1 rotate-180">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
				<path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="#fff" />
			</svg>
		</span>
	</div>
</div>


<div class="aside-menu flex-column-fluid">
	<div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
		<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
			<div class="menu-item">
				<div class="menu-content pb-2">
					<span class="menu-section text-uppercase fs-7 ls-1">Menu</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="<?php echo PRINCIPAL_INDEX; ?>">
					<span class="menu-icon"><i class="fa-solid fa-house"></i></span>
					<span class="texto-lateral menu-title">Inicio</span>
				</a>
			</div>
			<div class="menu-item">
				<div class="menu-content">
					<div class="separator mx-1 my-1"></div>
				</div>
			</div>
			<div class="menu-item">
				<div class="menu-content pt-8 pb-2">
					<span class="menu-section text-uppercase fs-7 ls-1">Principal</span>
				</div>
			</div>
			<div class="menu-item">
				<a class="menu-link" href="<?php echo PAGES_LIBROS; ?>">
					<span class="menu-icon">
						<i class="fa-solid fa-list fs-4"></i>
					</span>
					<span class="texto-lateral menu-title">Lista de Libros</span>
				</a>
			</div>
			<?php
			if (!$visitante) {
				echo '<div class="menu-item">
				<a class="menu-link" href="'.PAGES_MI_BIBLIOTECA.'">
					<span class="menu-icon"><i class=" fs-4 fa-solid fa-book"></i></span>
					<span class="texto-lateral menu-title">Mi Biblioteca</span>
				</a>
			</div>';
			}

			?>

			<div class="menu-item">
				<a class="menu-link" href="<?php echo PAGES_CLUBES_LECTURA; ?>">
					<span class="menu-icon"><i class=" fs-4 fa fa-group"></i></span>
					<span class="texto-lateral menu-title">Clubes de Lectura</span>
				</a>
			</div>
			<?php
			if (!$visitante) {
				echo '
						<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
									<span class="menu-icon">
									<i class="fs-4 fa-regular fa-newspaper"></i>
								</span>
								<span class="texto-lateral menu-title">Reseñas
									<span class="ms-2 badge badge-sm badge-light-warning">NUEVO! <i class="text-warning fs-sm-9 ms-1 fa-solid fa-star"></i> </span>
								</span>
										<span class="menu-arrow"></span>
									</span>
									<div class="menu-sub menu-sub-accordion menu-active-bg" kt-hidden-height="195" style="display: none; overflow: hidden;">
										<div class="menu-item">
											<a class="menu-link" href="' . PAGES_RESENIAS . '">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Crear reseña</span>
											</a>
										</div>
										<div class="menu-item">
										<a class="menu-link" href="' . PAGES_ALL_RESENIAS . '">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
												<span class="menu-title">Ver todas las reseñas</span>
											</a>
										</div>
									</div>
								</div>
					';
			}
			?>
			<div class="menu-item">
				<div class="menu-content">
					<div class="separator mx-1 my-1"></div>
				</div>
			</div>
			<?php
			if ($permsLevel >= 2 && $permsLevel != 3) {
				echo '
						<div class="menu-item">
							<div class="menu-content pt-8 pb-2">
								<span class="menu-section text-uppercase fs-7 ls-1">Administracion</span>
							</div>
						</div>
						<div class="menu-item">
						<a class="menu-link" href="' .  PAGES_ADMIN_CUENTAS . '" >
								<span class="menu-icon">
									<i class="fa fa-cogs fs-4"></i>
								</span>
								<span class="texto-lateral menu-title">Administrar Cuentas</span>
							</a>
						</div>
						<div class="menu-item">
						<a class="menu-link" href="' .  PAGES_GESTION_AUTORES . '" >
							<span class="menu-icon">
							<i class="fa fa-cogs fs-4"></i>
						</span>
						<span class="texto-lateral menu-title">Gestionar Autores</span>
					</a>
				</div>
				<div class="menu-item">
				<a class="menu-link" href="' .  PAGES_GESTION_LIBROS . '" >
				<span class="menu-icon">
							<i class="fa fa-cogs fs-4"></i>
						</span>
						<span class="texto-lateral menu-title">Gestionar Libros</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="' .  PAGES_AUDIT_LOGS . '" >
					<span class="menu-icon">
					<i class="fa-brands fa-slack fs-4"></i>
					</span>
				</span>
			<span class="menu-title">Registro de Auditoria</span>
					</a>
				</div>
				<div class="menu-item">
					<div class="menu-content">
						<div class="separator mx-1 my-1"></div>
					</div>
				</div>';
			} else if ($permsLevel == 3) {
				echo '
						<div class="menu-item">
							<div class="menu-content pt-8 pb-2">
								<span class="menu-section text-uppercase fs-7 ls-1">Administracion</span>
							</div>
						</div>
						<div class="menu-item">
						<a class="menu-link" href="' .  PAGES_GESTION_AUTORES . '" >
				<span class="menu-icon">
							<i class="fa fa-cogs fs-4"></i>
						</span>
						<span class="texto-lateral menu-title">Gestionar Autores</span>
					</a>
				</div>
				<div class="menu-item">
				<a class="menu-link" href="' .  PAGES_GESTION_LIBROS . '" >
				<span class="menu-icon">
							<i class="fa fa-cogs fs-4"></i>
						</span>
						<span class="texto-lateral menu-title">Gestionar Libros</span>
					</a>
				</div>
				<div class="menu-item">
					<div class="menu-content">
						<div class="separator mx-1 my-1"></div>
					</div>
				</div>';
			}
			?>
			<div class="menu-item">
				<div class="menu-content pt-8 pb-2">
					<span class="menu-section text-uppercase fs-7 ls-1">INFORMACIÓN</span>
				</div>
			</div>

			<div class="menu-item">
				<a class="menu-link" href="<?php echo PAGES_ABOUT_US; ?>">
					<span class="menu-icon"><i class=" fs-4 fa-solid fa-circle-info"></i></span>
					<span class="texto-lateral menu-title">Sobre Nosotros</span>
				</a>
			</div>
			<div class="menu-item">
				<div class="menu-content">
					<div class="separator mx-1 my-1"></div>
				</div>
			</div>
			<div class="menu-item mt-5">
				<a class="menu-link" href="	<?php echo PAGES_LOGOUT ?> ">
					<span class="menu-icon"><i class=" bi bi-box-arrow-right"></i></span>
					<span class="text-danger menu-title">Cerrar sesion</span>
				</a>
			</div>
		</div>
	</div>
</div>