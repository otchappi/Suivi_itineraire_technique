<?php
	if(isset($identite_vue))
	{
		echo $identite_vue;
	}
?>
<style type="text/css">
	#content .tab_cand table td
	{
		border-bottom: 1px solid gray;
		padding-bottom: 5px;
		font-family: 'Times New Roman',serif;
	}
	.tab_cand table th
	{
		border: 1px solid white;
		padding: 8px;
		font-family: 'Times New Roman',serif;
		background-color: #1F8DEF;
		text-align: center;
		color: white;
	}
	.tab_cand table td
	{
		border: 1px solid gray;
		padding: 5px;
		font-family: 'Times New Roman',serif;
		text-align: center;
	}
	.tab_cand table
	{
		border-collapse: collapse;
	}
	#content legend
	{
		border-bottom: 1px solid #1F8DEF;
		padding-bottom: 10px;
		font-family: 'Times New Roman',serif;
		font-size: 1.2em;
		width: 100%;
		margin-bottom: 5px;
	}
</style>
<div style="margin-top: 20px;margin-bottom: 10px;" id="content">
	<br/>
	<div style="text-align: center; font-family: 'Times New Roman',serif; font-size: 1.2em;font-weight: bold; border:1px solid #1F8DEF;border-radius: 2px;margin: auto; width: 80%; padding:10px; text-transform: uppercase;  ">
		Etablissement : <?php if($this->session->userdata('nom_etab_cand')!=""){ echo $this->session->userdata('nom_etab_cand');}else{echo $this->session->userdata("nom_etablissement");} ?>
	</div><br/><br/>
	<legend style="text-align: center;">Liste des Candidatures enregistrées</legend>
	<div class="tab_cand">
		<table style="width: 100%;">
			<tr>
				<th>N°</th>
				<th>Matricule</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Sexe</th>
				<th>Serie</th>
				<th>Type</th>
				<th>Etat</th>
			</tr>
			<?php if(isset($liste_candidature))
			{
				$i=1;
				foreach ($liste_candidature->result() as $row) 
					{?>
						<tr>
							<td><?php echo $i ;?></td>
							<td><?php echo $row->matricule_candidat;?></td>
							<td><?php echo $row->nom_candidat;?></td>
							<td><?php echo $row->prenom_candidat;?></td>
							<td><?php echo $row->sexe;?></td>
							<td><?php echo $row->libelle_serie;?></td>
							<td><?php echo $row->libelle_type_candidat;?></td>
							<td>
								<?php 
								switch($row->statut_dossier)
								{
									case 0:
									echo "<span class='text-primary'>Nouvelle</span>";
									break;
									case 1:
									case 4:
									echo "<span class='text-success'>Validée</span>";
									break;
									case 2:
									case 5:
									echo "<span class='text-warning'>Incomplète</span>";
									break;
									case 3:
									echo "<span class='text-danger'>Refusée</span>";
									break;
								}
								?>								
							</td>			
						</tr>
						<?php
						$i++;
					}
				if($i==1)
				{
					?>
						<tr>
							<td colspan="8">Aucune candidature enregistrée</td>			
						</tr>
					<?php
				}
			}

				?>
		</table>
	</div>
</div>