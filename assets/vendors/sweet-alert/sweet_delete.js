/*               SWEET ALERT SUPPRESSION DANS LE BLOG
*/

$(".supprimer_compte").click(function(){
  var id = $(this).attr("id");

  swal({
    title: "Etes-vous sûr de vouloir supprimer ce compte?",
    text: "Cette action est irréversible!",
    type: "warning",
    showCancelButton: true,
    cancelButtonClass: "btn-danger",
    confirmButtonClass: "btn-warning",
    confirmButtonText: "Oui, supprimer!",
    cancelButtonText: "Non, Annuler!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
       url: "<?php  echo site_url('Gestion_compte/supprimer_compte/');?>"+id,
       type: 'get',
       error: function() {
        alert('Une erreur s\'est produite');
      },
      success: function(data) {
        dataTable.ajax.reload();
        swal({
          title: "Supprimé!",
          text: "Le compte a été supprimé",
          type: "success"
        });
       window.setTimeout(function(){
          location.reload();
        }, 3000)

      }
    });
    } else {
      swal("Annulé", "Suppression annulée", "error");
    }
  });

});

$(".delete_article").click(function(){
  var id = $(this).parents("tr").attr("id");

  swal({
    title: "Etes vous sûr?",
    text: "Cette action est irréversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Oui, supprimer!",
    cancelButtonText: "Non, Annuler!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
       url: "http://localhost/MyPeople.cm/article/supprimer_article/"+id,
       type: 'get',
       error: function() {
        alert('Une erreur s\'est produite');
      },
      success: function(data) {
        console.log(data);
        $("#"+id).remove();
        swal({
          title: "Supprimé!",
          text: "Votre élément a été supprimé",
          type: "success"
        });
       window.setTimeout(function(){
          location.reload();
        }, 3000)

      }
    });
    } else {
      swal("Annulé", "Suppression annulée", "error");
    }
  });

});

$(".delete_compte_active").click(function(){
  var id = $(this).parents("tr").attr("id");

  swal({
    title: "Etes vous sûr?",
    text: "Cette action est irréversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Oui, supprimer!",
    cancelButtonText: "Non, Annuler!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
       url: "http://localhost/MyPeople.cm/compte/suppression/"+id,
       type: 'get',
       error: function() {
        alert('Une erreur s\'est produite');
      },
      success: function(data) {
        console.log(data);
        $("#"+id).remove();
        swal({
          title: "Supprimé!",
          text: "Votre élément a été supprimé",
          type: "success"
        });
       window.setTimeout(function(){
          location.reload();
        }, 3000)

      }
    });
    } else {
      swal("Annulé", "Suppression annulée", "error");
    }
  });

});

$(".delete_compte_non_active").click(function(){
  var id = $(this).parents("tr").attr("id");

  swal({
    title: "Etes vous sûr?",
    text: "Cette action est irréversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Oui, supprimer!",
    cancelButtonText: "Non, Annuler!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
       url: "http://localhost/MyPeople.cm/compte/suppression/"+id,
       type: 'get',
       error: function() {
        alert('Une erreur s\'est produite');
      },
      success: function(data) {
        console.log(data);
        $("#"+id).remove();
        swal({
          title: "Supprimé!",
          text: "Votre élément a été supprimé",
          type: "success"
        });
       window.setTimeout(function(){
          location.reload();
        }, 3000)

      }
    });
    } else {
      swal("Annulé", "Suppression annulée", "error");
    }
  });

});

$(".delete_etudiant").click(function(){
  var id = $(this).parents("tr").attr("id");

  swal({
    title: "Etes vous sûr?",
    text: "Cette action est irréversible!",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Oui, supprimer!",
    cancelButtonText: "Non, Annuler!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      $.ajax({
       url: "http://localhost/MyPeople.cm/etudiant/suppression/"+id,
       type: 'get',
       error: function() {
        alert('Une erreur s\'est produite');
      },
      success: function(data) {
        console.log(data);
        $("#"+id).remove();
        swal({
          title: "Supprimé!",
          text: "Votre élément a été supprimé",
          type: "success"
        });
       window.setTimeout(function(){
          location.reload();
        }, 3000)

      }
    });
    } else {
      swal("Annulé", "Suppression annulée", "error");
    }
  });

});

