<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
	<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/responsive.dataTables.min.css");?>">
    <script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/jquery.dataTables.min.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/Responsive-2.2.1/js/responsive.bootstrap4.min.js");?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/design-file/bootstrap-fileupload/bootstrap-fileupload.css" />
 	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/design-file/design-file.css" />
<style type="text/css">
	.tit
	{
		text-shadow: 0 -2px 0,
		#b5c2cb 1px 5px 5px;
		color:darkgreen;
	}
	label
	{
		font-size: 1em;
		font-weight: bold;
	}
	.form-row
	{
		margin-bottom: 10px;
	}
</style>
<?php
	if(isset($modif_tache))
	{
		foreach ($modif_tache->result() as $row) 
		{
			$designation=$row->intitule_tache;
			$date_echeance=$row->date_echeance_tache;
			$date_debut=$row->date_debut_tache;
			$description=$row->description_tache;
			$designation_etape=$row->designation_etape;
			$image=$row->image_tache;
			$id_tache=$row->id_tache;
		}
	}
	if($this->session->userdata('operation')!='')
	{
		if($this->session->userdata('operation'))
		{?>
			<script type="text/javascript">
				alert('Enregistrement effectué avec succès !');
			</script><?php
		}
		$this->session->unset_userdata('operation');
	}
?>

