<title><?php echo $titre_page. ' - '.  'SSA'?> </title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/full_calendar/main.css");?>"> 
<script src="<?php echo base_url("assets/vendors/full_calendar/main.js");?>"></script>


<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="fa fa-calendar icon-gradient bg-mean-fruit">
						</i>
					</div>
					<div>Agenda
						<div class="page-title-subheading">
							
						</div>
					</div>
				</div>
				<div class="page-title-actions" id="arborescence">
					<a href="<?php  echo base_url('Profile/agenda');?>" class="text-success">Agenda &nbsp</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="main-card card">
					<div class="card-body"><br/>
						<div class="row">
							<div style="margin-left: 5%;margin-right: 5%;margin-bottom: 30px; width: 100%;">
								<div id="calendar1"></div>
							</div>
						</div>
					</div>
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
<script type="text/javascript">
	$(document).ready(function(){
		var calendarE=document.getElementById('calendar1');
		var calendar = new FullCalendar.Calendar(calendarE, {
	      expandRows: true,
	      slotMinTime: '08:00',
	      slotMaxTime: '20:00',
	      headerToolbar: {
	        left: 'prev,next today',
	        center: 'title',
	        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
	      },
	      initialView: 'dayGridMonth',
	      initialDate: new Date(),
	      navLinks: true, 
	      selectable: true,
	      nowIndicator: true,
	      dayMaxEvents: true,
	      events: [
	    <?php
	    	if(isset($liste_tache))
	    	{
	    		$nb_row=$liste_tache->num_rows();
	    		$i=0;
	    		$couleur=array();	    		
	    		$couleur[0]="#3D532D";$couleur[1]="#63522D";$couleur[2]="#2B4C5B";$couleur[3]="#5B2B4A";$couleur[4]="#C86B07";
	    		foreach ($liste_tache->result() as $row) 
	    		{
	    			$i+=1;
	    			if($i!=$nb_row)
	    			{
	    				echo "{";
		    			echo 'title: "'.$row->intitule_tache.'",';
		    			echo "start: '".$row->date_debut_tache."',";
		    			echo "end: '".date('Y-m-d',strtotime($row->date_echeance_tache.'+1 days'))."',";
		    			echo "backgroundColor: '".$couleur[rand(0,4)]."'";
		    			echo "},";
	    			}
	    			else
	    			{
	    				echo "{";
		    			echo 'title: "'. $row->intitule_tache.'",';
		    			echo "start: '". $row->date_debut_tache."',";
		    			echo "end: '".date('Y-m-d',strtotime($row->date_echeance_tache.'+1 days'))."',";
		    			echo "backgroundColor: '".$couleur[rand(0,4)]."'";
		    			echo "}";
	    			}
	    		}
	    	}
	    ?>
	      ]
	    });
			calendar.render();
	});
</script>
