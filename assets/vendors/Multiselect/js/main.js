$(function() {

	$('select[multiple].active.3col').multiselect({
	  columns: 2,
	  placeholder: 'Selectionnez les destinataires',
	  search: true,
	  searchOptions: {
	      'default': 'Rechercher'
	  },
	  selectAll: true
	});

});