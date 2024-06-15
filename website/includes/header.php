<?php
$usuario = User::GetUserById($_SESSION['id']);
foreach ($usuario as $key => $value) {
}
?>
<div id="kt_header" class="header align-items-stretch">
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
			<div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
				<i class="bi bi-list fs-1"></i>
			</div>
		</div>
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
			<div class="d-flex align-items-stretch" id="kt_header_nav">
				<div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
					<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-white menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
						<div class="menu-item me-lg-1">
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex align-items-stretch flex-shrink-0">
				<div class="topbar d-flex align-items-stretch flex-shrink-0">
					<div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
						<div class="symbol symbol-circle mt-3 symbol-md-50px cursor-pointer " data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
							<img src="<?php echo '' . $value['profile_pic'] . ''; ?>" alt="user" data-stories_space_upload_el_handled="1">
						</div>
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg fw-bold py-4 fs-6 w-275px" data-kt-menu="true" data-popper-placement="bottom-end" style="z-index: 105; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-30px, 65px);">
							<div class="menu-item px-3">
								<div class="menu-content d-flex align-items-center px-3">
									<div class="symbol symbol-50px me-5 stories_space_img_parent_el">
										<img alt="Icono" src="<?php echo '' . $value['profile_pic'] . ''; ?>" data-stories_space_upload_el_handled="1">
										<div class="stories_space_upload_external" title="Upload to Instagram Story" style="top: 15px; left: 15px;"></div>
									</div>
									<div class="d-flex flex-column">
										<div class="fw-bolder d-flex align-items-center fs-5"><?php echo '' . $value['nombre'] . '  ' . $value['apellido'] . ''; ?>
											<?php echo User::SetHeaderDisplayRank($value['id']); ?>
										</div>
										<a class="text-muted fs-7">
											<i class="text-white  fa-regular fa-envelope me-2"></i>
											<?php echo '' . $value['correo'] . ''; ?>
										</a>
										<a class="text-muted fs-7">
											<i class="text-white fa-solid fa-coins me-2"></i>
											<?php echo '' . $value['creditos'] . ''; ?>
										</a>
									</div>
								</div>
							</div>
							<div class="separator my-2">
							</div>
							<div class="menu-item ">
								<a href="<?php echo '' . PAGES_ADMIN_USER_PERFIL . '' . $value['id'] . ''; ?>" class="menu-link px-5"> <span class="me-2 symbol-badge badge badge-circle bg-secondary start-0 top-100"><i class="text-white fa-solid fa-user"></i></span>Mi cuenta</a>
							</div>
							<div class="menu-item">
								<a href="biblioteca" class="menu-link px-5"> <span class="me-2 symbol-badge badge badge-circle bg-secondary start-0 top-100"><i class="text-white fa-solid fa-book"></i></span>Mi biblioteca</a>
							</div>
							<div class="separator my-2">
							</div>
							<div class="menu-item">
								<a href="<?php echo '' . PAGES_ADMIN_USER_PERFIL . '' . $value['id'] . ''; ?>" class="menu-link px-5"> <span class="me-2 symbol-badge badge badge-circle bg-secondary start-0 top-100"><i class="text-white fa-solid fa-gear"></i></span>Configuracion</a>
							</div>
							<div class="menu-item">
								<a href="<?php echo ' ' . PAGES_LOGOUT . ' '; ?>" class="text-danger menu-link px-5"> <span class="me-2 symbol-badge badge badge-circle bg-secondary start-0 top-100"><i class="text-white fa-solid fa-right-from-bracket"></i></span>Cerrar sesión</a>
							</div>
							<div class="separator my-2">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>