
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Forum de discussion</title>
	<!-- Favicons -->
	  <link href="<?php echo base_url('assets/images/logo.png');?>" rel="icon">
	  <link href="<?php echo base_url('assets/images/logo.png')?>" rel="apple-touch-icon">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/font-awesome-4.7/css/font-awesome.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/sweet-alert/css/sweetalert.css");?>">
    <script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
    <script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
</head>
	
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<a class="navbar-brand" href="<?= base_url("Index/forum");?>">
	  		<img  src="<?php echo base_url('assets/images/logo-gauche.png');?>" style="max-height: 50px;" alt="">
	  	</a>

	  	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	  		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    		</ul>
    		<?php 
    			if($this->session->userdata("id_membre"))
    			{
    				?>
						<span class='font-weight-bold' style="font-family:'Times New Roman',serif;color:#0D360C; font-weight: bold; font-size: 1.2em;">
							<span class="fa fa-user"></span>&nbsp;
							<?=$this->session->userdata('nom_membre');?>&nbsp; <?= $this->session->userdata('prenom_membre');?>
						</span>
    				<?php
    			}
    			else
    			{
    				?>
    					<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#connexion">
						  	Connexion
						</button>
    				<?php
    			}
    		?>
			&nbsp; &nbsp;&nbsp;&nbsp;
	      	<a href="<?= base_url("Forum/retour_forum") ?>" class="btn btn-outline-danger">
                <i class="metismenu-icon fa fa-sign-out"></i> &nbsp Retour
            </a>
	  	</div>
	</nav>
	<div class="row">
		<img class=img-responsive src="<?php echo base_url('assets/images/img4.jpg');?>" style="width: 98%; margin: auto; max-height:360px;">
	</div><hr>
	<?php 
		if($this->session->flashdata("correct")!='')
		{
			?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alerte alert alert-success alert-dismissible fade show" role="alert" data-delay="500">
					        <?=$this->session->flashdata("correct");?>
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
					    </div>
					</div>
				</div>
			<?php
		}
		if($this->session->flashdata("incorrect")!='')
		{
			?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="alerte alert alert-danger alert-dismissible fade show" role="alert" data-delay="500">
					        <?=$this->session->flashdata("incorrect");?>
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
					    </div>
					</div>
				</div>
			<?php
		}
	?>
	<section class="row">
		<div class="col-xl-1 col-sm-1 col-md-1"></div>
			<div class="col-xl-10 col-sm-10 col-md-10">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<nav class="navbar navbar-light bg-light">
								<div class="col-xs-8">
									<h2 class="card-title text-center font-weight-bold" style="font-family:'Times New Roman',serif;color:#0D360C; font-weight: bold; font-size:1.5em;">
									<?=$this->session->userdata("titre_sujet"); ?>
									</h2>
								</div>							  	 
							</nav>
							<hr>
							<?php 
								if(isset($liste_post))
								{
									if($liste_post->num_rows()>0)
									{
										foreach ($liste_post->result() as $row) 
										{
											?>
											<div class="row">
												<div class="col-xl-1"></div>
												<div class="card border-info col-xl-10" >
													<div class="card-header">
														<div class="row">
															<div class="col-xl-7">
																<h5 class="card-title text-info">
																	<span class="fa fa-user"></span>&nbsp; <?=$row->nom_membre;?>&nbsp; <?= $row->prenom_membre[0].".";?>
																</h5>
															</div>
															<div class="col-xl-5" style="text-align:right; font-weight: bold;">
																<?php
																	$date_post= new DateTime($row->date_creation_post);
																	$date_jour=new DateTime(date("Y-m-d H:i:s"));
																	$temps=date_diff($date_post,$date_jour);
																	echo "Publié il y a ".$temps->format('%a jours %H heures %i minutes');
																?>
															</div>
														</div>
														
													</div>
										  			<div class="card-body">
										    			<p style="text-align:justify;font-family: 'Times New Roman',serif; font-size: 1.3em; text-indent: 1.2em;"><?=$row->contenu_post;?></p>
										  			</div>
										  			<?php 
														if($this->session->userdata("categorie_compte")!="" && $this->session->userdata("categorie_compte")==0)
														{
															?>
																<div class="card-footer" style="text-align:right;">
													  				<button type="button" name="supprimer" class="supprimer_post btn btn-danger btn-md" id="<?=$row->id_post?>" ><span class="fa fa-trash"></span></button>
													  			</div>
															<?php
														}
													?>
												</div>
												
											</div><br>
											<?php
										}
										
									}
									else
									{
										?>
										<div class="row">
											<div class="col-xl-1"></div>
											<div class="card border-dark col-xl-10" >
									  			<div class="card-body text-dark">
									    			<h5 class="card-title "><span class="fa fa-times-circle"></span>&nbsp; Aucun post disponible pour ce sujet</h5>
									  			</div>
											</div>
										</div><br>
										<?php
									}
								}
								else
								{
									?>
									<div class="row">
										<div class="col-xl-1"></div>
										<div class="card border-danger col-xl-10" >
								  			<div class="card-body text-danger">
								    			<h5 class="card-title">Erreur de chargement de la liste</h5>
								  			</div>
										</div>
										
									</div><br>
									<?php
								}
							?>

							<div class="row">
								<div class="col-xl-1"></div>
									<div class="card border-info col-xl-10" >
										<form method="post" action="<?php echo base_url('Forum/nouveau_post'); ?>">
		     								<div class="card-body text-info">
									    		<h5 class="card-title "><span class="fa fa-plus-circle"></span>&nbsp; Ecrire un reponse</h5>
									    		<hr>
									    		<textarea class="form-control" id="post" name="post" rows="4" required maxlength="500"></textarea>
									  		</div>
									      	<div class="card-footer" style="text-align:right">
										        <button class="btn btn-outline-info" <?php if($this->session->userdata('id_membre')!=''){echo 'type="submit"';}else{ echo 'type="button" data-toggle="modal" data-target="#connexion"';}?>>Poster</button>
									      	</div>
									    </form>
									</div>
									<hr>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="col-xl-1 col-sm-1 col-md-1"></div>
	</section><br>

	<!-- Modal -->
	<div class="modal fade" id="connexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	    		<form method="post" action="<?php echo base_url('Forum/authentification'); ?>">
		     		<div class="modal-header">
		        		<h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Formulaire de Connexion</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true" class="text-danger">&times;</span>
		        		</button>
		      		</div>
	      			<div class="modal-body">
	      				<div class="form-row font-weight-bold">
	      					<span  style="text-align:center;">Veuillez entrer vos paramètres pour publier dans le Forum</span>
	      				</div><hr>
					 	<div class="form-row">
					  		<div class="col-md-1 mb-3"></div>
					  		<div class="col-md-10 mb-3">
					      		<div class="input-group">
							        <div class="input-group-prepend">
							          <span class="input-group-text fa fa-user" id="inputGroupPrepend3"></span>
							        </div>
							        <input type="text" class="form-control is-valid" name="login" id="login" placeholder="Identifiant" aria-describedby="inputGroupPrepend3" required>
					      		</div>
					    	</div>
  						</div>
  						<div class="form-row">
					  		<div class="col-md-1 mb-3"></div>
					  		<div class="col-md-10 mb-3">
					      		<div class="input-group">
							        <div class="input-group-prepend">
							          <span class="input-group-text fa fa-lock" id="inputGroupPrepend3"></span>
							        </div>
							        <input type="password" class="form-control is-valid" id="password" placeholder="Mot de Passe" aria-describedby="inputGroupPrepend3" required name="password">
							        <div class="input-group-append">
								        <span class="input-group-text" id="adon"><a href=""><i class="fa fa-eye-slash" aria-hidden="true" id="yeux"></i></a></span>
								    </div>
					      		</div>
					    	</div>
  						</div>
	      			</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				        <button class="btn btn-success" type="submit">Valider</button>
			      	</div>
			    </form>
	    	</div>
	  	</div>
	</div>
	<div class="modal fade" id="new_sujet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	    		<form method="post" action="<?php echo base_url('Forum/nouveau_sujet'); ?>">
		     		<div class="modal-header">
		        		<h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Ajouter un nouveau sujet</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true" class="text-danger">&times;</span>
		        		</button>
		      		</div>
	      			<div class="modal-body">
	      				<div class="form-row font-weight-bold">
	      					<span  style="text-align:center;">Saisir l'intitulé du sujet</span>
	      				</div><hr>
					 	<div class="form-row">
					  		<div class="col-md-1 mb-3"></div>
					  		<div class="col-md-10 mb-3">
					      		<div class="input-group">
							        <div class="input-group-prepend">
							          <span class="input-group-text fa fa-comments-o" id="inputGroupPrepend3"></span>
							        </div>
							        <input type="text" class="form-control is-valid" name="intitule" id="intitule" placeholder="Intitule" aria-describedby="inputGroupPrepend3" required maxlength="250">
					      		</div>
					    	</div>
  						</div>
  						<div class="form-group">
						    <label for="post">Votre question :</label>
						    <textarea class="form-control is-valid" id="post" name="post" rows="3" required maxlength="500"></textarea>
						</div>
	      			</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				        <button class="btn btn-success" type="submit">Valider</button>
			      	</div>
			    </form>
	    	</div>
	  	</div>
	</div>

	
	<script src="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.js");?>"></script>
	<script type="text/javascript">
	    $(document).ready(function()
	    {
	        $(document).on('click','.supprimer_post',function(){ 
	            var id = $(this).attr("id");
	            swal({
	              title: "Etes-vous sûr de vouloir supprimer ce post ?",
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
	                        url: "<?php  echo base_url('Forum/supprimer_post/');?>"+id,
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
	<script type="text/javascript">
		$(document).ready(function() {
		    $("#adon").on('click', function(event) {
		        event.preventDefault();
		        if($('#password').attr("type") == "text"){
		            $('#password').attr('type', 'password');
		            $('#yeux').addClass( "fa-eye-slash" );
		            $('#yeux').removeClass( "fa-eye" );
		        }else if($('#password').attr("type") == "password"){
		            $('#password').attr('type', 'text');
		            $('#yeux').removeClass( "fa-eye-slash" );
		            $('#yeux').addClass( "fa-eye" );
		        }
		    });
		    setTimeout(function() {
			  $(".alerte").fadeOut().empty();
			}, 1500);
		});
	</script>
</body>
	
	
</html>
