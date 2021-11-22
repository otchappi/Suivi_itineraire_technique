  jQuery(function(){
      jQuery('#step_two').hide();
      jQuery('#step_three').hide();
      jQuery('#step_four').hide();
      jQuery('#nbre_doc_exam').val('false');
      jQuery('.btn-next-step-two').click(function(event){
          jQuery('#step_one').hide();
          jQuery('#step_two').show();
          jQuery('#step_three').hide();
          jQuery('#step_four').hide();  

      });
      jQuery('.btn-next-step-three').click(function(){
          jQuery('#step_one').hide();
          jQuery('#step_two').hide();
          jQuery('#step_three').show();
          jQuery('#step_four').hide();
      });
      /**
       * Affichage des  document disponible selon l'examen
       */
      
      jQuery('.btn-next-step-four').click(function(){
          jQuery('#step_one').hide();
          jQuery('#step_two').hide();
          jQuery('#step_three').hide();
          jQuery('#step_four').show();
      });
      jQuery('.payer').click(function(){
            jQuery('.code-validation').show();
      });
      /**
       * Evenement pour  aller au formulaire précédent
       */
      jQuery('.btn-prev-step-one').click(function(){
          jQuery('#step_one').show();
          jQuery('#step_two').hide();
          jQuery('#step_three').hide();
          jQuery('#step_four').hide();
      });
      jQuery('.btn-prev-step-two').click(function(){
          jQuery('#step_one').hide();
          jQuery('#step_two').show();
          jQuery('#step_three').hide();
          jQuery('#step_four').hide();

           
      });
      jQuery('.btn-prev-step-three').click(function(){
          jQuery('#step_one').hide();
          jQuery('#step_two').hide();
          jQuery('#step_three').show();
          jQuery('#step_four').hide();
      });
      /**
       *Enregistrement des information de la candidature register-save
       */
       jQuery('#addFormRegistration').submit(function(event){
          event.preventDefault();
          jQuery('.save').attr('disabled','disabled')
              jQuery.ajax({
                  url: jQuery(this).attr('action'),
                  method: "POST",
                  data : new FormData(this),
                  dataType:"json",
                  contentType: false,
                  cache: false,
                  processData: false,          
                  success: function(data)
                  {
                      jQuery('.save').removeAttr('disabled');
                      swal('Success','enregistrement effectué','success');
                          window.setTimeout(function(){
                              location.reload();
                          }, 3000);
                  },
                  error: function(data)
                  {
                      jQuery('.save').removeAttr('disabled');
                      alert('error'+data);

                      jQuery('.save').removeAttr('disabled');
                      swal('Success','enregistrement effectué','success');
                          window.setTimeout(function(){
                              location.reload();
                          }, 3000);
                  }
              }); 
                
       });
       jQuery('#addFomDocument').submit(function(event){
          event.preventDefault();
          jQuery('.save').attr('disabled','disabled')
              jQuery.ajax({
                  url: jQuery(this).attr('action'),
                  method: "POST",
                  data : new FormData(this),
                  dataType:"json",
                  contentType: false,
                  cache: false,
                  processData: false,          
                  success: function(data)
                  {
                      jQuery('.save').removeAttr('disabled');
                      swal('Success','enregistrement effectué','success');
                      window.setTimeout(function(){
                              location.reload();
                          }, 3000);
                  },
                  error: function(data)
                  {
                      jQuery('.save').removeAttr('disabled');
                      alert('error'+data);

                    
                  }
              }); 
                
       });
       jQuery('#examen').change(function(){
          jQuery('#nbre_doc_exam').val('false');
          var id = jQuery('#examen').val();
          
          if( id=="")
          {
            alert('champs  examen obligatoire');
          }
          else
          {
              jQuery.ajax({
                  url: jQuery('#retrieve_examen').attr('action')+id,
                  type: "get",
                  dataType:"json",                
                  success: function(data)
                  {
                    console.log(data);
                     jQuery('#containDocument').html(data.documents);
                     jQuery('#nbreDocument').val(data.count);
                                  
                       
                  },
                  error: function()
                  {
                    console.log(data);
                    alert('error' );
                  }
              });
          }

       });

       /**
        * Dropdown  option
        */
        jQuery('#region').change(function(){
          var id = jQuery(this).val();
           
           var chemin= jQuery('#centresExamen').attr('action')+id;
            var rou = chemin.split(" ");
            var lien = rou[0]+rou[1];
          if( id=="")
          {
            alert('champs  rergion obligatoire');
          }
          else
          {
            jQuery.ajax({
                url: lien,
                type: "get", 
                dataType:"json",                              
                success: function(data)
                {
                  console.log(data);
                 // alert(data);
                   jQuery('#centreEx').html(data);
                     
                },
                error: function(data)
                {
                  console.log(data);
                    
                }
            });
          }
          
       });

       jQuery('#centreEx').change(function(){

        var id = jQuery(this).val();
        var chemin= jQuery('#etabliss').attr('action')+id;
            var rou = chemin.split(" ");
            var lien = rou[0];
            //alert(lien);
          if( id=="")
          {
            alert('champs  centre examen obligatoire');
          }
          else
          {
             jQuery.ajax({
                  url: lien,
                  type: "get",
                  dataType:"json",                
                  success: function(data)
                  {
                      console.log(data);
                     // alert(data);
                     jQuery('#etablissement').html(data.etablissement);
                     jQuery('#epreuve').html(data.epreuve);
                       
                  },
                  error: function()
                  {
                      alert('error' );
                  }
              });
          }
       
     });




       /**
        * 
        * Suppresion d'un document
        */

        jQuery(".remove_doc").click(function(){
          var id = jQuery(this).parents("tr").attr("id");
    
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
              jQuery.ajax({
               url: jQuery('#delete_document').attr('action')+id,
               type: 'get',
               error: function() {
                alert('Une erreur s\'est produite');
              },
              success: function(data) {
                console.log(data);
                jQuery("#"+id).remove();
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
    
  });