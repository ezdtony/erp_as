<div class="leftside-menu">
    <!-- <?php var_dump($_SESSION) ?> -->
    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="images/aslogo.png" alt="" height="56" />
        </span>
        <span class="logo-sm">
            <img src="images/aslogo.png" alt="" height="16" />
        </span>
    </a>
    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="images/aslogo.png" alt="" height="16" />
        </span>
        <span class="logo-sm">
            <img src="images/aslogo.png" alt="" height="16" />
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-title side-nav-item"><?= $user_name ?></li>

            <li class="side-nav-item">
                <a href="index.php" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Inicio </span>
                </a>
            </li>
            <?php if ($id_area <= 3 || $_SESSION['id_area'] == 5) : ?>
                <li class="side-nav-item">
                    <?php if ($_SESSION['id_area'] == 5) : ?>
                        <a href="?submodule=personal_dev" class="side-nav-link">
                        <?php else : ?>
                            <a href="?submodule=personal" class="side-nav-link">
                            <?php endif; ?>
                            <i class="uil-users-alt"></i>
                            <span> Personal </span>
                            </a>
                </li>
            <?php endif; ?>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProyectos" aria-expanded="false" aria-controls="sidebarProyectos" class="side-nav-link">
                    <i class="uil-suitcase"></i>
                    <span> Proyectos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProyectos">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="?submodule=proyectos">Operaciones</a>
                        </li>
                        <li>
                            <a href="?submodule=proyectos_unidades">Unidades</a>
                        </li>
                        <?php if ($id_area <= 3) : ?>
                            <li>
                                <a href="?submodule=proyectos_inactivos">Inactivos</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>


            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarViaticos" aria-expanded="false" aria-controls="sidebarViaticos" class="side-nav-link">
                    <i class="uil-usd-circle"></i>
                    <span> Viáticos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarViaticos">
                    <ul class="side-nav-second-level">
                        <?php if ($id_area <= 3) : ?>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
                                    <span> Administrador </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarSecondLevel">
                                    <ul class="side-nav-third-level">
                                        <li>
                                            <a href="?submodule=saldos">Saldos</a>
                                        </li>
                                        <li>
                                            <a href="?submodule=depositos_viaticos">Depósitos</a>
                                        </li>
                                        <li>
                                            <a href="?submodule=gastos_recientes">Gastos recientes</a>
                                        </li>
                                        <li>
                                            <a href="?submodule=gastos">Todos los gastos</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if ($id_area >= 4) : ?>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false" aria-controls="sidebarThirdLevel">
                                    <span> Personal de Campo </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarThirdLevel">
                                    <ul class="side-nav-third-level">
                                        <li>
                                            <a href="?submodule=gastos_usuario">Gastos</a>
                                        </li>
                                        <li>
                                            <a href="?submodule=depositos_viaticos">Depósitos</a>
                                        </li>
                                        <?php if ($_SESSION['id_area'] == 5) : ?>
                                            <li>
                                                <a href="?submodule=send_mails">Envíar correos</a>
                                            </li>
                                        <?php endif; ?>
                                        <!-- <li>
                                        <a href="#">Mis depósitos</a>
                                    </li> -->
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
            <?php if (($_SESSION['id_areas_level']) == 19 || $_SESSION['id_areas_level'] == 21 || $id_user <= 2) : ?>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarAccesos" aria-expanded="false" aria-controls="sidebarAccesos" class="side-nav-link">
                        <i class="uil-keyhole-circle"></i>
                        <span> Accesos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAccesos">
                        <ul class="side-nav-second-level">
                            <?php if ($id_area <= 3) : ?>
                                <li>
                                    <a href="?submodule=sitios">Sitios</a>
                                </li>
                                <li>
                                    <a href="?submodule=lista_accesos">Lista de accesos</a>
                                </li>
                            <?php else : ?>
                                <li>
                                    <a href="?submodule=captura_accesos">Mis accesos</a>
                                </li>
                            <?php endif; ?>

                            <!-- <li>
                            <a href="#">Aprobados</a>
                        </li>
                        <li>
                            <a href="#">Revisión</a>
                        </li>
                        <li>
                            <a href="#">Concentrado</a>
                        </li> -->
                        </ul>
                    </div>
                </li>
            <?php endif ?>

            <?php if ($_SESSION['id_areas_level'] == 17 || $id_user <= 2  || ($id_area >= 4)) : ?>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarCompras" aria-expanded="false" aria-controls="sidebarCompras" class="side-nav-link">
                        <i class="uil-shopping-trolley"></i>
                        <span> Compras </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCompras">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="?submodule=compras_cotizaciones">Solicitudes de Material</a>
                            </li>
                            <!-- <li>
                                <a href="?submodule=solicitudes_herramienta">Solicitudes de Herramienta</a>
                            </li> -->
                            <li>
                                <a href="?submodule=kits_herramienta">Kits de Herramienta</a>
                            </li>
                            <!-- 
                            <li>
                                <a href="?submodule=solicitudes_herramienta">Compra de Herramienta</a>
                            </li> -->
                            <?php if ($_SESSION['id_areas_level'] == 17 || $id_user <= 2) : ?>

                                <!-- <li>
                                    <a href="?submodule=inventario_material">Inventario de material</a>
                                </li> -->
                                <li>
                                    <a href="?submodule=inventario_herramienta">Inventario de herramienta</a>
                                </li>

                                <!-- <li>
                                    <a href="?submodule=asignaciones_herramienta">Asignaciones de herramienta</a>
                                </li> -->

                                <li>
                                    <a href="?submodule=catalogo_material">Catálogo de material</a>
                                </li>

                                <li>
                                    <a href="?submodule=info_auxiliar_material">Información Auxiliar Material</a>
                                </li>
                                <li>
                                    <a href="?submodule=info_auxiliar_herramienta">Información Auxiliar Herramientas</a>
                                </li>
                            <?php endif; ?>


                            <!-- <li>
                            <a href="#">Solicitudes</a>
                        </li>
                        <li>
                            <a href="#">Registro de Compras</a>
                        </li>
                        <li>
                            <a href="#">Revisión</a>
                        </li>
                        <li>
                            <a href="#">Proveedores</a>
                        </li> -->
                        </ul>
                    </div>
                </li>
            <?php endif; ?>
            <!--
                
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInventarios" aria-expanded="false" aria-controls="sidebarInventarios" class="side-nav-link">
                    <i class="uil-clipboard-notes"></i>
                    <span> Inventarios </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInventarios">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-email-inbox.html">Almacenes</a>
                        </li>
                        <li>
                            <a href="#">Kits</a>
                        </li>
                        <li>
                            <a href="#">Asignaciones</a>
                        </li>
                        <li>
                            <a href="#">Listas de Material</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarMantenimiento" aria-expanded="false" aria-controls="sidebarMantenimiento" class="side-nav-link">
                    <i class="uil-car-sideview"></i>
                    <span> Vehículos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarMantenimiento">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-email-inbox.html">Revisión General</a>
                        </li>
                        <li>
                            <a href="#">Comporbar Gasolina</a>
                        </li>
                        <li>
                            <a href="#">Solcitu</a>
                        </li>
                        <li>
                            <a href="#">Concentrado</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="apps-chat.html" class="side-nav-link">
                    <i class="uil-chart-line"></i>
                    <span> Gráficas </span>
                </a>
            </li> -->

            <!--             <?php if ($id_area <= 3) { ?>
                <li class="side-nav-item">
                    <a href="?submodule=creditos" class="side-nav-link">
                        <i class=" uil-bill"></i>
                        <span> Créditos </span>
                    </a>
                </li>
            <?php } ?> -->


            <?php if ($id_area <= 3) { ?>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarMantenimiento" aria-expanded="false" aria-controls="sidebarMantenimiento" class="side-nav-link">
                        <i class="uil-car-sideview"></i>
                        <span> Vehículos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMantenimiento">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="#">Unidades</a>
                            </li>
                            <li>
                                <a href="?submodule=administrar_checklist">Administrar Check - List</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a href="?submodule=reportes" class="side-nav-link">
                        <i class=" uil-file-medical-alt"></i>
                        <span> Reportes </span>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <!-- Help Box -->
        <!-- <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-end close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">Unlimited Access</h5>
            <p class="mb-3">
                Upgrade to plan to get access to unlimited reports
            </p>
            <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
        </div> -->
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->