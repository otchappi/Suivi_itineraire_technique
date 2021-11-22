
<!--<div class="modal fade show" id="Changer_session" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true" aria-modal="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="metismenu-icon fa fa-calendar"></i>&nbsp Changer de Session</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" style="color: red;">×</span>
				</button>
			</div>
			<div class="modal-body" style="overflow: auto; max-height: 440px;">
				<table class="mb-0 table table-hover text-center table table-bordered">
					<thead>
						<tr>
							<th scope="row">Session</th>
							<td class="text-uppercase font-weight-bold ">Action</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(isset($liste_session))
							{
								foreach ($liste_session->result()  as $row) 
								{
									?>
										<tr>
											<th scope="row"><?php echo $row->libelle_session;?></th>
											<td>
												<?php
													if($row->id_session==$this->session->userdata('id_session'))
													{
														?>
															<span class="font-weight-bold text-center text-info">
																Session active
															</span>
														<?php
													}
													else
													{
														?>
															<a href="<?= base_url('index/modif_session/'.$row->id_session);$this->session->set_userdata('page',uri_string()); ?>" class="btn-transition btn btn-outline-primary">
																Activer cette session
															</a>
														<?php
													}
												?>
											</td>
										</tr>
									<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn-transition btn btn-outline-danger" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>-->

<!-- plugins:js -->
<script src="<?php echo base_url('assets/js/main.js');?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->


<!-- custom js -->
<script src="<?php echo  js('vendors/select2/select2.min'); ?>" defer>
<script src="<?php echo js('vendors/select2/select2.full') ?>" defer></script>

<!-- datepicker -->
<script src="<?php echo  js('vendors/datetimepicker/jquery.timepicker'); ?>" defer></script>
<script src="<?php echo  js('vendors/datetimepicker/bootstrap-datepicker'); ?>" defer></script>

<!-- fakeloader -->
<script src="<?= js('vendors/transition-pages-fakeloader/src/fakeloader') ?>"></script>

<!-- endinject -->


<script>

	window.FakeLoader.init({
		auto_hide:true,
		fade_timeout: 200,
		overlay_id:'fakeloader-overlay'

	});

	var initdTable=false;

	function initDataTable($element,$page,$button){

		initdTable = true;
		$($element).dataTable({

			pageLength: $page,
			buttons:  [
				'copy', 'excel',{
					extend: 'pdfHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL'
				}, 'colvis'
			],
			columnDefs: [
				{targets: 'hidden-column', visible: false}
			],
			"language": {
				"decimal": ".",
				"thousands": ",",
				'sProcessing': 'Traitement en cours...',
				'sLengthMenu': 'Afficher _MENU_ lignes',
				'sZeroRecords': 'Aucun résultat trouvé',
				'sEmptyTable': 'Aucune donnée disponible',
				'sInfo': 'Affiche de _START_ à _END_ sur _TOTAL_ ligne(s)',
				'sInfoEmpty': 'Aucune ligne affichée',
				'sInfoFiltered': '(Filtre un maximum de _MAX_ lignes)',
				'sInfoPosFix': '',
				'sSearch': 'Chercher : ',
				'sUrl': '',
				'sInfoThousands': ',',
				'sLoadingRecords': 'Chargement...',
				'oPaginate': {
					'sFirst': 'Premier',
					'sLast': 'Dernier',
					'sNext': 'Suivant',
					'sPrevious': 'Précédent'
				},
				'oAria': {
					'aSortAscending': ': Trier par ordre croissant',
					'sSortDescending': ': Trier par ordre décroissant'
				}
			},
			dom: 'Bfrtip',
			drawCallback: function () {
				$('button.buttons-print span').text('Imprimer');
				$('button.buttons-colvis span').text('Colonnes à afficher');
				$('button.buttons-copy span').text('Copier');
				$('.dt-button').addClass('btn btn-secondary dtable-button mb-2');
				$('.dtable-button').removeClass('dt-button');
				$('[data-toggle="popover"]').popover({
					"html": true,
					trigger: 'hover',
					placement: 'left'
				})
				// $(".select2").select2();
				// $(document).on('click', ".btn-history", function(){
				//
				// 	var $this = $(this);
				// 	$type = $this.attr('data-type');
				// 	$tick = $this.attr('data-tick');
				// 	//            console.log($tick);
				//
				// 	$.post("/index.php/settings/getTransaction",{tick:$tick},function(data){
				// 		$('#info_t'+$tick).html(data);
				// 	});
				// });
				$('button.buttons-colvis').on('click', function(){
					console.log('Clicked on button.buttons-colvis');
					$('.dt-button').addClass('btn btn-secondary dtable-button mb-2');
					$('.dtable-button').removeClass('dt-button');
				});
			}
		});
	}
	$(document).ready(function() {
		if (initdTable === false)
			initDataTable($('#dataTable'), 25, ['pdf', 'excel']);

	});
</script>
</body>

</html>
