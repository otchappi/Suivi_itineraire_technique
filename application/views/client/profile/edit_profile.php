<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
	<?php
		if($infos_connecte->num_rows()>0)
		{
			foreach ($infos_connecte->result() as $row) 
			{
				$nom_membre=$row->nom_membre;
				$prenom_membre=$row->prenom_membre;
				$date_naissance_membre=$row->date_naiss_membre;
				$lieu_naissance_membre=$row->lieu_naiss_membre;
				$sexe_membre=$row->sexe_membre;
				$nationalite_membre=$row->nationalite_membre;
				$date_arrivee_membre=$row->date_arrivee_membre;
				$telephone_membre=$row->telephone_membre;
				$email_membre=$row->email_membre;
				$domicile_membre=$row->domicile_membre;
				$photo_membre=$row->photo_membre;
				$id_membre=$row->id_membre;
			}
		}
	?>
 <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/design-file/bootstrap-fileupload/bootstrap-fileupload.css" />
 <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/vendors/design-file/design-file.css" />
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-user icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Profil
						<div class="page-title-subheading">
							
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Profile');?>">Profil &nbsp / &nbsp</a>Modification
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 card">
				<div class="card-body">
					<div class="row">
						<div class="col-xl-1 col-sm-2"></div>
						<div class="col-xl-10 col-sm-10">
							<div class="row">
								<div class="card-shadow-primary border mb-3 card card-body border-primary" style="padding:5px;">
									<h4 class="text-success font-weight-bold text-center" style="font-family:'Times New Roman',serif;">
										Formulaire de modification
									</h4>
								</div>
							</div>
							<form method="post" class="form-horizontal" action="<?php if(isset($id_membre)) {echo base_url('Profile/valider_formulaire/'.$id_membre);}
								else{if(isset($id_membre_modif)){echo base_url('Profile/valider_formulaire/'.$id_membre_modif);}}?>" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-4">
										<h1 style="font-size: 1.2em; ">&nbsp; Date d'arrivée : &nbsp;<strong><?php if(isset($date_arrivee_membre)){ $date_arr= new DateTime($date_arrivee_membre); echo $date_arr->format("d-m-Y");}?></strong> </h1>
									</div>
									<div class="col-md-8">
										<h1 class="text-right font-weight-bold text-danger" style="font-size: 1.1em; ">&nbsp &nbsp &nbsp Tous les champs ayant des (*) sont obligatoires</h1>
									</div>									
									<br/>
								</div>
								<hr>
								<div class="row">
									<table class="table table-striped" style="width: 100%;">
										<tr>
											<td colspan="3" style="margin:auto;">
												<div class="row">
													<div class="col-md-4"></div>
													<div class="col-md-4">
														<div class="fileupload fileupload-new" data-provides="fileupload" style="margin-left: 10px;">
															<div class="fileupload-new thumbnail" style=" height: 120px; border: -webkit-box-shadow:0 1px 2px rgb(0,0,0); box-shadow: 0 1px 2px rgb(0,0,0);">
																<img src="<?php if(isset($photo_membre)){echo base_url($photo_membre);}else{ echo 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Votre+photo';}?>" class="img-rounded" alt="photo" style="width: 100%;height: 125px;" />
															</div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="width: 100%; max-width: 180px; max-height: 120px; line-height: 20px;">
															</div>
															<div>
																<span class="btn btn-theme03 btn-file">
																	<span class="fileupload-new" >
																		<i class="fa fa-paperclip"></i> Charger votre photo
																	</span>						                   
																	<span class="fileupload-exists">
																		<i class="fa fa-undo"></i> Changer
																	</span>
																	<input type="file" class="default" name="photos" id="photos" />
																</span>
															</div>
														</div>
													</div>
												</div>												
											</td>											
										</tr>
										<tr>
											<td style="width:10%;"><span class="text-danger">* &nbsp;</span>Nom</td>
											<td>:</td>
											<td>
												<input name="nom" id="nom" type="text" class="form-control" required value="<?php 
													if(isset($nom_membre)){echo $nom_membre;}
													else{ echo set_value('nom');}
												?>" maxlength="200">
												<span class="text-danger"><?php echo form_error("nom"); ?></span> 
											</td>
										</tr>
										<tr>
											<td><span class="text-danger">* &nbsp;</span>Prénom</td>
											<td>:</td>
											<td>
												<input name="prenom" id="prenom" type="text" class="form-control" required="required" value="<?php 
													if(isset($prenom_membre)){echo $prenom_membre;}
													else{ echo set_value('prenom');}
												?>" maxlength="200">
												<span class="text-danger"><?php echo form_error("prenom"); ?></span>
											</td>
										</tr>
										<tr>
											<td>Né(e) le</td>
											<td>:</td>
											<td>
												<input type="date" class="form-control" id="date_naiss" name="date_naiss" value="<?php 
									if(isset($date_naissance_membre)){echo $date_naissance_membre;}
									else{ echo set_value('date_naiss');}
									?>"  min="1930-01-01" max="<?=date("Y-m-d");?>">
											</td>
										</tr>
										<tr>
											<td>Né(e) à</td>
											<td>:</td>
											<td>
												<input type="text" class="form-control" id="lieu_naiss" name="lieu_naiss" value="<?php 
												if(isset($lieu_naissance_membre)){echo $lieu_naissance_membre;}
												else{ echo set_value('lieu_naiss');}
												?>" maxlength="200">
												<span class="text-danger"><?php echo form_error("lieu_naiss"); ?></span>
											</td>
										</tr>
										<tr>
											<td>Sexe</td>
											<td>:</td>
											<td>
												<select id="sexe" name="sexe" class="form-control" >
													<?php 
														if(isset($sexe_membre)){
															if($sexe_membre=="1")
															{?>
																<option value="1" selected>Masculin</option>
																<option value="0">Féminin</option><?php
															}
															else
															{?>
																<option value="1">Masculin</option>
																<option value="0" selected>Féminin</option><?php
															}
														}
														else
														{ ?>
															<option value="1">Masculin</option>
															<option value="0">Féminin</option><?php
														}
													?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Nationalité</td>
											<td>:</td>
											<td>
												<select name="nationalite" id="nationalite" class="form-control">
													<?php 
														if(isset($nationalite_membre))
														{
															?>
																<option value="<?=$nationalite_membre;?>"><?=$nationalite_membre;?></option>
															<?php
														}
													?>
													<option value="Afghanistan">Afghanistan </option>
													<option value="Afrique_Centrale">Afrique_Centrale </option>
													<option value="Afrique_du_sud">Afrique_du_Sud </option>
													<option value="Albanie">Albanie </option>
													<option value="Algerie">Algerie </option>
													<option value="Allemagne">Allemagne </option>
													<option value="Andorre">Andorre </option>
													<option value="Angola">Angola </option>
													<option value="Anguilla">Anguilla </option>
													<option value="Arabie_Saoudite">Arabie_Saoudite </option>
													<option value="Argentine">Argentine </option>
													<option value="Armenie">Armenie </option>
													<option value="Australie">Australie </option>
													<option value="Autriche">Autriche </option>
													<option value="Azerbaidjan">Azerbaidjan </option>

													<option value="Bahamas">Bahamas </option>
													<option value="Bangladesh">Bangladesh </option>
													<option value="Barbade">Barbade </option>
													<option value="Bahrein">Bahrein </option>
													<option value="Belgique">Belgique </option>
													<option value="Belize">Belize </option>
													<option value="Benin">Benin </option>
													<option value="Bermudes">Bermudes </option>
													<option value="Bielorussie">Bielorussie </option>
													<option value="Bolivie">Bolivie </option>
													<option value="Botswana">Botswana </option>
													<option value="Bhoutan">Bhoutan </option>
													<option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
													<option value="Bresil">Bresil </option>
													<option value="Brunei">Brunei </option>
													<option value="Bulgarie">Bulgarie </option>
													<option value="Burkina_Faso">Burkina_Faso </option>
													<option value="Burundi">Burundi </option>

													<option value="Caiman">Caiman </option>
													<option value="Cambodge">Cambodge </option>
													<option value="Cameroun" <?php 
														if(!(isset($nationalite_membre)))
														{
															?>
																selected="selected"
															<?php
														}
													?>>Cameroun </option>
													<option value="Canada">Canada </option>
													<option value="Canaries">Canaries </option>
													<option value="Cap_vert">Cap_Vert </option>
													<option value="Chili">Chili </option>
													<option value="Chine">Chine </option>
													<option value="Chypre">Chypre </option>
													<option value="Colombie">Colombie </option>
													<option value="Comores">Colombie </option>
													<option value="Congo">Congo </option>
													<option value="Congo_democratique">Congo_democratique </option>
													<option value="Cook">Cook </option>
													<option value="Coree_du_Nord">Coree_du_Nord </option>
													<option value="Coree_du_Sud">Coree_du_Sud </option>
													<option value="Costa_Rica">Costa_Rica </option>
													<option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
													<option value="Croatie">Croatie </option>
													<option value="Cuba">Cuba </option>

													<option value="Danemark">Danemark </option>
													<option value="Djibouti">Djibouti </option>
													<option value="Dominique">Dominique </option>

													<option value="Egypte">Egypte </option>
													<option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
													<option value="Equateur">Equateur </option>
													<option value="Erythree">Erythree </option>
													<option value="Espagne">Espagne </option>
													<option value="Estonie">Estonie </option>
													<option value="Etats_Unis">Etats_Unis </option>
													<option value="Ethiopie">Ethiopie </option>

													<option value="Falkland">Falkland </option>
													<option value="Feroe">Feroe </option>
													<option value="Fidji">Fidji </option>
													<option value="Finlande">Finlande </option>
													<option value="France">France </option>

													<option value="Gabon">Gabon </option>
													<option value="Gambie">Gambie </option>
													<option value="Georgie">Georgie </option>
													<option value="Ghana">Ghana </option>
													<option value="Gibraltar">Gibraltar </option>
													<option value="Grece">Grece </option>
													<option value="Grenade">Grenade </option>
													<option value="Groenland">Groenland </option>
													<option value="Guadeloupe">Guadeloupe </option>
													<option value="Guam">Guam </option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guernesey">Guernesey </option>
													<option value="Guinee">Guinee </option>
													<option value="Guinee_Bissau">Guinee_Bissau </option>
													<option value="Guinee equatoriale">Guinee_Equatoriale </option>
													<option value="Guyana">Guyana </option>
													<option value="Guyane_Francaise ">Guyane_Francaise </option>

													<option value="Haiti">Haiti </option>
													<option value="Hawaii">Hawaii </option>
													<option value="Honduras">Honduras </option>
													<option value="Hong_Kong">Hong_Kong </option>
													<option value="Hongrie">Hongrie </option>

													<option value="Inde">Inde </option>
													<option value="Indonesie">Indonesie </option>
													<option value="Iran">Iran </option>
													<option value="Iraq">Iraq </option>
													<option value="Irlande">Irlande </option>
													<option value="Islande">Islande </option>
													<option value="Israel">Israel </option>
													<option value="Italie">italie </option>

													<option value="Jamaique">Jamaique </option>
													<option value="Jan Mayen">Jan Mayen </option>
													<option value="Japon">Japon </option>
													<option value="Jersey">Jersey </option>
													<option value="Jordanie">Jordanie </option>

													<option value="Kazakhstan">Kazakhstan </option>
													<option value="Kenya">Kenya </option>
													<option value="Kirghizstan">Kirghizistan </option>
													<option value="Kiribati">Kiribati </option>
													<option value="Koweit">Koweit </option>

													<option value="Laos">Laos </option>
													<option value="Lesotho">Lesotho </option>
													<option value="Lettonie">Lettonie </option>
													<option value="Liban">Liban </option>
													<option value="Liberia">Liberia </option>
													<option value="Liechtenstein">Liechtenstein </option>
													<option value="Lituanie">Lituanie </option>
													<option value="Luxembourg">Luxembourg </option>
													<option value="Lybie">Lybie </option>

													<option value="Macao">Macao </option>
													<option value="Macedoine">Macedoine </option>
													<option value="Madagascar">Madagascar </option>
													<option value="Madère">Madère </option>
													<option value="Malaisie">Malaisie </option>
													<option value="Malawi">Malawi </option>
													<option value="Maldives">Maldives </option>
													<option value="Mali">Mali </option>
													<option value="Malte">Malte </option>
													<option value="Man">Man </option>
													<option value="Mariannes du Nord">Mariannes du Nord </option>
													<option value="Maroc">Maroc </option>
													<option value="Marshall">Marshall </option>
													<option value="Martinique">Martinique </option>
													<option value="Maurice">Maurice </option>
													<option value="Mauritanie">Mauritanie </option>
													<option value="Mayotte">Mayotte </option>
													<option value="Mexique">Mexique </option>
													<option value="Micronesie">Micronesie </option>
													<option value="Midway">Midway </option>
													<option value="Moldavie">Moldavie </option>
													<option value="Monaco">Monaco </option>
													<option value="Mongolie">Mongolie </option>
													<option value="Montserrat">Montserrat </option>
													<option value="Mozambique">Mozambique </option>

													<option value="Namibie">Namibie </option>
													<option value="Nauru">Nauru </option>
													<option value="Nepal">Nepal </option>
													<option value="Nicaragua">Nicaragua </option>
													<option value="Niger">Niger </option>
													<option value="Nigeria">Nigeria </option>
													<option value="Niue">Niue </option>
													<option value="Norfolk">Norfolk </option>
													<option value="Norvege">Norvege </option>
													<option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
													<option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

													<option value="Oman">Oman </option>
													<option value="Ouganda">Ouganda </option>
													<option value="Ouzbekistan">Ouzbekistan </option>

													<option value="Pakistan">Pakistan </option>
													<option value="Palau">Palau </option>
													<option value="Palestine">Palestine </option>
													<option value="Panama">Panama </option>
													<option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
													<option value="Paraguay">Paraguay </option>
													<option value="Pays_Bas">Pays_Bas </option>
													<option value="Perou">Perou </option>
													<option value="Philippines">Philippines </option>
													<option value="Pologne">Pologne </option>
													<option value="Polynesie">Polynesie </option>
													<option value="Porto_Rico">Porto_Rico </option>
													<option value="Portugal">Portugal </option>

													<option value="Qatar">Qatar </option>

													<option value="Republique_Dominicaine">Republique_Dominicaine </option>
													<option value="Republique_Tcheque">Republique_Tcheque </option>
													<option value="Reunion">Reunion </option>
													<option value="Roumanie">Roumanie </option>
													<option value="Royaume_Uni">Royaume_Uni </option>
													<option value="Russie">Russie </option>
													<option value="Rwanda">Rwanda </option>

													<option value="Sahara Occidental">Sahara Occidental </option>
													<option value="Sainte_Lucie">Sainte_Lucie </option>
													<option value="Saint_Marin">Saint_Marin </option>
													<option value="Salomon">Salomon </option>
													<option value="Salvador">Salvador </option>
													<option value="Samoa_Occidentales">Samoa_Occidentales</option>
													<option value="Samoa_Americaine">Samoa_Americaine </option>
													<option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
													<option value="Senegal">Senegal </option>
													<option value="Seychelles">Seychelles </option>
													<option value="Sierra Leone">Sierra Leone </option>
													<option value="Singapour">Singapour </option>
													<option value="Slovaquie">Slovaquie </option>
													<option value="Slovenie">Slovenie</option>
													<option value="Somalie">Somalie </option>
													<option value="Soudan">Soudan </option>
													<option value="Sri_Lanka">Sri_Lanka </option>
													<option value="Suede">Suede </option>
													<option value="Suisse">Suisse </option>
													<option value="Surinam">Surinam </option>
													<option value="Swaziland">Swaziland </option>
													<option value="Syrie">Syrie </option>

													<option value="Tadjikistan">Tadjikistan </option>
													<option value="Taiwan">Taiwan </option>
													<option value="Tonga">Tonga </option>
													<option value="Tanzanie">Tanzanie </option>
													<option value="Tchad">Tchad </option>
													<option value="Thailande">Thailande </option>
													<option value="Tibet">Tibet </option>
													<option value="Timor_Oriental">Timor_Oriental </option>
													<option value="Togo">Togo </option>
													<option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
													<option value="Tristan da cunha">Tristan de cuncha </option>
													<option value="Tunisie">Tunisie </option>
													<option value="Turkmenistan">Turmenistan </option>
													<option value="Turquie">Turquie </option>

													<option value="Ukraine">Ukraine </option>
													<option value="Uruguay">Uruguay </option>

													<option value="Vanuatu">Vanuatu </option>
													<option value="Vatican">Vatican </option>
													<option value="Venezuela">Venezuela </option>
													<option value="Vierges_Americaines">Vierges_Americaines </option>
													<option value="Vierges_Britanniques">Vierges_Britanniques </option>
													<option value="Vietnam">Vietnam </option>

													<option value="Wake">Wake </option>
													<option value="Wallis et Futuma">Wallis et Futuma </option>

													<option value="Yemen">Yemen </option>
													<option value="Yougoslavie">Yougoslavie </option>

													<option value="Zambie">Zambie </option>
													<option value="Zimbabwe">Zimbabwe </option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Téléphone</td>
											<td>:</td>
											<td>
												<input type="text" class="form-control" name="telephone" id="telephone" maxlength="50" value="<?php 
														if(isset($telephone_membre)){echo $telephone_membre;}
														else{ echo set_value('telephone');}
												?>">			
												<span class="text-danger"><?php echo form_error("telephone"); ?></span>
											</td>
										</tr>
										<tr>
											<td><span class="text-danger">* &nbsp;</span>Email</td>
											<td>:</td>
											<td>
												<input type="email" class="form-control" name="email" id="email" maxlength="200" value="<?php 
														if(isset($email_membre)){echo $email_membre;}
														else{ echo set_value('email');}
												?>" required>			
												<span class="text-danger"><?php echo form_error("email"); ?></span>
											</td>
										</tr>
										<tr>
											<td>Domicile</td>
											<td>:</td>
											<td>
												<input type="text" class="form-control" name="domicile" id="domicile" maxlength="100" value="<?php 
														if(isset($domicile_membre)){echo $domicile_membre;}
														else{ echo set_value('domicile');}
												?>">			
												<span class="text-danger"><?php echo form_error("domicile"); ?></span>
											</td>
										</tr>
									</table>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-2">
										<a class="mb-2 mr-2 btn-transition btn btn-outline-danger" style="width:100%;" href="<?= base_url() ?>profile">
											Annuler
										</a>
									</div>
									<div class="col-md-2">
										<input class="mb-2 mr-2 btn-transition btn btn-outline-success" style="width:100%;" type="submit" name="valider" value="Enregistrer"/>
									</div>
								</div>
							</form>
							<hr>
						</div>
					</div>
				</div>
			</div>
			<br>
		</div>
	</div>
	</div>
</div>
</div>

	<script type="text/javascript" src="<?= base_url(); ?>assets/vendors/design-file/bootstrap-fileupload/bootstrap-fileupload.js"></script>
