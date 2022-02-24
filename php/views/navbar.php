<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">
    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="images/logo_chuen_light.png" alt="" height="36" />
        </span>
        <span class="logo-sm">
            <img src="images/logo_chuen_light.png" alt="" height="16" />
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="images/logo_chuen_light.png" alt="" height="16" />
        </span>
        <span class="logo-sm">
            <img src="images/logo_chuen_light.png" alt="" height="16" />
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

            <li class="side-nav-item">
                <a href="?submodule=solicitudes" class="side-nav-link">
                    <i class="uil-comment-plus"></i>
                    <span> Solicitudes </span>
                </a>
            </li>
            <?php if ($id_area <= 3) { ?>
                <li class="side-nav-item">
                    <a href="?submodule=creditos" class="side-nav-link">
                        <i class=" uil-bill"></i>
                        <span> Créditos </span>
                    </a>
                </li>
            <?php } ?>

            <!--  <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="uil-bill"></i>
                    <span> Reembolsos </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-email-inbox.html">Captura</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Aprobados</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Revisión</a>
                        </li>
                        <li>
                            <a href="apps-email-read.html">Concentrado</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="apps-chat.html" class="side-nav-link">
                    <i class="uil-chart-line"></i>
                    <span> Gráficas </span>
                </a>
            </li>
-->
            <?php
            if ($id_area <= 3 or $id_area >= 5) { ?>
                <li class="side-nav-item">
                    <a href="?submodule=reportes" class="side-nav-link">
                        <i class=" uil-file-medical-alt"></i>
                        <span> Reportes </span>
                    </a>
                </li>
                <?php if ($id_area <= 3) { ?>
                    <li class="side-nav-item">
                        <a href="?submodule=graficas" class="side-nav-link">
                            <i class=" uil-chart-line"></i>
                            <span> Gráficas </span>
                        </a>
                    </li>
                <?php } ?>
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