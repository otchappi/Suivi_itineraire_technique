<title><?php echo $titre_page. ' - '.  'SSA'?> </title>

<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-book icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Fiches Techniques
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Fiche_technique/index_client');?>" class="text-success">
						Liste des fiches techniques &nbsp;
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-shadow-success border mb-3 card card-body border-success">
					<h5 class="card-title">Critères de recherches</h5>
					<div class="card-body">
						<form method="post" action="<?php echo site_url('Fiche_technique/rechercher_culture'); ?>">
							<div class="form-row">
								<div class="col-md-4 mb-3">
									<label for="designation">Désignation </label>
									<input type="text" class="form-control" id="designation" name="designation" value="<?php if($this->session->userdata("culture_search")!=""){echo $this->session->userdata("culture_search"); $this->session->unset_userdata("culture_search");} ?>">
								</div>
								<div class="col-md-4 mb-3">
									<label for="region">Région</label>
									<select id="region" name="region" class="form-control" >
										<?php 
											if(isset($liste_region))
											{
												if($liste_region->num_rows()>0)
												{
													?>
														<option value="0" selected="">Toutes</option>
													<?php
													foreach ($liste_region->result() as $row) 
													{
														?>
														<option value="<?=$row->id_region;?>" <?php if($this->session->userdata("region_search")!="" && $this->session->userdata("region_search")==$row->id_region){echo "selected"; $this->session->unset_userdata("region_search"); } ?> ><?=$row->intitule_region;?></option>
														<?php
													}													
												}
												else
												{
													?>
													<option value="-1" selected>Aucune région disponible</option>
													<?php
												}
											}
											else
											{ ?>
												<option value="-1">Erreur</option>
												<?php
											}
										?>
									</select>
								</div>
								<div class="col-md-4 mb-3">
									<label for="categorie">Catégorie</label>
									<select id="categorie" name="categorie" class="form-control" >
										<?php 
											if(isset($liste_categorie))
											{
												if($liste_categorie->num_rows()>0)
												{
													?>
														<option value="0" selected="">Toutes</option>
													<?php
													foreach ($liste_categorie->result() as $row) 
													{
														?>
														<option value="<?=$row->id_categorie;?>" <?php if($this->session->userdata("categorie_search")!="" && $this->session->userdata("categorie_search")==$row->id_categorie){echo "selected"; $this->session->unset_userdata("categorie_search"); } ?> ><?=$row->designation_categorie;?></option>
														<?php
													}													
												}
												else
												{
													?>
													<option value="-1" selected>Aucune catégorie disponible</option>
													<?php
												}
											}
											else
											{ ?>
												<option value="-1">Erreur</option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<button style="float:right;" class="btn btn-success" type="submit"><span class="fa fa-filter"></span>&nbsp; Filtrer</button>
						</form>
					</div>
				</div>				
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-shadow-success border mb-3 card card-body border-success">
					<h5 class="card-title">Résultats des recherches</h5>
					<div class="card-body">
						<div class="row">
							<?php 
								if(isset($liste_culture))
								{
									if($liste_culture->num_rows()>0)
									{
										foreach ($liste_culture->result() as $row) 
										{
											?>
											<div class="card col-md-6 widget-content" style="margin-bottom:10px;">
												<div class="widget-content-wrapper">
													<div class="widget-content-left">
														<div class="widget-heading">
															<table class="table table-striped" style="width: 100%;">
																<tr>
																	<td>
																		<img src="<?php echo base_url($row->image_culture); ?>" class="img-rounded" alt="<?=strtoupper($row->designation_culture[0].$row->designation_culture[1]) ; ?>" style="width: 100%;height: 50px;" />
																	</td>
																	<td class="font-weight-bold">
																		<?=$row->designation_culture; ?>
																	</td>
																</tr>
															</table>
														</div>
													</div>
													<div class="widget-content-right">
														<a class="btn btn-outline-success font-weight-bold" href="<?php echo base_url("Fiche_technique/detail_fiche/".$row->id_culture); ?>"><span class="fa fa-eye"></span>&nbsp; Voir</a>
													</div>
												</div>
											</div>
											<?php
										}													
									}
									else
									{
										?>
										<div class="card col-md-6 widget-content" style="margin-bottom:10px;">
											<div class="widget-content-wrapper">
												<div class="widget-content-left">
													<div class="widget-heading">
														<table class="table table-striped" style="width: 100%;">
															<tr>
																<td> 
																	<span style="font-size: 2em;" class="fa fa-spin fa-refresh"></span>
																</td>
																<td style="font-size: 1.3em;">
																	Aucun résultat trouvé
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

