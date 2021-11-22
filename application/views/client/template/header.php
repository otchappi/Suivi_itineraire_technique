<!DOCTYPE html>
<html lang="en">

	<?php include_once "head.php" ?>
	<body>
	<div id="fakeloader-overlay" class="visible incoming">
		<div class="loader-wrapper-outer">
			<div class="loader-wrapper-inner">
				<div class="loader"></div>
			</div>
		</div>
	</div>
	<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
		<div class="app-header header-shadow">
			<div class="app-header__logo">
				<div class="logo-src" >
                    <img src="<?php echo base_url('assets/images/logo-gauche.png');?>" alt="SSA" width="200" height="40">
                </div>
				<div class="header__pane ml-auto">
					<div>
						<button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
						</button>
					</div>
				</div>
			</div>
			<div class="app-header__mobile-menu">
				<div>
					<button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
					</button>
				</div>
			</div>
			<div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-success btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
			</div>    <div class="app-header__content">
				<div class="app-header-right">
					<div class="header-btn-lg pr-0">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="btn-group">
										<a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
											<img width="42" class="rounded-circle" src="<?php echo base_url($this->session->userdata('photo_membre')); ?>" alt="Avatar">
											<i class="fa fa-angle-down ml-2 opacity-8"></i>
										</a>
										<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="<?= base_url() ?>profile" type="button" tabindex="0" class="dropdown-item">
                                                <i class="metismenu-icon fa fa-user"></i> &nbsp Profil
                                            </a>
										      <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="<?php echo base_url("Index/verrouiller_session"); $this->session->set_userdata('page',uri_string()); ?>" type="button" tabindex="0" class="dropdown-item">
                                                <i class="metismenu-icon fa fa-lock"></i> &nbsp Mettre en veille
                                            </a>
                                            <a href="<?= base_url() ?>Index/deconnexion" type="button" tabindex="0" class="dropdown-item">
                                                <i class="metismenu-icon fa fa-sign-out"></i> &nbsp Déconnexion
                                            </a>
										</div>
									</div>
								</div>
								<div class="widget-content-left  ml-3 header-user-info">
									<div class="widget-heading" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.5em; text-transform:uppercase;">
										<?php echo $this->session->userdata('nom_membre')." ".$this->session->userdata('prenom_membre')[0].".";?>
									</div>
								</div>
							</div>
						</div>
					</div>        </div>
			</div>
		</div>
		<div class="app-main">