<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
<?php
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
<style type="text/css">
	.tit
	{
		text-shadow: 0 -2px 0,
		#b5c2cb 1px 5px 5px;
		color:darkgreen;
	}
</style>
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-book icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Rapports
						<div class="page-title-subheading"></div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/rapport');?>" class="text-success">Rapports</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 card">
				<div class="card-body">
					<form method="post" action="<?php echo base_url('Report/valider_formulaire');?>" enctype="multipart/form-data">
					<div class="form-row">
						<div class="col-lg-2">
						</div>
						<div class="col-lg-8">
							<div class="row">
								<legend class="font-weight-bold text-primary" style="text-align: center; font-size: 1.3em;">
									<h3  class="tit">Formulaire d'enregistrement</h3>
								</legend>
							</div><hr>
							<div class="row">
								<label for="titre_doc" class="col-lg-3 font-weight-bold" style="font-size: 1.1em;"><span class="text-danger">* &nbsp;</span>Titre du rapport : </label>
								<div class="col-lg-9">
									<input id="titre_doc" type="text" name="titre_doc" class="form-control" required maxlength="100"
									value="<?php if(isset($titre_doc)){echo $titre_doc;}else{echo set_value('titre_doc');}?>"/>
									<span class="text-danger"><?php echo form_error("titre_doc"); ?></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
						</div>
					</div><br>
					<div class="form-row">
						<div class="col-lg-2"></div>
						<div class="col-lg-8">
							<div class="row">
								<label for="document" class="col-lg-3 font-weight-bold" style="font-size: 1.1em;"><span class="text-danger">* &nbsp;</span>Fichier (max: 2 Mo) : </label>
								<div class="col-lg-9">
									<input type="file" id="document" name="document" class="btn btn-primary" size="20" required />
									<span class="text-danger"><?php echo form_error("document"); ?></span>
									<?php if(isset($error)){echo $error;}?>
								</div>
							</div><hr>
						</div>
					</div>
					<div class="form-row">
						<div class="col-lg-8"></div>
						<div class="col-xs-2">
							<input class="btn btn-success" type="submit" name="valider" value="Enregistrer"/>
						</div>
						<div class="col-xs-2">
							<a class="btn btn-danger" href="<?php echo site_url('Projet/rapport');?>">Annuler</a>
						</div>
					</div>
					</form>
					<hr><br>
					<div class="row">
						<div class="col-lg-1">
						</div>
						<div class="col-lg-10">
							<legend class="font-weight-bold text-primary" style="text-align: center; font-size: 1.3em;">
								<h3  class="tit">Liste des rapports</h3>
							</legend><hr>
							<table class="mb-0 table table-hover table-bordered text-center">
								<thead>
									<tr>
										<th>Numéro</th>
										<th>Titre du document</th>
										<th>Date et heure de la publication</th>
										<th>Consulter</th>
										<th>Supprimer</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Numéro</th>
										<th>Titre du document</th>
										<th>Date et heure de la publication</th>
										<th>Consulter</th>
										<th>Supprimer</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									if(isset($liste_rapport))
									{
										$nb=1;
										foreach ($liste_rapport as $row) 
										{?>
											<tr>
												<td><?php echo $nb; ?></td>
												<td><?php echo $row->titre_rapport; ?></td>
												<td><?php echo $row->date_creation_rapport; ?></td>
												<td>
													<a  href="<?php $test=$row->emplacement_rapport; echo base_url($row->emplacement_rapport); ?>" target="_blank" class="btn btn-info">Ouvrir</a>
												</td>
												<td>
													<a id="<?php echo $row->id_rapport;?>" class="supprimer_rapport btn btn-danger text-light">Supprimer</a>
												</td>
											</tr>
											<?php
											$nb+=1;
										}
										if($nb==1)
										{
											?>
											<tr>
												<td colspan="5">Aucun rapport publié</td>
											</tr>
											<?php
										}
									}
									else
									{
										?>
											<tr>
												<td colspan="5">Aucun rapport publié</td>
											</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-lg-1">
						</div>
					</div>
					<div class="d-block text-center card-footer">
						<span>
							Au total  <i class="font-weight-bold "><?php if(isset($nb)){echo $nb-1;}else{ echo "0";} ?></i> &nbsp Rapport(s)
						</span>
					</div>
					<hr><br>
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

        <script src="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.js");?>"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on('click','.supprimer_rapport',function(){ 
   			var id = $(this).attr("id");
		    swal({
		      title: "Etes-vous sûr de vouloir supprimer ce rapport ?",
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
			        	url: "<?php  echo base_url('Report/supprimer_rapport/');?>"+id,
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
