<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
	<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/responsive.dataTables.min.css");?>">
    <script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/jquery.dataTables.min.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/Responsive-2.2.1/js/responsive.bootstrap4.min.js");?>"></script>
<style type="text/css">
	p
	{
		text-indent: 4em;
		text-align: justify;
		font-family: "Times New Roman", serif;
		font-size: 1.2em;
	}
</style>
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
	if(isset($modif_sous_tache))
	{
		foreach ($modif_sous_tache->result() as $row) 
		{
			$designation=$row->designation_sous_tache;
			$date_echeance=$row->date_echeance_sous_tache;
			$date_debut=$row->date_debut_sous_tache;
			$id_sous_tache=$row->id_sous_tache;
		}
	}
	if(isset($info_tache))
	{
		foreach ($info_tache->result() as $row) 
		{
			$designation_tache=$row->intitule_tache;
			$description_tache=$row->description_tache;
			$date_echeance_tache=$row->date_echeance_tache;
			$date_debut_tache=$row->date_debut_tache;
			$date_realisation_tache=$row->date_realisation_tache;
			$etat_tache=$row->etat_tache;
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
						<i class="fa fa-edit icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Sous-tâches
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/tache');?>" class="text-success">
						Tâches &nbsp;
					</a>&nbsp;/&nbsp; Sous-tâches
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-card mb-3 card">
					<div class="card-header bg-focus">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-edit" style="font-size:1.5em;"> </span> &nbsp; | 
						Intitulé de la tâche : <?php if(isset($designation_tache)){ echo $designation_tache;}else{ echo "/";}?>
					</div>
					<div class="card-body">
						<table class="table table-responsive table-hover table-striped" style="width: 100%;font-family:'Times New Roman','Arial',serif;" >
							<tr>
								<td style="width:15%;">
									<strong>Description</strong>
								</td>
								<td style="width:2%;">
									:
								</td>
								<td>
									<p>
										<?php if(isset($description_tache)){ echo $description_tache;}else{ echo "/";}?>
									</p>									
								</td>
							</tr>
							<tr>
								<td>
									<strong>Date de début</strong>
								</td>
								<td style="width:2%;">
									:
								</td>
								<td>
									<span class="text-focus font-weight-bold" style="font-size:1.2em;">
										<?php if(isset($date_debut_tache)){ echo $date_debut_tache;}else{ echo "/";}?>
									</span>									
								</td>
							</tr>
							<tr>
								<td>
									<strong>Date d'échéance</strong>
								</td>
								<td style="width:2%;">
									:
								</td>
								<td>
									<span class="text-focus font-weight-bold" style="font-size:1.2em;">
										<?php if(isset($date_echeance_tache)){ echo $date_echeance_tache;}else{ echo "/";}?>
									</span>									
								</td>
							</tr>
							<tr>
								<td>
									<strong>Etat</strong>
								</td>
								<td style="width:2%;">
									:
								</td>
								<td>
									<?php 
										if(isset($date_realisation_tache))
										{ 
											if($date_realisation_tache!="0000-00-00")
											{
												?>
													<span class="text-focus font-weight-bold" style="font-size:1.2em;">
														<?php echo $date_realisation_tache;?>
													</span>
												<?php												
											}
											else
											{
												?>
													<span class="text-focus font-weight-bold" style="font-size:1.2em;">
														<?php echo $etat_tache."%";?>
													</span>
												<?php												
											}
										}
										else
										{ 
											echo "/";
										}
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>							
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-card mb-3 card">
					<div class="card-header bg-info">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-edit" style="font-size:2em;"> </span> &nbsp; | 
						Gestion des sous-tâches
					</div>
					<div class="card-body">
						<form method="post" class="form-horizontal" action="<?php 
								if(isset($id_sous_tache)){echo site_url('Sous_tache/valider_formulaire/'.$id_sous_tache);}
								else{if(isset($id_sous_tache_modif)){echo site_url('Sous_tache/valider_formulaire/'.$id_sous_tache_modif);}
								else{echo site_url('Sous_tache/valider_formulaire');}
							}?>">
							<div class="row">
								<legend class="font-weight-bold text-primary" style="text-align: center; font-size: 1em;">
									<h4  class="tit">Formulaire d'enregistrement</h4><hr>
									<h1 class="font-weight-bold text-danger" style="font-size: 1.1em; ">&nbsp &nbsp &nbsp Tous les champs ayant des (*) sont obligatoires</h1>
								</legend>
							</div>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="form-row">
										<label for="designation" class="col-md-2"><span class="text-danger">* &nbsp;</span>Désignation</label>
										<div class="col-md-10">
											<input id="designation" type="text" name="designation" class="form-control" required 
												value="<?php if(isset($designation)){echo $designation;}else{echo set_value('designation');}?>"/>
											<span class="text-danger"><?php echo form_error("designation"); ?></span>
										</div>
									</div>
									<div class="form-row">
										<label for="date_debut" class="col-md-2"><span class="text-danger">* &nbsp;</span>Date de début</label>
										<div class="col-md-10">
											<input id="date_debut" onchange="fixer_date_echeance();"  type="date" name="date_debut" class="form-control" required 
											value="<?php if(isset($date_debut)){echo $date_debut;}else{echo set_value('date_debut');}?>" min="<?php if(isset($date_debut_tache)){echo $date_debut_tache;}else{echo "2000-01-01";}?>" max="<?php if(isset($date_echeance_tache)){echo $date_echeance_tache;}else{echo "2000-01-01";}?>"/>
											<span class="text-danger"><?php echo form_error("date_debut"); ?></span>
										</div>
									</div>
									<div class="form-row">
										<label for="date_echeance" class="col-md-2"><span class="text-danger">* &nbsp;</span>Date d'écheance</label>
										<div class="col-md-10">
											<input id="date_echeance" type="date" name="date_echeance" class="form-control" required 
											value="<?php if(isset($date_echeance)){echo $date_echeance;}else{echo set_value('date_echeance');}?>" min="<?php if(isset($date_debut_tache)){echo $date_debut_tache;}else{echo "2000-01-01";}?>" max="<?php if(isset($date_echeance_tache)){echo $date_echeance_tache;}else{echo "2000-01-01";}?>"/>
											<span class="text-danger"><?php echo form_error("date_echeance"); ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
							<div class="row">
								<div class="col-md-5"></div>
								<div class="col-md-3">
									<a style="width: 100%;" class="btn btn-shadow btn-outline-danger" href="<?php if(isset($id_tache)){ echo base_url('Projet/sous_tache/'.$id_tache);} else{ echo base_url('Projet/tache');}?>">Annuler</a>
								</div>
								<div class="col-md-3">
									<input style="width: 100%;" class="btn btn-shadow btn-outline-success" type="submit" name="valider" value="Enregistrer"/>
								</div>								
								<div class="col-md-1"></div>
							</div>									
						</form>
						<hr><br>
						<div class="row">
							<legend class="font-weight-bold text-primary" style="text-align: center; font-size: 1em;">
								<h4  class="tit">Liste des sous-tâches</h4><hr>
							</legend>
						</div>
						<table id="sous_tache_projet_data" class="table table-responsive  table-hover dt-responsive table-striped" style="width: 100%; font-family:'Times New Roman','Arial',serif; font-size: 1.2em;" >
							<thead>
								<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px; font-weight: bold;">
									<th width="40%">Désignation</th>
									<th width="10%">Date de début</th>
									<th width="10%">Date d'échéance</th>
									<th width="10%">Réalisée le</th>
									<th width="10%">Clôturer</th>
									<th width="10%">Modifier</th>
									<th width="10%">Supprimer</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
							<tfoot>
								<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px;">
									<th width="40%">Désignation</th>
									<th width="10%">Date de début</th>
									<th width="10%">Date d'échéance</th>
									<th width="10%">Réalisée le</th>
									<th width="10%">Clôturer</th>
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
			var dataTable=$('#sous_tache_projet_data').DataTable({
				"processing":true,
				"serverSide":true,
				"order":[],
				"responsive":true,
				"language":{
					url:"<?php echo base_url('assets/vendors/js/French.json'); ?>"
				},
				"ajax":
				{
					url:"<?php echo site_url('Sous_tache/chercher_sous_tache_projet/'.$id_tache); ?>",
					type:"POST"
				},
				"columnDefs":
				[
					{
						"targets":[4,5,6],
						"orderable":false, 
					}
				]
			});
		});
	</script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on('click','.retirer_sous_tache',function(){ 
   			var id = $(this).attr("id");
		    swal({
		      title: "Etes-vous sûr de vouloir supprimer cette sous-tâche ?",
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
			        	url: "<?php  echo base_url('Sous_tache/retirer_sous_tache/');?>"+id,
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
<?php 
	if(isset($liste_sous_tache))
	{
		if($liste_sous_tache->num_rows()>0)
		{
			foreach ($liste_sous_tache->result() as $row) 
			{
				?>
					<div class="modal fade" id="cloture<?=$row->id_sous_tache;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true" >
					    <div class="modal-dialog modal-md">
					        <div class="modal-content">
					            <div class="modal-header bg-success text-white">
					                <h5 class="modal-title" id="exampleModalLongTitle">
					                	<span class="fa fa-check-square-o" style="font-size:1.3em;"> </span> &nbsp; | 
											Clôturer la sous-tâche
									</h5>
					                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                    <span aria-hidden="true">×</span>
					                </button>
					            </div>
					            <form method="post" class="form-horizontal" action="<?php echo base_url('Sous_tache/cloturer_sous_tache/'.$row->id_sous_tache.'/'.$id_tache);?>">
					            <div class="modal-body">
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10">									
											<div class="form-row">
												<label for="date_realisation" style="font-size:1.2em;" class="col-md-4"><span class="text-danger">* &nbsp;</span>Réalisé le </label>
												<div class="col-md-8">
													<input id="date_realisation" type="date" name="date_realisation" class="form-control" required min="<?php echo $row->date_debut_sous_tache;?>"/>
													<span class="text-danger"><?php echo form_error("date_realisation"); ?></span>
												</div>
											</div>
										</div>
										<div class="col-md-1"></div>
									</div>
					            </div>
					            <div class="modal-footer">
					                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button>
					                <input class="btn btn-shadow btn-outline-success" type="submit" name="valider" value="Valider"/>
					            </div>
					            </form>
					        </div>
					    </div>
					</div>
				<?php
			}													
		}
	}
?>