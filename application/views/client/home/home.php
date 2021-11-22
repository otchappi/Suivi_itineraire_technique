<?php
	if($this->session->userdata('operation')!='')
	{
		if($this->session->userdata("incorrect"))
		{
			?>
			<script type="text/javascript">
				alert('Enregistrement effectué avec succès mais pas de changement du mot de passe !');
			</script>
			<?php
		}
		else
		{
			if($this->session->userdata('operation'))
			{?>
				<script type="text/javascript">
					alert('Enregistrement effectué avec succès !');
				</script><?php
			}
		}
		$this->session->unset_userdata('operation');
		$this->session->unset_userdata('incorrect');
	}
?>

<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-dashboard icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Tableau de Bord
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a class="text-success" href="<?php  echo base_url('Home/Home_client');?>">Tableau de Bord &nbsp</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="mb-3 card">
					<div class="card-header-tab card-header bg-danger" >
						<div class="card-header-title" >
							<i class="header-icon lnr-bicycle "> </i>&nbsp;
							<span class="fa fa-bell-o" style="font-size:2em;"> </span> &nbsp; | 
							Alerte
						</div>
						<ul class="nav bg-light">
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-0" class="active nav-link">
									Tâches Hors delais
								</a>
							</li>
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-1" class="nav-link ">
									Activités proches
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active show" id="tab-eg5-0" role="tabpanel">
								<div>
									<ul class="list-group">
										<?php
										if(isset($liste_tache_hors_delais) && $liste_tache_hors_delais->num_rows()>0)
										{
											foreach ($liste_tache_hors_delais->result() as $row) 
											{
												?>
												<button class="list-group-item-action list-group-item">
													<strong>Projet :</strong> <span style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$row->titre_projet;?> </span> 
													<br/><strong>Désignation :</strong>  <span style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$row->intitule_tache;?> </span>
													<br/><strong>Prévu du :</strong> <span style="color: red; font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$row->date_debut_tache;?> au <?=$row->date_echeance_tache;?> </span>
												</button>
												<?php
											}											
										}
										else
										{
											?>
											<button class="list-group-item-action list-group-item text-success font-weight-bold text-center">
												Bonne nouvelle !
												<br/>Aucune tâche n'est hors delais
											</button>
											<?php
										}
										?>								
										
									</ul>
								</div>
							</div>
							<div class="tab-pane show" id="tab-eg5-1" role="tabpanel">
								<div>
									<ul class="list-group">
										<?php
										if(isset($designation_activite_proche))
										{
											for ($i=0;$i<count($designation_activite_proche);$i++) 
											{
												?>
												<button class="list-group-item-action list-group-item">
													<strong>Projet :</strong> <span style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$projet_activite_proche[$i];?> </span> 
													<br/><strong>Désignation :</strong>  <span style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$designation_activite_proche[$i];?> </span>
													<br/><strong>Prévu le :</strong> <span style="color: red; font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$date_activite_proche[$i];?></span>
												</button>
												<?php
											}											
										}
										else
										{
											?>
											<button class="list-group-item-action list-group-item text-success font-weight-bold text-center">
												Aucune activité en vue
											</button>
											<?php
										}
										?>	
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-newspaper-o" style="font-size:2em;"> </span> &nbsp; | 
						Actualités
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<th colspan="2">Nouveaux messages</th>
									</tr>
										<?php
										if(isset($liste_new_message) && count($liste_new_message)>0)
										{
											$i=1;
											foreach ($liste_new_message as $row) 
											{
												if($i<=5)
												{
													$i++;
													?>
														<tr>															
															<td><strong>
																<?=$row->objet_message;?>
															</strong></td>
															<td>
																<?=$row->contenu_message;?>
															</td>
														</tr>
													<?php
												}												
											}											
										}
										else
										{
											?>
											<tr>
												<td colspan="2" class="text-center">
													Aucun nouveau message
												</td>
											</tr>
											<?php
										}
										?>									
								</table>
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<th colspan="2">Nouvelles Fiches Techniques</th>
									</tr>
									<?php
									if(isset($liste_new_culture) && $liste_new_culture->num_rows()>0)
									{
										foreach ($liste_new_culture->result() as $row) 
										{
											?>
												<tr>															
													<td style="width:15%;">
														<img src="<?php echo base_url($row->image_culture); ?>" class="img-rounded" alt="Ma photo" style="width: 100%;height:50px;" />
													</td>
													<td><strong>
														<?=$row->designation_culture;?>
													</strong></td>
												</tr>
											<?php											
										}											
									}
									else
									{
										?>
										<tr>
											<td colspan="2" class="text-center">
												Aucune nouvelle culture
											</td>
										</tr>
										<?php
									}
									?>
								</table>
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<th colspan="2">Nouvelles annonces</th>
									</tr>
									<?php
										if(isset($liste_new_annonce) && $liste_new_annonce->num_rows()>0)
										{
											$i=1;
											foreach ($liste_new_annonce->result() as $row) 
											{
												if($i<=5)
												{
													$i++;
													?>
														<tr>															
															<td><strong>
																<?=$row->titre_annonce;?>
															</strong></td>
															<td>
																<span style="max-height: 50px; overflow: hidden;">
											                        <?php echo $row->contenu_annonce; ?>
											                    </span>
															</td>
														</tr>
													<?php
												}												
											}											
										}
										else
										{
											?>
											<tr>
												<td colspan="2" class="text-center">
													Aucun nouvelle annonce
												</td>
											</tr>
											<?php
										}
										?>	
								</table>
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-calendar" style="font-size:2em;"> </span> &nbsp; | 
						Planning
					</div>
					<div class="card-body">
						<div class="scroll-area-sm">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr>
											<th>Projet</th>
											<th>Description de la tâche</th>
										</tr>
									</thead>
									<tr>
										<th colspan="2" class="text-info">Tâches du jour</th>
									</tr>
									<?php
									if(isset($liste_tache_auday) && $liste_tache_auday->num_rows()>0)
									{
										foreach ($liste_tache_auday->result() as $row) 
										{
											?>
												<tr>															
													<td>
														<strong>
																<?=$row->titre_projet;?>
														</strong>
													</td>
													<td>
											            <?php echo $row->description_tache; ?>
													</td>
												</tr>
											<?php											
										}											
									}
									else
									{
										?>
										<tr>
											<td colspan="2" class="text-center">
												Aucune tâche prevu pour Aujourd'hui
											</td>
										</tr>
										<?php
									}
									?>
								</table>
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<th colspan="2" class="text-focus">Tâches de demain</th>
									</tr>
									<?php
									if(isset($liste_tache_morrow) && $liste_tache_morrow->num_rows()>0)
									{
										foreach ($liste_tache_morrow->result() as $row) 
										{
											?>
												<tr>															
													<td>
														<strong>
																<?=$row->titre_projet;?>
														</strong>
													</td>
													<td>
											            <?php echo $row->description_tache; ?>
													</td>
												</tr>
											<?php											
										}											
									}
									else
									{
										?>
										<tr>
											<td colspan="2" class="text-center">
												Aucune tâche prevu pour demain
											</td>
										</tr>
										<?php
									}
									?>
								</table>
								
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-bar-chart" style="font-size:2em;"> </span> &nbsp; | 
						Statistiques
					</div>
					<div class="card-body">
						<div class="scroll-area-md">
							<div class="scrollbar-container ps--active-y ps">
								<div class="row">
									<div class="card col-md-5 text-white bg-white">
										<div class="card-body">
											<div class="widget-numbers text-success text-center font-weight-bold"><span style="text-align:center; font-size:1.4em;"><?=$nb_culture;?></span></div>
										</div>
										<div class="card-footer bg-grow-early font-weight-bold" >
											<span style="text-align:center; font-size:1.2em;"> Cultures</span>
										</div>
									</div>
									<div class="col-md-2"></div>
									<div class="card col-md-5 text-white bg-white">
										<div class="card-body">
											<div class="widget-numbers text-focus text-center font-weight-bold"><span style="text-align:center; font-size:1.4em;"><?=$nb_projet;?></span></div>
										</div>
										<div class="card-footer bg-focus font-weight-bold">
											<span style="text-align:center; font-size:1.2em;"> Projets</span>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="card col-md-5 text-white bg-white">
										<div class="card-body">
											<div class="widget-numbers text-alternate text-center font-weight-bold">
												<span style="text-align:center; font-size:1.4em;"><?=$nb_site;?></span>
											</div>
										</div>
										<div class="card-footer bg-alternate font-weight-bold">
											<span style="text-align:center; font-size:1.2em;"> Sites</span>
										</div>
									</div>
									<div class="col-md-2"></div>
									<div class="card col-md-5 text-white bg-white">
										<div class="card-body">
											<div class="widget-numbers text-info text-center font-weight-bold"><span style="text-align:center; font-size:1.4em;"><?=$nb_rapport;?></span></div>
										</div>
										<div class="card-footer bg-info font-weight-bold">
											<span style="text-align:center; font-size:1.2em;"> Rapports</span>
										</div>
									</div>
								</div>
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	</div>
</div>
</div>
	<style>
		.loader {
			alignment: center;
			border: 2px solid #f3f3f3;
			border-radius: 50%;
			border-top: 2px solid #3498db;
			width: 50px;
			height: 50px;
			-webkit-animation: spin 2s linear infinite; /* Safari*/
			animation: spin 2s linear infinite;
		}

	</style>
