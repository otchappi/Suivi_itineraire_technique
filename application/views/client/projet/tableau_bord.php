<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
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
	if($this->session->userdata('operation')!='')
	{
		?>
			<script type="text/javascript">
				alert('Enregistrement effectué avec succès !');
			</script><?php
		$this->session->unset_userdata('operation');
	}
?>
	<?php
		if(isset($infos_tache) && $infos_tache->num_rows()>0)
		{
			foreach ($infos_tache->result() as $row) 
			{
				$intitule_tache=$row->intitule_tache;
				$date_echeance_tache=$row->date_echeance_tache;
				$description_tache=$row->description_tache;
				$image_tache=$row->image_tache;
				$etat_tache=$row->etat_tache;
				$date_debut_tache=$row->date_debut_tache;
				$id_tache=$row->id_tache;
				$designation_etape=$row->designation_etape;
			}
		}
	?>
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
						<div class="page-title-subheading">
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Projet/Home_projet_client/'.$this->session->userdata("id_projet"));?>" class="text-success">Tableau de Bord &nbsp</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="main-card mb-3 card">
					<div class="card-body"><h5 class="card-title">Liste des tâches en cours</h5>
						<div>
							<ul class="list-group">
								<?php
									if(isset($liste_tache) && $liste_tache->num_rows()>0)
									{
										foreach ($liste_tache->result() as $row) 
										{
											?>
											<a class="<?php if(isset($id_tache) && $id_tache==$row->id_tache){ echo "active";} ?> list-group-item-action list-group-item" href="<?php echo base_url("Projet/Home_projet_client/".$row->id_tache."/0") ?>">
												<?=$row->intitule_tache;?>
											</a>
											<?php
										}
									}
									else
									{
										?>
										<a class="list-group-item-action list-group-item">
											Aucune tâche en cours
										</a>
										<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="main-card mb-3 card">
					<div class="card-body"><h5 class="card-title">Liste des tâches proches</h5>
						<div>
							<ul class="list-group">
								<?php
									if(isset($liste_tache_proches) && $liste_tache_proches->num_rows()>0)
									{
										foreach ($liste_tache_proches->result() as $row) 
										{
											?>
											<button class="list-group-item-action list-group-item">
												<strong>
													Désignation :
												</strong>  
												<span style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$row->intitule_tache;?> 
												</span>
												<br/>
												<strong>Prévu du :</strong> 
												<span class="text-info" style="font-size:1.2em; font-weight: 'Times New Roman',serif;"><?=$row->date_debut_tache;?> au <?=$row->date_echeance_tache;?> 
												</span>
											</button>
											<?php
										}
									}
									else
									{
										?>
										<a class="list-group-item-action list-group-item">
											Aucune tâche à l'horizon
										</a>
										<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="main-card mb-3 card">
					<div class="card-header bg-success">
						<i class="header-icon lnr-laptop-phone icon-gradient bg-plum-plate"> </i>&nbsp;
						<span class="fa fa-file-o" style="font-size:2em;"> </span> &nbsp; | 
						Détails
					</div>
					<div class="card-body">
						<div class="scroll-area-lg">
							<div class="scrollbar-container ps--active-y ps">
								<table class="table table-striped" style="width: 100%;">									
									<tr>
										<td colspan="2">
											<strong><?php if(isset($designation_etape)){ echo $designation_etape;}else{ echo "Aucune tâche en cours";} ?></strong>
										</td>
									</tr>
									<tr>
										<td rowspan="3" style="width:25%;"><img src="<?php if(isset($image_tache) && $image_tache!=""){echo base_url($image_tache);}else{echo base_url("assets/images/tache/tache.jpg");}  ?>" class="img-rounded" alt="Illustration" style="width: 100%;height: 150px;" /></td>
									</tr>
									<tr>
										<td>
											<strong><?php if(isset($intitule_tache)){ echo $intitule_tache;}else{ echo "/";} ?></strong>
										</td>
									</tr>
									<tr>
										<td>
											<p><?php if(isset($description_tache)){ echo $description_tache;}else{ echo "/";} ?></p>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Etat</strong>
										</td>
										<td>
											<?php if(isset($etat_tache)){ echo $etat_tache;}else{ echo "/";} ?>%
										</td>
									</tr>
									<tr>
										<td>
											<strong>Date de début</strong>
										</td>
										<td>
											<?php if(isset($date_debut_tache)){ echo $date_debut_tache;}else{ echo "/";} ?>
										</td>
									</tr>
									<tr>
										<td>
											<strong>Date écheance</strong>
										</td>
										<td style="font-weight: bold; color: red;">
											<?php if(isset($date_echeance_tache)){ echo $date_echeance_tache;}else{ echo "/";} ?>
										</td>
									</tr>
								</table>
							<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 65px;"></div></div></div>
						</div>
					</div>
					<?php
						if(isset($infos_tache) && $infos_tache->num_rows()>0)
						{
							?>
								<div class="card-footer">
									<div class="col-md-6">
										<button style="width:100%;" type="button" class="btn-transition btn btn-outline-info" data-toggle="modal" data-target="#sous_tache">
											Sous-tâches
										</button>
									</div>
									<div class="col-md-6">
										<button style="width:100%;" type="button" class="btn-transition btn btn-outline-success" data-toggle="modal" data-target="#cloturer">
											Clôturer la tâche
										</button>
									</div>
								</div>
							<?php
						}
					?>
					
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
<?php
	if(isset($infos_tache) && $infos_tache->num_rows()>0)
	{
		?>
			<div class="modal fade" id="sous_tache" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true" >
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header bg-success text-white">
			                <h5 class="modal-title" id="exampleModalLongTitle">
			                	<span class="fa fa-list-alt" style="font-size:2em;"> </span> &nbsp; | 
									Liste des sous-tâches
							</h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">×</span>
			                </button>
			            </div>
			            <div class="modal-body">
			            	<table class="table table-striped table-bordered" style="width: 100%;">
			            		<tr style="text-align:center;">
			            			<th>Désignation</th>
			            			<th >Date début</th>
			            			<th >Date échéance</th>
			            			<th >Clôturer</th>
			            		</tr>
			            		<?php
			            		if(isset($liste_sous_tache))
			            		{
			            			if($liste_sous_tache->num_rows()>0)
			            			{											
			            				foreach ($liste_sous_tache->result() as $row) 
			            				{
			            					?>
			            					<tr style="text-align:justify;">
			            						<td>
			            							<?php 
			            							if(isset($row->designation_sous_tache))
			            							{ 
			            								echo $row->designation_sous_tache;
			            							}
			            							?>
			            						</td>
			            						<td>
			            							<?php 
			            							if(isset($row->date_debut_sous_tache))
			            							{ 
			            								echo $row->date_debut_sous_tache;
			            							}
			            							?>
			            						</td>
			            						<td>
			            							<?php 
			            							if(isset($row->date_echeance_sous_tache))
			            							{ 
			            								echo $row->date_echeance_sous_tache;
			            							}
			            							?>
			            						</td>
			            						<td>
			            							<?php 
			            							if(isset($row->date_realisation_sous_tache))
			            							{ 
			            								if($row->date_realisation_sous_tache!='0000-00-00')
			            								{
			            									?>
			            									<span class="text-success font-weight-bold">Clôturée</span>
			            									<?php
			            								}
			            								else
				            							{
				            								?>
				            								<a id="<?php echo $row->id_sous_tache;?>" class="cloturer_sous_tache btn btn-outline-info">Clôturer</a>
				            								<?php
				            							}
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
			            					<th colspan="4" class="text-center">Aucune sous-tâche enregistrée</th>
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
			<div class="modal fade" id="cloturer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true" >
			    <div class="modal-dialog modal-md">
			        <div class="modal-content">
			            <div class="modal-header bg-success text-white">
			                <h5 class="modal-title" id="exampleModalLongTitle">
			                	<span class="fa fa-list-alt" style="font-size:1.5em;"> </span> &nbsp; | &nbsp; 
									Clôture de la tâche
							</h5>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">×</span>
			                </button>
			            </div>
			            <form method="post" class="form-horizontal" action="<?php echo base_url('Projet/cloturer_tache/'.$id_tache);?>"  enctype="multipart/form-data">
			            <div class="modal-body">            	
			            		<table class="table table-striped" style="width: 100%;">
			            			<tr>
			            				<th>Réalisé le</th>
			            				<th style="width: 2%;">:</th>
			            				<td>
			            					<input type="date" class="form-control" id="date_realisation" name="date_realisation" value="<?=date("Y-m-d")?>" max="<?=date("Y-m-d")?>">
			            				</td>
			            			</tr>
			            			<tr>
			            				<th>Commentaire</th>
			            				<th style="width: 2%;">:</th>
			            				<td>
			            					<textarea rows="4" class="form-control" id="commentaire" name="commentaire" maxlength="500" placeholder="Un mot svp" required></textarea>
			            				</td>
			            			</tr>
			            			<tr>
			            				<th>Fichier (Max 2Mo)</th>
			            				<th style="width: 2%;">:</th>
			            				<td>
			            					<input type="file" id="document" name="document" class="btn btn-primary" size="20"/>
			            				</td>
			            			</tr>
			            			<tr>
			            				<td colspan="3" style="color: darkred; text-align:center;font-weight: bold;font-family: 'Times New roman',serif;font-size: 1.2em;">
			            					<span class="fa fa-bullhorn"></span>&nbsp; &nbsp;Cette action va clôturer la tâche ainsi que l'ensemble des sous-tâches associées !
			            				</td>
			            			</tr>
			            		</table>
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fermer</button> &nbsp;&nbsp;&nbsp;
			                <input class="btn btn-outline-success" type="submit" name="valider" value="Enregistrer"/>
			            </div>
			            </form>
			        </div>
			    </div>
			</div>
		<?php
	}
?>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(document).on('click','.cloturer_sous_tache',function(){ 
   			var id = $(this).attr("id");
		    swal({
		      title: "Etes-vous sûr de vouloir clôturer cette sous-tâche ?",
		      text: "Cette action est irréversible!",
		      type: "warning",
		      showCancelButton: true,
		      cancelButtonClass: "btn-danger",
		      confirmButtonClass: "btn-warning",
		      confirmButtonText: "Oui, Clôturer !",
		      cancelButtonText: "Non, Annuler!",
		      closeOnConfirm: false,
		      closeOnCancel: false
		    },
    		function(isConfirm) {
      			if (isConfirm) {
			        $.ajax({
			        	url: "<?php  echo base_url('Projet/cloturer_sous_tache/');?>"+id+"<?php echo "/".$id_tache;?>",
			        	type: 'POST',
			        	error: function() {
			        		alert('Une erreur s\'est produite');
			        	},
			        	success: function(data) {
			          		swal({
					            title: "Clôture!",
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
        			swal("Annulé", "La clôture a été annulée", "error");
      			}
    		});

  		});
	});
</script>