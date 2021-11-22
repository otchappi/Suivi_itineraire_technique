 <?php
	if(isset($identite))
	{
		if($identite->num_rows()>0)
		{
			foreach ($identite->result() as $row) 
			{
				$nom_identite=$row->nom_identite;
				$email_identite=$row->email_identite;
				$telephone_identite=$row->telephone_identite;
				$logo_identite=$row->logo_identite;
				$adresse_identite=$row->adresse_identite;
				$raison_sociale_identite=$row->raison_sociale_identite;
				$infos_supplementaire=$row->infos_supplementaire;
			}
		}
	}
?>
<?php
	if(isset($infos_dossier))
		{
			foreach ($infos_dossier as $row) 
			{
				$nom_candidat=$row->nom_candidat;
				$prenom_candidat=$row->prenom_candidat;
				$telephone_candidat=$row->telephone_candidat;
				$date_naiss=$row->date_naiss;
				$lieu_naiss=$row->lieu_naiss;
				$sexe=$row->sexe;
				$num_extrait_acte=$row->num_extrait_acte;
				$nom_pere=$row->nom_pere;
				$nom_mere=$row->nom_mere;
				$email_candidat=$row->email_candidat;
				$domicile_candidat=$row->domicile_candidat;
				$photo_candidat=$row->photo_candidat;
				$libelle_type_candidat=$row->libelle_type_candidat;
				$nom_etablissement=$row->nom_etablissement;
				$code_etablissement=$row->code_etablissement;
				$date_creation_dossier=$row->date_creation_dossier;
				$statut_dossier=$row->statut_dossier;
				$aptitude=$row->aptitude;
				$libelle_serie=$row->libelle_serie;
				$telephone_etablissement=$row->telephone_etablissement;
				$adresse_etablissement=$row->adresse_etablissement;
				$responsable_etablissement=$row->responsable_etablissement;
			}
		}
		if(isset($infos_centre))
		{
			foreach ($infos_centre->result() as $row) 
			{
				$nom_centre=$row->nom_etablissement;
				$code_centre=$row->code_etablissement;				
			}
		}
?>
<style type="text/css">
	.zone th
	{
		color: white;
		padding-top: 6px; 
		padding-bottom: 6px;
		padding-left: 5px;
	}
	.zone td
	{
		padding-top:6px; 
		padding-bottom: 6px;
		padding-left: 5px;
		font-family: 'Times New Roman',serif;
	}
	#recep th
	{
		color: white;
		padding-top: 0px; 
		padding-bottom: 0px;
	}
	#recep td
	{
		padding-top: 0px; 
		padding-bottom: 0px;
		font-family: 'Times New Roman',serif;
	}
</style>
<head>
	<title>Formulaire de Candidature</title>
</head>
<div style="border-bottom:2px black solid;">
	<table style="width: 100%;">
		<tr>
			<td colspan="3">
				<div style="text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1.3em;font-weight: bold;color:#1F8DEF;">
					<?php if(isset($nom_identite)){echo $nom_identite;} ?>					
				</div>
			</td>
			<td rowspan="7">
				<div style="border: 2px solid black; text-align: justify; padding: 10px; font-weight: bold; font-size: 0.8em;">
					Photo numérique 4x4 datant de moins de 3 mois et présentant au-dessus, la date de prise de vue et en dessous :
					<br>-Les noms et prénoms;
					<br>-Le code OBC de l'examen;
					<br>-Le statut du candidat (CR,CS ou CL);
					<br>-Le code de l'établissement fréquenté.
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style=" text-align: right; font-weight: bold;">BP : <?php if(isset($adresse_identite)){echo $adresse_identite;} ?></div>
			</td>
			<td style="width: 1%; text-align: center; font-weight: bold;">-</td>
			<td>
				<div style=" text-align: left; font-weight: bold;">Tel : <?php if(isset($telephone_identite)){echo $telephone_identite;} ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<div style=" text-align: right; font-weight: bold;"><?php if(isset($infos_supplementaire)){echo $infos_supplementaire;} ?></div>
			</td>
			<td style="text-align: center; font-weight: bold;">-</td>
			<td>
				<div style="text-align: left; font-weight: bold;">Email : <?php if(isset($email_identite)){echo $email_identite;} ?></div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1.2em;font-weight: bold;">	
					FICHE D'INSCRIPTION			
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="text-transform: uppercase; text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1.1em;font-weight: bold;">	
					<?php 
						if(isset($intitule_examen))
						{
							foreach ($intitule_examen  as $row) 
							{
								echo $row->libelle_examen;
							}
						}
					?>		
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="text-transform: uppercase; text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1em;font-weight: bold;">	Session de 
					<?php 
						if(isset($intitule_session))
						{
							foreach ($intitule_session  as $row) 
							{
								echo $row->libelle_session;
							}
						}
					?>		
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style="text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 0.9em;font-weight: bold;">
					NB : En cas de surcharge, votre dossier sera purement et simplement rejeté.
				</div>
			</td>
		</tr>
	</table>	
