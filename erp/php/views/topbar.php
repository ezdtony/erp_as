<?php
 include_once('php/models/user_information_table.php');
 $user_information_table = new UserArchives();
?>
<div class="content-page">
    <div class="content">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topbar-menu float-end mb-0">

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="account-user-avatar">
                            <?php
                            $profile_pic = $user_information_table->getProfilePic($_SESSION['id_user']);
                            if (file_exists($profile_pic)) { ?>
                                <img src="<?= $user_information_table->getProfilePic($_SESSION['id_user']) ?>" alt="user-image" class="rounded-circle">
                                <?php
                            }else{
                                ?>
                                <img src="images/user_default.png" alt="user-image" class="rounded-circle">
                                <?php
                            }
                            ?>
                            
                        </span>
                        <span>
                            <span class="account-user-name"><?= $_SESSION['user'] ?></span>
                            <span class="account-position"><?= $txt_area_level ?></span>
                        </span>
                    </a>
                    <div class="
                    dropdown-menu dropdown-menu-end dropdown-menu-animated
                    topbar-dropdown-menu
                    profile-dropdown
                  ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenido !</h6>
                        </div>

                        <!-- item-->
                        <a href="LogIn.php?#" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </div>
                </li>
            </ul>
            <button class="button-menu-mobile open-left">
                <i class="mdi mdi-menu"></i>
            </button>


        </div>
        <!-- end Topbar -->