<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-tasks icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Tâches
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/tache');?>" class="text-success">
						Tâche &nbsp;
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-card mb-3 card">
					<div class="card-header bg-info">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-file-o" style="font-size:2em;"> </span> &nbsp; | 
						Formulaire d'enregistrement
					</div>
					<div class="card-body">
						<form method="post" class="form-horizontal" action="<?php 
								if(isset($id_tache)){echo site_url('Tache/valider_formulaire/'.$id_tache);}
								else{if(isset($id_tache_modif)){echo site_url('Tache/valider_formulaire/'.$id_tache_modif);}
								else{echo site_url('Tache/valider_formulaire');}
							}?>"  enctype="multipart/form-data">
							<div class="row">
								<legend class="font-weight-bold text-primary" style="text-align: center; font-size: 1em;">
									<h1 class="font-weight-bold text-danger" style="font-size: 1.1em; ">&nbsp &nbsp &nbsp Tous les champs ayant des (*) sont obligatoires</h1>
								</legend>
							</div>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<table class="table table-striped" style="width: 100%;">									
										<tr>
											<td>
												<label for="etape"><span class="text-danger">* &nbsp;</span>Désignation de l'étape : </label>
											</td>
											<td colspan="2">
												<select id="etape" name="etape" class="form-control" >
													<?php 
														if(isset($liste_etape))
														{
															if($liste_etape->num_rows()>0)
															{
																foreach ($liste_etape->result() as $row) 
																{
																	if(isset($designation_etape))
																	{
																		if($designation_etape==$row->designation_etape)
																		{?>
																			<option value="<?php echo $row->designation_etape;?>" selected>
																				<?php echo $row->designation_etape;?>					
																			</option><?php
																		}
																		else
																		{?>
																			<option value="<?php echo $row->designation_etape;?>">
																				<?php echo $row->designation_etape;?>					
																			</option><?php
																		}
																	}
																	else
																	{?>
																		<option value="<?php echo $row->designation_etape;?>">
																			<?php echo $row->designation_etape;?>
																		</option>
																	<?php
																	}
																}													
															}
															else
															{
																?>
																<option value="0" selected>Aucune étape disponible</option>
																<?php
															}
														}
														else
														{ ?>
															<option value="0">Erreur</option>
															<?php
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td rowspan="3" style="width:25%;">
												<div class="fileupload fileupload-new" data-provides="fileupload" style="margin-left: 10px;">
													<div class="fileupload-new thumbnail" style=" height: 150px; border: -webkit-box-shadow:0 1px 2px rgb(0,0,0); box-shadow: 0 1px 2px rgb(0,0,0);">
														<img src="<?php if(isset($image) && $image!=""){echo base_url($image);}
														else{ echo 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Une+Illustration';}?>" class="img-rounded" alt="photo" style="width: 100%;height: 150px;" />
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="width: 100%; max-height: 150px; line-height: 20px;">
													</div>
													<div>
														<span class="btn btn-theme03 btn-file">
															<span class="fileupload-new" >
																<i class="fa fa-paperclip"></i> Charger l'image
															</span>						                   
															<span class="fileupload-exists">
																<i class="fa fa-undo"></i> Changer
															</span>
															<input type="file" class="default" name="photos" id="photos" />
														</span>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<strong><span class="text-danger">* &nbsp;</span>Intitulé </strong>
											</td>
											<td>
												<input id="designation" type="text" name="designation" class="form-control" required 
													value="<?php if(isset($designation)){echo $designation;}else{echo set_value('designation');}?>"/>
												<span class="text-danger"><?php echo form_error("designation"); ?></span>
											</td>
										</tr>
										<tr>
											<td style="width:5%;">
												<strong>&nbsp;&nbsp;&nbsp;Description </strong>
											</td>
											<td>
												<textarea rows="3" id="description" name="description" class="form-control" maxlength="500" value="<?php 
														if(isset($description)){echo $description;}
														else{ echo set_value('description');}
													?>"><?php 
														if(isset($description)){echo $description;}
														else{ echo set_value('description');}
													?></textarea>											
												<span class="text-danger"><?php echo form_error("description"); ?></span>
											</td>
										</tr>
										<tr>
											<td>
												<strong><span class="text-danger">* &nbsp;</span>Date de début </strong>
											</td>
											<td colspan="2">
												<input id="date_debut" onchange="fixer_date_echeance();" type="date" name="date_debut" class="form-control" required 
												value="<?php if(isset($date_debut)){echo $date_debut;}else{echo set_value('date_debut');}?>"/>
												<span class="text-danger"><?php echo form_error("date_debut"); ?></span>
											</td>
										</tr>
										<tr>
											<td>
												<strong><span class="text-danger">* &nbsp;</span>Date d'écheance </strong>
											</td>
											<td colspan="2">
												<input id="date_echeance" type="date" name="date_echeance" class="form-control" required 
												value="<?php if(isset($date_echeance)){echo $date_echeance;}else{echo set_value('date_echeance');}?>"/>
												<span class="text-danger"><?php echo form_error("date_echeance"); ?></span>
											</td>
										</tr>
									</table>
									<hr>
								</div>
								<div class="col-md-1"></div>
							</div>
							<div class="row">
								<div class="col-md-5"></div>
								<div class="col-md-3">
									<a style="width: 100%;" class="btn btn-shadow btn-outline-danger" href="<?php  echo base_url('Projet/tache');?>">Annuler</a>
								</div>
								<div class="col-md-3">
									<input style="width: 100%;" class="btn btn-shadow btn-outline-success" type="submit" name="valider" value="Enregistrer"/>
								</div>								
								<div class="col-md-1"></div>
							</div>									
						</form>							
					</div>
				</div>							
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card-shadow-success border mb-3 card card-body border-success">
					<h5 class="card-title">Critères de recherches</h5>
					<div class="card-body">
						<form method="post" action="<?php echo site_url('Projet/valider_critere_tache'); ?>">
							<div class="form-row">
								<div class="col-md-4 mb-3">
									<label for="date_debut">Débute le </label>
									<input type="date" class="form-control" id="date_debut" name="date_debut" value="<?php if($this->session->userdata("date_search")!=""){echo $this->session->userdata("date_search"); $this->session->unset_userdata("date_search");} ?>">
								</div>
								<div class="col-md-4 mb-3">
									<label for="statut">Statut :</label>
									<select id="statut" name="statut" class="form-control" >
										<option value="0" selected>Tous</option>
										<option value="1" <?php if($this->session->userdata("statut_search")!="" && $this->session->userdata("statut_search")=="1"){echo "selected"; $this->session->unset_userdata("statut_search"); } ?> >Terminées</option>
										<option value="2" <?php if($this->session->userdata("statut_search")!="" && $this->session->userdata("statut_search")=="2"){echo "selected"; $this->session->unset_userdata("statut_search"); } ?>>En cours</option>
										<option value="3" <?php if($this->session->userdata("statut_search")!="" && $this->session->userdata("statut_search")=="3"){echo "selected"; $this->session->unset_userdata("statut_search"); } ?>>A venir</option>
									</select>
								</div>
								<div class="col-md-4 mb-3">
									<label for="etape">Etape</label>
									<select id="etape" name="etape" class="form-control" >
										<?php 
											if(isset($liste_etape))
											{
												if($liste_etape->num_rows()>0)
												{
													?>
														<option value="0" selected="">Toutes</option>
													<?php
													foreach ($liste_etape->result() as $row) 
													{
														?>
														<option value="<?=$row->designation_etape;?>" <?php if($this->session->userdata("etape_search")!="" && $this->session->userdata("etape_search")==$row->designation_etape){echo "selected"; $this->session->unset_userdata("etape_search"); } ?> ><?=$row->designation_etape;?></option>
														<?php
													}													
												}
												else
												{
													?>
													<option value="0" selected>Aucune étape disponible</option>
													<?php
												}
											}
											else
											{ ?>
												<option value="0">Erreur</option>
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
							<table id="tache_projet_data" class="table table-responsive table-hover dt-responsive table-striped" style="width: 100%; text-align: center;font-family:'Times New Roman','Arial',serif; font-size: 1.2em;" >
								<thead>
									<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px; font-weight: bold;">
										<th width="30%">Désignation</th>
										<th width="10%">Debut le</th>
										<th width="10%">Echéance le</th>
										<th width="10%">Etat</th>
										<th width="10%">Voir</th>
										<th width="10%">Gérer</th>
										<th width="10%">Modifier</th>
										<th width="10%">Supprimer</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px;">
										<th width="30%">Désignation</th>
										<th width="10%">Debut le</th>
										<th width="10%">Echéance le</th>
										<th width="10%">Etat</th>
										<th width="10%">Voir</th>
										<th width="10%">Gérer</th>
										<th width="10%">Modifier</th>
										<th width="10%">Supprimer</th>
									</tr>
								</tfoot>
							</table>	
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
<script type="text/javascript">
	function fixer_date_echeance()
	{
		var dt_deb=document.getElementById("date_debut");
		var dt_fin=document.getElementById("date_echeance");
		dt_fin.setAttribute('min',dt_deb.value);
	}
</script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			var dataTable=$('#tache_projet_data').DataTable({
				"processing":true,
				"serverSide":true,
				"order":[],
				"responsive":true,
				"language":{
					url:"<?php echo base_url('assets/vendors/js/French.json'); ?>"
				},
				"ajax":
				{
					url:"<?php echo site_url('Tache/chercher_tache_projet'); ?>",
					type:"POST"
				},
				"columnDefs":
				[
					{
						"targets":[4,5,6,7],
						"orderable":false, 
					}
				]
			});
		});
	</script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on('click','.retirer_tache',function(){ 
   			var id = $(this).attr("id");
		    swal({
		      title: "Etes-vous sûr de vouloir supprimer cette tâche ?",
		      text: "Cette action est irréversible!",
		      type: "warning",
		      showCancelButton: true,
		      cancelButtonClass: "btn-danger",
		      confirmButtonClass: "btn-warning",
		      confirmButtonText: "Oui, supprimer!",
		      cancelButtonText: "Non, Annuler!",
		      closeOnConfirm: false,
		      closeOnCancel: false
		    },
    		function(isConfirm) {
      			if (isConfirm) {
			        $.ajax({
			        	url: "<?php  echo base_url('Tache/retirer_tache/');?>"+id,
			        	type: 'POST',
			        	error: function() {
			        		alert('Une erreur s\'est produite');
			        	},
			        	success: function(data) {
			          		swal({
					            title: "Supprimé!",
					            text: "Opération effectuée avec succès",
					            type: "success"
			          		});
			          		window.setTimeout(function(){
					          location.reload();
					        }, 2000);
						}	
	      			});
      			} 
      			else
      			{
        			swal("Annulé", "La suppression a été annulée", "error");
      			}
    		});

  		});
	});
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/vendors/design-file/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<?php 
	if(isset($liste_tache))
	{
		if($liste_tache->num_rows()>0)
		{
			foreach ($liste_tache->result() as $row) 
			{
				?>
					<div class="modal fade" id="tache<?=$row->id_tache?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true" >
					    <div class="modal-dialog modal-lg">
					        <div class="modal-content">
					            <div class="modal-header bg-success text-white">
					                <h5 class="modal-title" id="exampleModalLongTitle">
					                	<span class="fa fa-file-o" style="font-size:2em;"> </span> &nbsp; | 
											Détails sur la tâche
									</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                    <span aria-hidden="true">×</span>
					                </button>
					            </div>
					            <div class="modal-body">
					            	<table class="table table-striped" style="width: 100%;">									
										<tr>
											<td colspan="2">
												<strong><?php if(isset($row->designation_etape)){ echo $row->designation_etape;}else{ echo "/";} ?></strong>
											</td>
										</tr>
										<tr>
											<td rowspan="3" style="width:25%;">
												<a href="<?php if($row->image_tache!=""){ echo base_url($row->image_tache);} else{ echo base_url("assets/images/tache/tache.jpg");} ?>" target="_blank" title="Apercu">
													<img src="<?php if(isset($row->image_tache) && $row->image_tache!=""){echo base_url($row->image_tache);}else{echo base_url("assets/images/tache/tache.jpg");}  ?>" class="img-rounded" alt="Illustration" style="width: 100%;height: 150px;" />
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<strong><?php if(isset($row->intitule_tache)){ echo $row->intitule_tache;}else{ echo "/";} ?></strong>
											</td>
										</tr>
										<tr>
											<td>
												<p><?php if(isset($row->description_tache)){ echo $row->description_tache;}else{ echo "/";} ?></p>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Etat</strong>
											</td>
											<td>
												<?php if(isset($row->etat_tache)){ echo $row->etat_tache;}else{ echo "/";} ?>%
											</td>
										</tr>
										<tr>
											<td>
												<strong>Date de début</strong>
											</td>
											<td>
												<?php if(isset($row->date_debut_tache)){ echo $row->date_debut_tache;}else{ echo "/";} ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Date écheance</strong>
											</td>
											<td style="font-weight: bold;" class="text-danger">
												<?php if(isset($row->date_echeance_tache)){ echo $row->date_echeance_tache;}else{ echo "/";} ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Date réalisation</strong>
											</td>
											<td style="font-weight: bold;"  class="text-info">
												<?php if(isset($row->date_realisation_tache) && $row->date_realisation_tache!="0000-00-00"){ echo $row->date_realisation_tache;}else{ echo "/";} ?>
											</td>
										</tr>
									</table>
					            </div>
					            <div class="modal-footer">
					                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
					            </div>
					        </div>
					    </div>
					</div>
				<?php
			}													
		}
	}
?>
