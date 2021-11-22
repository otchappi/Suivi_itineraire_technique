<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
	<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/DataTables/responsive.dataTables.min.css");?>">
    <script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/jquery.dataTables.min.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/dataTables.bootstrap4.js");?>"></script>
    <script src="<?php echo base_url("assets/vendors/DataTables/Responsive-2.2.1/js/responsive.bootstrap4.min.js");?>"></script>
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
	if(isset($modif_activite))
	{
		foreach ($modif_activite->result() as $row) 
		{
			$designation=$row->designation_activite;
			$periodicite=$row->periodicite_activite;
			$date_debut=$row->date_debut_activite;
			$description=$row->description_activite;
			$id_activite=$row->id_activite;
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
						<i class="fa fa-sort-amount-asc icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Activités
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/activite');?>" class="text-success">
						Activités &nbsp;
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-card mb-3 card">
					<div class="card-header bg-info">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
							<span class="fa fa-tasks" style="font-size:2em;"> </span> &nbsp; | 
						Gestion des activités
					</div>
					<div class="card-body">
						<form method="post" class="form-horizontal" action="<?php 
								if(isset($id_activite)){echo site_url('Activite/valider_formulaire/'.$id_activite);}
								else{if(isset($id_activite_modif)){echo site_url('Activite/valider_formulaire/'.$id_activite_modif);}
								else{echo site_url('Activite/valider_formulaire');}
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
										<label for="description" class="col-md-2">&nbsp;&nbsp;&nbsp;Description</label>
										<div class="col-md-10">
											<textarea rows="3" id="description" name="description" class="form-control" maxlength="500" value="<?php 
													if(isset($description)){echo $description;}
													else{ echo set_value('description');}
												?>"><?php 
													if(isset($description)){echo $description;}
													else{ echo set_value('description');}
												?></textarea>											
											<span class="text-danger"><?php echo form_error("description"); ?></span>
										</div>
									</div>
									<div class="form-row">
										<label for="date_debut" class="col-md-2"><span class="text-danger">* &nbsp;</span>Date de début</label>
										<div class="col-md-10">
											<input id="date_debut" type="date" name="date_debut" class="form-control" required 
											value="<?php if(isset($date_debut)){echo $date_debut;}else{echo set_value('date_debut');}?>"/>
											<span class="text-danger"><?php echo form_error("date_debut"); ?></span>
										</div>
									</div>
									<div class="form-row">
										<label for="periodicite" class="col-md-2"><span class="text-danger">* &nbsp;</span>Périodicité (en jours) </label>
										<div class="col-md-10">
											<input id="periodicite" type="number" min="1" name="periodicite" class="form-control" required
											value="<?php if(isset($periodicite)){echo $periodicite;}else{echo set_value('periodicite');}?>"/>
											<span class="text-danger"><?php echo form_error("periodicite"); ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-1"></div>
							</div>
							<div class="row">
								<div class="col-md-5"></div>
								<div class="col-md-3">
									<a style="width: 100%;" class="btn btn-shadow btn-outline-danger" href="<?php  echo base_url('Projet/activite');?>">Annuler</a>
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
								<h4  class="tit">Liste des activités</h4><hr>
							</legend>
						</div>
							<table id="activite_projet_data" class="table table-responsive  table-hover dt-responsive table-striped" style="width: 100%; text-align: center;font-family:'Times New Roman','Arial',serif; font-size: 1.2em;" >
								<thead>
									<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px; font-weight: bold;">
										<th width="20%">Désignation</th>
										<th width="30%">Description</th>
										<th width="10%">Date de début</th>
										<th width="10%">Périodicité (j)</th>
										<th width="10%">A faire le</th>
										<th width="10%">Modifier</th>
										<th width="10%">Supprimer</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
								<tfoot>
									<tr class="font-weight-bold" style="padding-top: 7px;padding-bottom: 7px;">
										<th width="20%">Désignation</th>
										<th width="30%">Description</th>
										<th width="10%">Date de début</th>
										<th width="10%">Périodicité (j)</th>
										<th width="10%">A faire le</th>
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
		$(document).ready(function()
		{
			var dataTable=$('#activite_projet_data').DataTable({
				"processing":true,
				"serverSide":true,
				"order":[],
				"responsive":true,
				"language":{
					url:"<?php echo base_url('assets/vendors/js/French.json'); ?>"
				},
				"ajax":
				{
					url:"<?php echo site_url('Activite/chercher_activite_projet'); ?>",
					type:"POST"
				},
				"columnDefs":
				[
					{
						"targets":[1,4,5,6],
						"orderable":false, 
					}
				]
			});
		});
	</script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on('click','.retirer_activite',function(){ 
   			var id = $(this).attr("id");
		    swal({
		      title: "Etes-vous sûr de vouloir supprimer cette activité ?",
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
			        	url: "<?php  echo base_url('Activite/retirer_activite/');?>"+id,
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