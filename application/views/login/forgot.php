<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Mot de Passe Oublié</title>
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url('assets/images/logo.png')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/font-awesome-4.7/css/font-awesome.min.css");?>">
	<link href="<?php echo base_url('assets/vendors/login/css/my-login.css')?>" rel="stylesheet">
	<script src="<?= js('vendors/js/jquery-3.6.0.min') ?>"></script>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?php echo base_url('assets/images/logo.png')?>" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center">Mot de passe oublié</h4><hr>
							<form method="post" action="<?php echo base_url('Index/reinitialiser_mdp'); ?>" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="login" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">Identifiant</label>
									<input id="login" type="text" class="form-control" name="login" required value=""/>
								</div>
								<div class="form-group">
									<label for="email" style="font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">Adresse email</label>
									<input id="email" type="email" class="form-control" name="email" value="" required >
									<div class="form-text text-muted">
										En cliquant sur "Réinitialiser" vous recevrez vos nouveaux identifiants à cette adresse
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12 text-center" style="color:red; font-family: 'Times New Roman',Arial,serif; font-size: 1.3em;">
											<?php echo $this->session->flashdata("incorrect"); ?>
									</div>
								</div>
								<div class="form-group m-0">
									<input class="btn btn-outline-success btn-block" type="submit" name="valider" value="Réinitialiser"/>
								</div>
								<div class="mt-4 text-center">
									<a href="<?= base_url() ?>index/page_de_connexion">Retour à la page de connexion</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; SSA
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/my-login.js"></script>
	<script src="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.js");?>"></script>
</body>
</html>