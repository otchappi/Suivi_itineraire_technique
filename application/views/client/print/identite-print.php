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
<style>
	@page
	{
		margin-top: 170px 50px;
		margin-bottom: 110px 50px;
	}
	#footer
	{
		position: fixed;
		bottom: -50px;
		left:0px;
		right: 0px;
		height: 50px;
	} 
	#header
	{
		position: fixed;
		top: -180px;
		left:0px;
		right: 0px;
		height: 180px;
	}
	#footer .page:before
	{
		content: counter(page);
	}
</style>
<div style="border-bottom:1px black solid;" id="header" >
	<br><br>
	<table style="width: 100%;">
		<tr>
			<td colspan="3">
				<div style="text-align: center; font-family: 'Comic Sans MS',Impact,'Times New Roman',serif; font-size: 1.5em;font-weight: bold;color:#1F8DEF;">
					<?php if(isset($nom_identite)){echo $nom_identite;} ?>					
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
	</table>	
</div>
<div style="border-top:2px black solid;" id="footer">
	<div class="page">
		<!--<table style="width: 100%;">
			<tr>
				<td><div style="text-align: center;margin: 0;padding: 0;"><?php if(isset($localisation)){echo $localisation;} ?></div></td>
			</tr>
		</table>-->
	</div>	
</div>