</div>

<div style="margin-bottom: 10px;" id="content">

	<div style="margin: auto;  width: 100%;">
		<table style="width: 100%;">
			<tr>
				<td style="width: 58%; border-right:2px black solid;">
					<table class="zone" style="text-align: left; font-family:'Times New Roman',serif; font-size:1em;">
						<tr>
							<td>Extraite de l'acte N°</td>
							<td>:</td>
							<td><strong><?php if(isset($num_extrait_acte)){echo $num_extrait_acte;}?></strong></td>
						</tr>
						<tr>
							<td>Nom</td>
							<td>:</td>
							<td><strong><?php if(isset($nom_candidat)){echo $nom_candidat;}?></strong></td>
						</tr>
						<tr>
							<td >Prénom</td>
							<td style="width:1%;">:</td>
							<td><strong><?php if(isset($prenom_candidat)){echo $prenom_candidat;}?></strong></td>
						</tr>
						<tr>
							<td>Né (e) le</td>
							<td>:</td>
							<td><strong><?php if(isset($date_naiss)){echo $date_naiss;}?></strong></td>
						</tr>
						<tr>
							<td>A (lieu)</td>
							<td>:</td>
							<td><strong><?php if(isset($lieu_naiss)){echo $lieu_naiss;}?></strong></td>
						</tr>
						<tr>
							<td>Sexe</td>
							<td>:</td>
							<td><strong><?php if(isset($sexe)){echo $sexe;}?></strong></td>
						</tr>
						<tr>
							<td>Nom du père</td>
							<td>:</td>
							<td><strong><?php if(isset($nom_pere)){echo $nom_pere;}?></strong></td>
						</tr>
						<tr>
							<td>Nom de la mère</td>
							<td>:</td>
							<td><strong><?php if(isset($nom_mere)){echo $nom_mere;}?></strong></td>
						</tr>
					</table>
					
					<div style="text-align:justify; padding-left: 5px; border-top:1px solid black;">Sécrétaire d'Etat Civil &nbsp; &nbsp; Signature de l'Officier d'Etat Civil</div><br><br><br>
					<div style="text-align:center;"><strong>Certifie le présent extrait à l'acte qui nous a été présenté</strong></div><br>
					<div>
						<div style=" margin: auto; width: 60%; border: 1px solid black; text-align:center;">
							<br> TIMBRE <br><br> 
						</div><br>
						<div style="margin: auto; width: 100%;">
							Le ______________________ A ______________________							
						</div>
					</div>
				</td>
				<td style="width: 42%;">
					<table class="zone" style="text-align: left; font-family:'Times New Roman',serif; font-size:1em;">
						<tr>
							<td>N° du bordereau</td>
							<td>:</td>
							<td><strong></strong></td>
						</tr>
						<tr>
							<td>Sexe</td>
							<td>:</td>
							<td><strong><?php if(isset($sexe)){echo $sexe;}?></strong></td>
						</tr>
						<tr>
							<td>Série/Spécialité</td>
							<td style="width:1%;">:</td>
							<td><strong><?php if(isset($libelle_serie)){echo $libelle_serie;}?></strong></td>
						</tr>
						<tr>
							<td>Deuxième langue</td>
							<td>:</td>
							<td><strong><?php if(isset($responsable)){echo $responsable;}?></strong></td>
						</tr>
						<tr>
							<td>Etablissement</td>
							<td >:</td>
							<td style="text-align:center;"><strong><?php if(isset($nom_etablissement)){echo $nom_etablissement;}?> &nbsp; (<?php if(isset($code_etablissement)){echo $code_etablissement;}?>)</strong></td>
						</tr>
						<tr>
							<td>Centre d'inscription</td>
							<td>:</td>
							<td style="text-align:center;"><strong><?php if(isset($nom_centre)){echo $nom_centre;}?> &nbsp; (<?php if(isset($code_centre)){echo $code_centre;}?>)</strong></td>
						</tr>
						<tr>
							<td>Education physique et sportive</td>
							<td>:</td>
							<td><strong><?php if(isset($aptitude)){if($aptitude=="1"){echo "Apte";}else{echo "Inapte";}}?></strong></td>
						</tr>
						<tr>
							<td colspan="3">Fait le&nbsp;_________________________</td>
						</tr>
						<tr>
							<td colspan="3">Fait à &nbsp;_________________________</td>
						</tr>
						<tr>
							<td style="text-align:center;"><strong>Signature du candidat</strong></td>
							<td colspan="2" style="text-align:center;"><strong>Empreintes Pouce droit</strong></td>
						</tr>
					</table>
				</td>
			</tr>
		</table><br><br>
		<div style="border-top: dashed 2px black;">
			<div><strong>Partie II : RECEPISSE (A détacher et à remettre au candidat)</strong></div>
			<table style="width: 100%;" id="recep">
				<tr>
					<td colspan="3">
						<div style="text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1.2em;font-weight: bold;">
							<?php if(isset($nom_identite)){echo $nom_identite;} ?>					
						</div>
					</td>
					<td rowspan="5">
						<div style="border: 1px solid black; text-align: justify; padding: 5px; font-weight: bold; font-size: 0.6em;">
							Photo numérique 4x4 datant de moins de 3 mois et présentant au-dessus, la date de prise de vue et en dessous :
							<br>-Les noms et prénoms;
							<br>-Le code OBC de l'examen;
							<br>-Le statut du candidat (CR,CS ou CL);
							<br>-Le code de l'établissement fréquenté.
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 0.8em; text-align: right; font-weight: bold;">BP : <?php if(isset($adresse_identite)){echo $adresse_identite;} ?></div>
					</td>
					<td style=" font-size: 0.8em;width: 1%; text-align: center; font-weight: bold;">-</td>
					<td>
						<div style="font-size: 0.8em; text-align: left; font-weight: bold;">Tel : <?php if(isset($telephone_identite)){echo $telephone_identite;} ?></div>
					</td>
				</tr>
				<tr>
					<td>
						<div style="font-size: 0.8em; text-align: right; font-weight: bold;"><?php if(isset($infos_supplementaire)){echo $infos_supplementaire;} ?></div>
					</td>
					<td style="font-size: 0.8em;text-align: center; font-weight: bold;">-</td>
					<td>
						<div style="font-size: 0.8em;text-align: left; font-weight: bold;">Email : <?php if(isset($email_identite)){echo $email_identite;} ?></div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="text-transform: uppercase; text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 0.8em;font-weight: bold;">	
							<?php 
								if(isset($intitule_examen))
								{
									foreach ($intitule_examen  as $row) 
									{
										echo $row->libelle_examen;
									}
								}
							?>		
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="text-transform: uppercase; text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 0.7em;font-weight: bold;">	Session de 
							<?php 
								if(isset($intitule_session))
								{
									foreach ($intitule_session  as $row) 
									{
										echo $row->libelle_session;
									}
								}
							?>		
						</div>
					</td>
				</tr>
			</table>
			<table style="width: 100%;">
				<tr>
					<td  style="font-size: 0.8em;">N° DU BORDEREAU</td>
					<td style="width:3%;">:</td>
					<td style=" text-transform: uppercase; width:65%;"><strong>&nbsp;&nbsp; </strong>&nbsp;<span style="font-size: 0.8em;">Aptitude : </span>&nbsp;<strong><?php if(isset($aptitude)){if($aptitude=="1"){echo "Apte";}else{echo "Inapte";}} ?></strong></td>
				</tr>
				<tr>
					<td style="font-size: 0.8em;">NOM(S) ET PRENOM(S)</td>
					<td>:</td>
					<td style="text-transform: uppercase;"><strong><?php if(isset($nom_candidat)){echo $nom_candidat;} if(isset($prenom_candidat)){echo " ".$prenom_candidat;} ?></strong></td>
				</tr>
				<tr>
					<td  style="font-size: 0.8em;">DATE ET LIEU DE NAISSANCE</td>
					<td>:</td>
					<td style=" text-transform: uppercase;"><strong><?php if(isset($date_naiss)){echo $date_naiss;} if(isset($lieu_naiss)){echo " à ".$lieu_naiss;} ?></strong></td>
				</tr>
				<tr>
					<td  style="font-size: 0.8em;">ETABLISSEMENT FREQUENTE</td>
					<td>:</td>
					<td style=" text-transform: uppercase;"><strong><?php if(isset($nom_etablissement)){echo $nom_etablissement." ";}?></strong>&nbsp;<span style="font-size: 0.8em;">Série/Spécialite : </span> &nbsp;<strong><?php if(isset($libelle_serie)){echo " ".$libelle_serie;} ?></strong></td>
				</tr>
				<tr>
					<td  style="font-size: 0.8em;">CENTRE D'INSCRIPTION</td>
					<td>:</td>
					<td style=" text-transform: uppercase; "><strong><?php if(isset($nom_centre)){echo $nom_centre;} ?></strong></td>
				</tr>
				<tr>
					<td  style="font-size: 0.8em;">DATE DE DEPOT DE LA FICHE</td>
					<td>:</td>
					<td style=" text-transform: uppercase; "><strong><?php echo date("d-m-Y");?></strong>&nbsp; &nbsp; &nbsp;&nbsp;<span style="font-size: 0.8em;">Tel : </span>&nbsp;<strong><?php  if(isset($telephone_candidat)){echo " ".$telephone_candidat;} ?></strong></td>
				</tr>
			</table>
			<div style="text-align:center;"><strong>NB : Se débarasser de son téléphone portable et présenter ce récépissé à l'entrée de la salle d'examen</strong></div>
		</div>
	</div>
	
	<div style="margin: auto; width: 100%; page-break-before: always;">
		<br>
		<div><strong>Partie III : PAIEMENT DES DROITS D'INSCRIPTION</strong><br>Le Candidat,</div>
		<table style="width: 100%; border-bottom: solid 2px black;">
			<tr>
				<td>
					<table class="zone" style="text-align: left; font-family:'Times New Roman',serif; font-size:1em;">
						<tr>
							<td>Nom (s)</td>
							<td>:</td>
							<td><strong><?php if(isset($nom_candidat)){echo $nom_candidat;}?></strong></td>
						</tr>
						<tr>
							<td >Prénom (s)</td>
							<td style="width:1%;">:</td>
							<td><strong><?php if(isset($prenom_candidat)){echo $prenom_candidat;}?></strong></td>
						</tr>
						<?php 
							if(isset($intitule_examen))
							{
								foreach ($intitule_examen  as $row) 
								{
									$lib_exem=$row->libelle_examen;
									$frais=$row->frais_inscription;
								}
							}
						?>
						<tr>
							<td>Adresse</td>
							<td>:</td>
							<td><strong><?php if(isset($domicile_candidat)){echo $domicile_candidat;}?></strong></td>
						</tr>
						<tr>
							<td>Ville</td>
							<td>:</td>
							<td><strong><?php if(isset($adresse_etablissement)){echo $adresse_etablissement;}?></strong></td>
						</tr>
						<tr>
							<td>Tel chef d'établissement</td>
							<td>:</td>
							<td><strong><?php if(isset($telephone_etablissement)){echo $telephone_etablissement;}?></strong></td>
						</tr>
						<tr>
							<td>Tel du candidat</td>
							<td>:</td>
							<td><strong><?php if(isset($telephone_candidat)){echo $telephone_candidat;}?></strong></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><strong><?php if(isset($email_candidat)){echo $email_candidat;}?></strong></td>
						</tr>
						<tr>
							<td>A versé la somme de </td>
							<td>:</td>
							<td><strong><?php if(isset($frais)){echo $frais;}?> F cfa</strong></td>
						</tr>
						<tr>
							<td>Représentant les droits d'inscription à l'examen du</td>
							<td>:</td>
							<td><strong><?php if(isset($lib_exem)){echo $lib_exem;}?></strong></td>
						</tr>
						<tr>
							<td>Le Chef d'établissement</td>
							<td>:</td>
							<td><strong><?php if(isset($responsable_etablissement)){echo $responsable_etablissement;}?></strong></td>
						</tr>
					</table>
					<br>
					<div style="text-align:justify; padding-left: 5px; border-top:1px solid black;">(Nom, date et cachet du Chef d'établissement)</div><br><br><br><br>
				</td>
				<?php if(isset($aptitude)){if($aptitude=="0"){ ?>
				<td style="width: 42%; border-left:2px black solid; text-align: justify;  font-family:'Times New Roman',serif; padding-left:5px;">
					<div style="font-size:1.2em;">CERTIFICAT MEDICAL (1)</div><br><br><br>
					<div style="font-size:1.2em;">Je soussigné __________________<br><br>_____________________________</div><br>
					<div style="font-size:1.2em;">Docteur en médécine, certifie, après avoir examiné</div><br>
					<div style="font-size:1.2em;"><strong>M.<?php if(isset($nom_candidat)){echo $nom_candidat;} if(isset($prenom_candidat)){echo " ".$prenom_candidat;}?></strong></div><br>
					<div style="font-size:1.2em;">qu'il(elle) est INAPTE à subir l'épreuve pratique d'Education Physique et Sportive</div><br><br>
					<div>
						Fait le ____________________________ <br><br> Fait à _____________________________							
					</div><br>
				</td><?php }} ?>
			</tr>
		</table>
	</div>
</div>
