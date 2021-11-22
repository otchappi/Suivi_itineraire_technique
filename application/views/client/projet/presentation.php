<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
	<?php
		if($infos_projet->num_rows()>0)
		{
			foreach ($infos_projet->result() as $row) 
			{
				$titre_projet=$row->titre_projet;
				$date_debut_projet=$row->date_debut_projet;
				$date_fin_projet=$row->date_fin_projet;
				$etat_projet=$row->etat_projet;
				$budget_projet=$row->budget_projet;
				$date_echeance_projet=$row->date_echeance_projet;
				$resume_projet=$row->resume_projet;
				$attente_projet=$row->attente_projet;
			}
		}
	?>
<style type="text/css">
	p
	{
		text-indent: 3em;
		text-align: justify;
		font-family: "Times New Roman", serif;
		font-size: 1.15em;
	}
</style>
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-clipboard icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Présentation
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/presentation');?>" class="text-success">
						Présentation &nbsp;
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">	
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-tasks" style="font-size:2em;"> </span> &nbsp; | 
						Identité
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<td style="width: 25%;"><strong>Titre</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<p><?php 
												if(isset($titre_projet))
												{ 
													echo $titre_projet;
												}
											?></p>
										</td>
									</tr>
									<tr>
										<td><strong>Attentes</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<p><?php 
												if(isset($attente_projet) && $attente_projet!="")
												{ 
													echo $attente_projet;
												}
												else
												{
													echo "/";
												}
											?></p>
										</td>
									</tr>
									<tr>
										<td><strong>Date de début</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<?php 
												if(isset($date_debut_projet))
												{ 
													echo $date_debut_projet;
												}
												else
												{
													echo "/";
												}
											?>
										</td>
									</tr>
									<tr>
										<td><strong>Date d'écheance</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<?php 
												if(isset($date_echeance_projet))
												{ 
													echo $date_echeance_projet;
												}
												else
												{
													echo "/";
												}
											?>
										</td>
									</tr>
									<tr>
										<td><strong>Date de fin</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<?php 
												if(isset($date_fin_projet) && $date_fin_projet!="0000-00-00")
												{ 
													echo $attente_projet;
												}
												else
												{
													echo "/";
												}
											?>
										</td>
									</tr>
									<tr>
										<td><strong>Budget</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<?php 
												if(isset($budget_projet))
												{ 
													echo number_format($budget_projet,2,',',' ');
												}
											?>
											F cfa
										</td>
									</tr>
								</table>
								
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-warning">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-line-chart" style="font-size:2em;"> </span> &nbsp; | 
						Etat d'avancement
					</div>
					<div class="card-body">
						<div class="scroll-area-xl">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<td style="width: 25%;"><strong>Etat</strong></td>
										<td style="width: 2%;">:</td>
										<td>
											<?php 
												if(isset($etat_projet))
												{ 
													?>
													<div class="widget-content">
														<div class="widget-content-outer">
															<div class="widget-content-wrapper">
																<div class="widget-content-left pr-2 fsize-1">
																	<div class="widget-numbers mt-0 fsize-3 text-success"><?=$etat_projet;?>%</div>
																</div>
																<div class="widget-content-right w-100">
																	<div class="progress-bar-xs progress">
																		<div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?=$etat_projet;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$etat_projet;?>%;"></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<?php
												}
												else
												{
													echo "/";
												}
											?>
										</td>
									</tr>
								</table>

							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 100px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 50px;"></div></div></div>
						</div>
					</div>
				</div>							
			</div>
			<div class="col-lg-6">
				<div class="main-card mb-3 card">
					<div class="card-header bg-info">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-align-justify" style="font-size:2em;"> </span> &nbsp; | 
						Résumé du projet
					</div>
					<div class="card-body">
						<div class="scroll-area-md">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<td>
											<p><?php 
												if(isset($resume_projet) && $resume_projet!="")
												{ 
													echo $resume_projet;
												}
												else
												{
													echo "/";
												}
											?></p>
										</td>
									</tr>
								</table>

							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-focus">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-square" style="font-size:2em;"> </span> &nbsp; | 
						Actions
					</div>
					<div class="card-body">
						<div class="scroll-area-xl">
							<div class="scrollbar-container ps--active-y ps">
								<br>
								<a class="btn-wide btn-shadow btn btn-outline-success" style="width:100%;" href="<?=base_url("Projet/generer_bilan");?>">
                                    Télécharger le bilan
                                </a>
                                <hr>
                                <a class="btn-wide btn-shadow btn btn-outline-warning" style="width:100%;" href="<?=base_url("Projet/modifier_projet");?>">
	                                Modifier le projet
	                            </a>
                                <hr>
                                <a class="btn-wide btn-shadow btn btn-outline-primary" style="width:100%;" href="<?=base_url("Projet/cloturer_projet");?>">
	                                Clôturer le projet
	                            </a>
	                            <br>
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 100px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 50px;"></div></div></div>
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
