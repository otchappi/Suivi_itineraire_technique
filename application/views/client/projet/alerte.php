<title><?php echo $titre_page. ' - '.  'SSA'?> </title>

<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-bell-o icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Alertes
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/alerte');?>" class="text-success">
						Alertes &nbsp;
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">	
				<div class="main-card mb-3 card">
					<div class="card-header bg-danger">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-tasks" style="font-size:2em;"> </span> &nbsp; | 
						Tâches hors delais
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped table-bordered" style="width: 100%;">
									<tr style="text-align:center;">
										<th>Désignation</th>
										<th >Début le</th>
										<th >Echeance le</th>
										<th >Etat</th>
										<th >Retard de</th>
									</tr>
									<?php
									if(isset($liste_tache_hors_delais))
									{
										if($liste_tache_hors_delais->num_rows()>0)
										{											
											foreach ($liste_tache_hors_delais->result() as $row) 
											{
												?>
													<tr style="text-align:justify;">
														<td>
															<?php 
																if(isset($row->intitule_tache))
																{ 
																	echo $row->intitule_tache;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->date_debut_tache))
																{ 
																	echo $row->date_debut_tache;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->date_echeance_tache))
																{ 
																	echo $row->date_echeance_tache;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->etat_tache))
																{ 
																	echo $row->etat_tache;
																}
															?>%
														</td>
														<td style="font-weight: bold;" class="text-danger">
															<?php
																if(isset($row->date_echeance_tache))
																{
																	$date_echeance= new DateTime($row->date_echeance_tache);
																	$date_jour=new DateTime(date("Y-m-d"));
																	$temps=date_diff($date_jour,$date_echeance);
																	echo $temps->format('%m mois %d jours');
																}												
															?>
														</td>
													</tr>
												<?php
											}													
										}
										else
										{
											?>
												<tr>
													<td colspan="6" class="text-center">
														<span class=" text-success font-weight-bold text-center">
															Bonne nouvelle !
															<br/>Aucune tâche n'est hors delais
														</span>
													</td>
												</tr>
											<?php
										}
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
					<div class="card-header bg-warning">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-sort-amount-asc" style="font-size:2em;"> </span> &nbsp; | 
						Activités proches
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped table-bordered" style="width: 100%;">
									<tr style="text-align:center;">
										<th>Désignation</th>
										<th>Description</th>
										<th>Prevu le</th>
									</tr>
									<?php
										if(isset($designation_activite_proche))
										{
											for ($i=0;$i<count($designation_activite_proche);$i++) 
											{
												?>
												<tr style="text-align:justify;">
													<td>
														<?=$designation_activite_proche[$i];?>
													</td>
													<td>
														<?=$description_activite_proche[$i];?>
													</td>
													<td>
														<span class="font-weight-bold" style="color: red; font-size:1.1em; font-weight: 'Times New Roman',serif;"><?=$date_activite_proche[$i];?></span>
													</td>													
												</tr>
												<?php
											}											
										}
										else
										{
											?>
												<tr>
													<td colspan="3" class="text-center">
														<span class=" text-success font-weight-bold text-center">
															Respirez !
															<br/>Aucune activité à l'horizon
														</span>
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
