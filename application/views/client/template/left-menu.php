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
				<!--<li class="app-sidebar__heading text-info">
				</li>-->
				<li class="app-sidebar__heading"> 
					<span class="text-success text-center font-weight-bold" href="<?= base_url()?>" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.4em; text-align: center;">
						<strong><?php echo $this->session->userdata('nom_membre')." ".$this->session->userdata('prenom_membre')[0].".";?></strong>
					</span>
				</li>
				<hr>
				<li style="margin-top: 10px">
					<a href="<?= base_url("Home/Home_client")?>" class="<?php if($this->session->userdata('menu')=="tableau_bord"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-dashboard "></i>
						Tableau de bord
					</a>
				</li>
				<li>
					<a href="#" class="<?php if($this->session->userdata('menu')=="site"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-map-marker"></i>
							Sites d'exploitation
						<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
					</a>
					<ul class="mm-collapse">
						<li>
							<a href="<?= base_url("Site/formulaire_ajout")?>">
								<i class="fa fa-plus-circle"></i>&nbsp;
								Ajouter
							</a>
						</li>
						<?php
							if(isset($liste_site) && $liste_site->num_rows()>0)
							{
								foreach ($liste_site->result() as $row) 
								{
									?>
									<li>
										<a href="<?= base_url("Site/Home_site_client/".$row->id_site_exploitation);?>">
											<i class="fa fa-hand-o-right"></i>
											<?=$row->designation_site_exploitation;?>
										</a>
									</li>
									<?php
								}
							}
						?>
					</ul>
				</li>

				<li>
					<a href="<?= base_url("Fiche_technique/index_client")?>" class="<?php if($this->session->userdata('menu')=="Fiches"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-book"></i>
						Fiches Techniques
					</a>
				</li>
				<li>
					<a href="<?= base_url("Message/index_client")?>" class="<?php if($this->session->userdata('menu')=="Messagerie"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-commenting-o"></i>
						Messagerie
					</a>
				</li>

				<li>
					<a href="<?= base_url("profile/agenda")?>" class="<?php if($this->session->userdata('menu')=="Agenda"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-calendar"></i>
						Agenda
					</a>
				</li>
				<li>
					<a href="<?= base_url("profile")?>" class="<?php if($this->session->userdata('menu')=="profil"){echo "mm-active";}?>">
						<i class="metismenu-icon fa fa-user"></i>
						Profil
					</a>
				</li>

			</ul>
		</div>
	</div>
</div>
