<div class="app-sidebar sidebar-shadow">
	<div class="app-header__logo">
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
			<button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
				<span class="btn-icon-wrapper">
					<i class="fa fa-ellipsis-v fa-w-6"></i>
				</span>
			</button>
		</span>
	</div>
	<div class="scrollbar-sidebar">
		<div class="app-sidebar__inner">
			<ul class="vertical-nav-menu">
				<li class="app-sidebar__heading"> 
					<span class="text-success text-center font-weight-bold" href="<?= base_url()?>" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.4em; text-align: center;">
						<strong><?php echo $this->session->userdata('nom_membre')." ".$this->session->userdata('prenom_membre')[0].".";?></strong>
					</span>
				</li>
				<hr>
				<li style="margin-top: 10px">
					<a href="<?= base_url("Site/Home_site_client/".$this->session->userdata('id_site'))?>" class="<?php if($this->session->userdata('menu')=="Presentation"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-map-o "></i>
						Présentation
					</a>
				</li>
				<li>
					<a href="<?= base_url("Site/projet_site")?>" class="<?php if($this->session->userdata('menu')=="Projet"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-tasks"></i>
						Projets
					</a>
				</li>
				<li>
					<a href="<?= base_url("Site/antecedant")?>" class="<?php if($this->session->userdata('menu')=="Antecedants"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-suitcase"></i>
						Antécédants
					</a>
				</li>
				<li>
					<a href="<?= base_url("Site/statistique")?>" class="<?php if($this->session->userdata('menu')=="Statistiques"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-pie-chart"></i>
						Statistiques
					</a>
				</li>
				<li>
					<a href="<?= base_url("Home/Home_client")?>" class="<?php if($this->session->userdata('menu')=="Accueil"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-mail-reply"></i>
						Accueil
					</a>
				</li>

			</ul>
		</div>
	</div>
</div>
