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
					<a href="<?= base_url("Projet/Home_projet_client/".$this->session->userdata('id_projet'))?>" class="<?php if($this->session->userdata('menu')=="tableau_bord"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-dashboard "></i>
						Tableau de Bord
					</a>
				</li>
				<li style="margin-top: 10px">
					<a href="<?= base_url("Projet/alerte")?>" class="<?php if($this->session->userdata('menu')=="alerte"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-bell-o "></i>
						Alertes
					</a>
				</li>
				<li style="margin-top: 10px">
					<a href="<?= base_url("Projet/presentation")?>" class="<?php if($this->session->userdata('menu')=="Presentation"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-clipboard"></i>
						Présentation
					</a>
				</li>
				<li>
					<a href="<?= base_url("Site/projet_site")?>" class="<?php if($this->session->userdata('menu')=="Evolution"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-line-chart"></i>
						Evolution
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/tache")?>" class="<?php if($this->session->userdata('menu')=="tache"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-tasks"></i>
						Tâche
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/activite")?>" class="<?php if($this->session->userdata('menu')=="activite"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-sort-amount-asc"></i>
						Activité
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/agenda")?>" class="<?php if($this->session->userdata('menu')=="Agenda"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-calendar"></i>
						Agenda
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/detail_fiche")?>" class="<?php if($this->session->userdata('menu')=="Culture"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-leaf"></i>
						Culture
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/statistique")?>" class="<?php if($this->session->userdata('menu')=="Devis"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-bitcoin"></i>
						Devis
					</a>
				</li>
				<li>
					<a href="<?= base_url("Projet/rapport")?>" class="<?php if($this->session->userdata('menu')=="Rapports"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-book"></i>
						Rapports
					</a>
				</li>
				<li>
					<a href="<?= base_url("Site/Home_site_client/".$this->session->userdata("id_site"))?>" class="<?php if($this->session->userdata('menu')=="retour"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-mail-reply"></i>
						Retour
					</a>
				</li>

			</ul>
		</div>
	</div>
</div>
