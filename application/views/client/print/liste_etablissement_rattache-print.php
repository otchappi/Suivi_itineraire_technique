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
		Etablissement : <?php echo $this->session->userdata("nom_etablissement");?>
	</div><br/><br/>
	<legend style="text-align: center;">Liste des Etablissements rattachés</legend>
	<div class="tab_cand">
		<table style="width: 100%;">
			<tr>
				<th>N°</th>
				<th>Code</th>
				<th>Responsable</th>
				<th>Désignation</th>
				<th>Télephone</th>
				<th>Email</th>
				<th>Adresse</th>
			</tr>
			<?php if(isset($liste_etablissement))
			{
				$i=1;
				foreach ($liste_etablissement->result() as $row) 
					{?>
						<tr>
							<td><?php echo $i ;?></td>
							<td><?php echo $row->code_etablissement;?></td>
							<td><?php echo $row->responsable_etablissement;?></td>
							<td><?php echo $row->nom_etablissement;?></td>
							<td><?php echo $row->telephone_etablissement;?></td>
							<td><?php echo $row->email_etablissement;?></td>
							<td><?php echo $row->adresse_etablissement;?></td>			
						</tr>
						<?php
						$i++;
					}
				if($i==1)
				{
					?>
						<tr>
							<td colspan="7">Aucun établissement rattaché</td>			
						</tr>
					<?php
				}
			}

				?>
		</table>
	</div>
</div>