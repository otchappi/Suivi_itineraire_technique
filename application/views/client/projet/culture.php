<title><?php echo $titre_page. ' - '.  'SSA'?> </title>

<style type="text/css">
	p
	{
		text-indent: 4em;
		text-align: justify;
		font-family: "Times New Roman", serif;
		font-size: 1.2em;
	}
</style>
	<?php
		if($details_culture->num_rows()>0)
		{
			foreach ($details_culture->result() as $row) 
			{
				$designation_culture=$row->designation_culture;
				$image_culture=$row->image_culture;
				$definition_culture=$row->definition_culture;
				$identification_culture=$row->identification_culture;
				$risque_culture=$row->risque_culture;
				$condition_culture=$row->condition_culture;
			}
		}
	?>
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-book icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Culture
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/detail_fiche');?>" class="text-success">
						Culture &nbsp;
					</a> / <?php if(isset($designation_culture)){ echo $designation_culture;} ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="mb-3 card">
					<div class="card-header-tab card-header bg-success" >
						<div class="card-header-title" >
							<i class="header-icon lnr-bicycle "> </i>&nbsp;
							<span class="fa fa-leaf" style="font-size:2em;"> </span> &nbsp; | 
							<?php if(isset($designation_culture)){ echo $designation_culture;} ?>
						</div>
						<ul class="nav bg-light">
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-0" class="active nav-link">
									Définition
								</a>
							</li>
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-1" class="nav-link ">
									Identification
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active show" id="tab-eg5-0" role="tabpanel">
								<table class="table table-striped" style="width: 100%;">
									<tr>
										<td style="width: 35%;">
											<img src="<?php if(isset($image_culture)){ echo base_url($image_culture);} ?>" class="img-rounded" alt="<?php if(isset($designation_culture)){ echo $designation_culture;} ?>" style="width: 100%;height:200px;" />
										</td>
										<td>
											<p><?php if(isset($definition_culture)){ echo $definition_culture;} ?></p>
										</td>
									</tr>
								</table>
							</div>
							<div class="tab-pane show" id="tab-eg5-1" role="tabpanel">
								<p>
									<?php if(isset($identification_culture)){ echo $identification_culture;} ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="mb-3 card">
					<div class="card-header-tab card-header bg-success" >
						<div class="card-header-title" >
							<i class="header-icon lnr-bicycle "> </i>&nbsp;
							<span class="fa fa-shield" style="font-size:2em;"> </span> &nbsp; | 
							Avant de se lancer
						</div>
						<ul class="nav bg-light">
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-2" class="active nav-link">
									Risques
								</a>
							</li>
							<li class="nav-item">
								<a data-toggle="tab" href="#tab-eg5-3" class="nav-link ">
									Conditions
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active show" id="tab-eg5-2" role="tabpanel">
								<p>
									<?php if(isset($risque_culture)){ echo $risque_culture;} ?> 
								</p>
							</div>
							<div class="tab-pane show" id="tab-eg5-3" role="tabpanel">
								<p>
									<?php if(isset($condition_culture)){ echo $condition_culture;} ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-lightbulb-o" style="font-size:2em;"> </span> &nbsp; | 
						Astuces
					</div>
					<div class="card-body">
						<div class="scroll-area-md">
							<div class="scrollbar-container ps--active-y ps">
								<?php 
									if(isset($liste_astuces))
									{
										if($liste_astuces->num_rows()>0)
										{											
											foreach ($liste_astuces->result() as $row) 
											{
												?>
												<table class="table table-striped" style="width: 100%;">
													<tr>
														<th colspan="2"><?php if(isset($row->titre_astuce)){ echo $row->titre_astuce;} ?></th>
													</tr>
													<tr>
														<td style="width: 25%;">
															<a href="<?php if($row->image_astuce!=""){ echo base_url($row->image_astuce);} else{ echo base_url("assets/images/astuces/astuce.png");} ?>" target="_blank" title="Apercu">
																<img src="<?php if($row->image_astuce!=""){ echo base_url($row->image_astuce);} else{ echo base_url("assets/images/astuces/astuce.png");} ?>" class="img-rounded" alt="Astuce" style="width: 100%;height:100px;" />
															</a>															
														</td>
														<td>
															<?php if(isset($row->contenu_astuce)){ echo $row->contenu_astuce;} ?>
														</td>
													</tr>
												</table>
												<?php
											}													
										}
										else
										{
											?>
												<table class="table table-striped" style="width: 100%;">
													<tr>
														<th colspan="2" style="text-align:center; font-size: 1.2em;">Aucune astuce disponible</th>
													</tr>
												</table>
											<?php
										}
									}
								?>
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-book" style="font-size:1.8em;"> </span> &nbsp; | 
						Documentation
					</div>
					<div class="card-body">
						<div class="scroll-area-sm">
							<div class="scrollbar-container ps--active-y ps">
								<div class="card">
									<table class="table table-striped table-bordered" style="width: 100%;">
										<tr>
											<th>Titre du document</th>
											<th>Action</th>
										</tr>
										<?php 
											if(isset($liste_document))
											{
												if($liste_document->num_rows()>0)
												{										
													foreach ($liste_document->result() as $row) 
													{
														?>
														<tr>
															<td><?php echo $row->titre_document; ?></td>
															<td>
																<a style="width:100%;" class="btn-wide btn-shadow btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$row->titre_document?>" href="<?=base_url($row->emplacement_document);?>" target="_blank">
						                                            Télécharger
						                                        </a>
															</td>
														</tr>
														<?php
													}
												}
												else
												{
													?>
													<tr>
														<td colspan="2" class="text-center">Aucun document trouvé</td>
													</tr>
													<?php
												}
											}
											?>
									</table>
								</div>
								
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-medkit" style="font-size:2em;"> </span> &nbsp; | 
						Maladies
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped table-bordered" style="width: 100%;">
									<tr style="text-align:center;">
										<th>Nom</th>
										<th >Description</th>
										<th >Cause</th>
										<th >Solution</th>
									</tr>
									<?php
									if(isset($liste_maladie))
									{
										$i=0;
										if($liste_maladie->num_rows()>0)
										{											
											foreach ($liste_maladie->result() as $row) 
											{
												?>
													<tr style="text-align:justify;">
														<td>
															<?php 
																if(isset($row->designation_maladie))
																{ 
																	echo $row->designation_maladie;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->description_maladie))
																{ 
																	echo $row->description_maladie;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->cause_maladie))
																{ 
																	echo $row->cause_maladie;
																}
															?>
														</td>
														<td>
															<?php 
																if($liste_solution[$i]!="")
																{ 
																	echo $liste_solution[$i];
																}
																else
																{
																	echo "Aucune solution disponible";
																}
															?>
														</td>
													</tr>
												<?php
												$i=$i+1;
											}													
										}
										else
										{
											?>
												<tr>
													<th colspan="4" style="text-align:center; font-size: 1.2em;">Aucune maladie enregistrée</th>
												</tr>
											<?php
										}
									}
									?>
								</table>
								
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
					<div class="card-footer">
							<div class="col-md-10"> </div>
							<div class="col-md-2">
								<button type="button" class="btn-transition btn btn-outline-success" data-toggle="modal" data-target="#maladie">
									Agrandir
								</button>
							</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-money" style="font-size:2em;"> </span> &nbsp; | 
						Compte d'exploitation (Pour 1 m<sup>2</sup>)
					</div>
					<div class="card-body">
						<div class="scroll-area-md">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped table-bordered" style="width: 100%;">
									<tr style="text-align:center;">
										<th>Désignation</th>
										<th >Prix Unitaire</th>
										<th >Quantité</th>
										<th >Total (Fcfa)</th>
									</tr>
									<?php
									if(isset($compte_exploitation))
									{
										if($compte_exploitation->num_rows()>0)
										{											
											foreach ($compte_exploitation->result() as $row) 
											{
												?>
													<tr style="text-align:justify;">
														<td>
															<?php 
																if(isset($row->designation_compte_exploitation))
																{ 
																	echo $row->designation_compte_exploitation;
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->prix_unitaire))
																{ 
																	echo number_format($row->prix_unitaire,2,',',' ');
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->quantite))
																{ 
																	echo number_format($row->quantite,2,',',' ');
																}
															?>
														</td>
														<td>
															<?php 
																if(isset($row->quantite) && isset($row->prix_unitaire))
																{ 
																	echo number_format($row->quantite*$row->prix_unitaire,2,',',' ');
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
													<th colspan="4" style="text-align:center; font-size: 1.2em;">Aucun élement enregistré</th>
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
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-th-list" style="font-size:1.8em;"> </span> &nbsp; | 
						Grandes Etapes
					</div>
					<div class="card-body">
						<div class="scroll-area-md">
							<div class="scrollbar-container ps--active-y ps">
								<?php 
								if(isset($liste_sous_etape))
								{
									if($liste_sous_etape->num_rows()>0)
									{											
										?>
										<div class="card">
											<table class="table table-striped" style="width: 100%;">
												<?php
												$id_etape=0;
												$nb_se=1;
												foreach ($liste_sous_etape->result() as $row) 
												{
													?>
													<?php
													if($id_etape!=$row->id_etape)
													{
														$id_etape=$row->id_etape;
														$nb_se=1;
														?>
														<tr>
															<th>Etape : </th>
															<th colspan="2"><?=$row->designation_etape;?></th>
														</tr>		
														<?php
													}
												?>	<tr>
														<td style="width:20%;">Sous-Etape <?=$nb_se;?> : </td>
														<td><?php echo $row->designation_sous_etape; ?></td>
														<td><?php echo $row->duree_sous_etape; ?> jour(s)</td>
													</tr>
												<?php
												$nb_se+=1;
											}
											?>
										</table>
									</div>
									<?php													
								}
								else
								{
									?>
									<div class="card col-md-12 widget-content" style="margin-bottom:10px;">
										<div class="widget-content-wrapper">
											<div class="widget-content-left">
												<div class="widget-heading">
													<table class="table table-striped" style="width: 100%;">
														<tr>
															<td> 
																<span style="font-size: 2em;" class="fa fa-spin fa-refresh"></span>
															</td>
															<td style="font-size: 1.3em;">
																Aucune étape enregistrée
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
								
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

<div class="modal fade" id="maladie" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">
                	<span class="fa fa-medkit" style="font-size:2em;"> </span> &nbsp; | 
						Maladies
				</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            	<table class="table table-striped table-bordered" style="width: 100%;">
            		<tr style="text-align:center;">
            			<th>Nom</th>
            			<th >Description</th>
            			<th >Cause</th>
            			<th >Solution</th>
            		</tr>
            		<?php
            		if(isset($liste_maladie))
            		{
            			$i=0;
            			if($liste_maladie->num_rows()>0)
            			{											
            				foreach ($liste_maladie->result() as $row) 
            				{
            					?>
            					<tr style="text-align:justify;">
            						<td>
            							<?php 
            							if(isset($row->designation_maladie))
            							{ 
            								echo $row->designation_maladie;
            							}
            							?>
            						</td>
            						<td>
            							<?php 
            							if(isset($row->description_maladie))
            							{ 
            								echo $row->description_maladie;
            							}
            							?>
            						</td>
            						<td>
            							<?php 
            							if(isset($row->cause_maladie))
            							{ 
            								echo $row->cause_maladie;
            							}
            							?>
            						</td>
            						<td>
            							<?php 
            							if($liste_solution[$i]!="")
            							{ 
            								echo $liste_solution[$i];
            							}
            							else
            							{
            								echo "Aucune solution disponible";
            							}
            							?>
            						</td>
            					</tr>
            					<?php
            					$i=$i+1;
            				}													
            			}
            			else
            			{
            				?>
            				<tr>
            					<th colspan="4">Aucune maladie enregistrée</th>
            				</tr>
            				<?php
            			}
            		}
            		?>
            	</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
