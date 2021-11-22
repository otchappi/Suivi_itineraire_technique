<?php
	if($this->session->userdata('operation')!='')
	{
		if($this->session->userdata('operation'))
		{?>
			<script type="text/javascript">
				alert('Réinitialisation effectuée ! Vérifiez vos mails');
			</script><?php
		}
		$this->session->unset_userdata('operation');
	}
?>
	<?php 
      $this->session->unset_userdata('identifiant');
      $this->session->unset_userdata('mot_de_passe');
      $this->session->unset_userdata('id_membre');
      $this->session->unset_userdata('nom_membre');
      $this->session->unset_userdata('prenom_membre');
      $this->session->unset_userdata('categorie_compte');
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Connexion</title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('assets/images/logo.png')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/font-awesome-4.7/css/font-awesome.min.css");?>">
	<link href="<?php echo base_url('assets/vendors/login/css/my-login.css')?>" rel="stylesheet">
	<script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
</head>
<body class="my-login-page">
	<section class="row">
		<div class="col-xl-4 col-sm-1 col-md-3"></div>
			<div class="col-xl-4 col-sm-10 col-md-6">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?php echo base_url('assets/images/logo.png');?>" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h3 class="card-title text-center">Connexion</h3>
							<hr>
							<form  method="post" action="<?php echo base_url('Index/authentification'); ?>" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="login" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">Identifiant</label>
									<input id="login" type="text" class="form-control" name="login" required/>
								</div>
 
								<div class="form-group">
								    <label for="password" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">Mot de passe</label>
								    <div class="input-group" id="show_hide_password">
								    	<input id="password" type="password" class="form-control" name="password" required/>
								      	<div class="input-group-append">
								        	<span class="input-group-text" id="adon"><a href=""><i class="fa fa-eye-slash  text-success" aria-hidden="true" id="yeux"></i></a></span>
								      	</div>
								    </div>
								    <a href="<?= base_url() ?>index/mot_passe_oublie" class="float-right">
										Mot de passe oublie?
									</a>
								</div><hr>
								<div class="row">
									<div class="col-xl-12 text-center" style="color:red; font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">
										<?php  
											if(!empty($this->session->flashdata("incorrect")))
											{
												echo $this->session->flashdata("incorrect");
											}
											else if(!empty($this->session->flashdata("creation")))
											{
												echo $this->session->flashdata("creation");
											}
										?>
									</div>
								</div>
								<div class="form-group m-0">
									<input class="btn btn-outline-success btn-block" type="submit" name="valider" value="Connexion"/>
								</div>
								<div class="mt-4 text-center">		
									<a href="<?= base_url() ?>index">Retour à l'Accueil</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; SSA 
					</div>
				</div>
			</div>
		<div class="col-xl-4 col-sm-1 col-md-3"></div>
	</section>
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
		});
	</script>
</body>
	<script src="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.js");?>"></script>
</html>
