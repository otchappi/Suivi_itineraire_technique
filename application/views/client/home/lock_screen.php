<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Mise en veille</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/vendors/lock_screen/bootstrap/css/bootstrap.css");?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="<?php echo base_url("assets/vendors/lock_screen/javascript/jquery.js");?>"></script>
  <script src="<?php echo base_url("assets/vendors/lock_screen/bootstrap/js/jQuery.js");?>"></script>
  <script src="<?php echo base_url("assets/vendors/lock_screen/bootstrap/js/bootstrap.min.js");?>"></script>
     <!-- pour IE : -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <!-- pour les mobiles : -->    
  <meta name="viewport" content="width=device-width, initialscale=1"> 
  <style type="text/css">
    #mon_heure {
      width: 100%;
      color: #fff;
      font-size: 60px;
      margin-bottom: 30px;
      margin-top: 250px;
      display: inline-block;
      text-align: center;
      font-weight: bold;
      font-family: "Times New Roman","Arial",serif;
    }

    .lock-screen {
      text-align: center;
    }

    .lock-screen a {
      color: white;
    }

    .lock-screen a:hover {
      color: #1F8DEF;
    }

    .lock-screen span {
      font-size: 40px;
    }
    .lock-screen p {
      font-size: 20px;
      text-align: center;
      font-weight: bold;
      font-family: "Times New Roman","Arial",serif;
    }

    .lock-screen .modal-content {
      position: relative;
     /* background-color: #f2f2f2;*/
      background-clip: padding-box;
      border: 1px solid #999;
      border: 1px solid rgba(0, 0, 0, .2);
      border-radius: 5px;
    }
    body
    {
        background: url(<?php echo base_url('assets/images/veille.jpg');?>) repeat;
    }

  </style>
</head>
<?php
  if($infos_connecte->num_rows()>0)
  {
    foreach ($infos_connecte->result() as $row) 
    {
      $photo=$row->photo_membre;
      $nom=$row->nom_membre;
    }
  }
?>
<body>
  <div class="container" onload="getTime()" >
    <div id="mon_heure"></div>
    <div class="col-lg-4 col-lg-offset-4">
      <div class="lock-screen">
        <h1>
          <a data-toggle="modal" href="#infos">
            <span class="glyphicon glyphicon-lock">    
            </span>
          </a>
        </h1>
        <p style="color: white; font-size: 1.6em;font-weight: bold;" class="text-light text-center font-weight-bold">Votre session est en Veille<br><?=$nom;?></p>
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="infos" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-success" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:red;">&times;</button>
                <h4 class="modal-title" style="text-align: center; font-weight: bold;">Dévérrouiller votre session</h4>
              </div>
              <form method="post" action="<?php echo base_url('Index/deverrouiller_session'); ?>">
                <div class="modal-body" style="font-size: 1.2em;font-family: 'Times New Roman',Arial,serif;">
                  <p class="centered">
                      <img src="<?php echo base_url('assets/images/logo-gauche.png');?>" alt="SSA" style="max-height: 120px;width: 100%;">
                  </p>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="modal-footer centered">
                  <button data-dismiss="modal" class="btn btn-danger" type="button">Annuler</button>
                  <button class="btn btn-success" type="submit">Valider</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
   function getTime()
    {
      var date= new Date();
      var heure=date.getHours();
      var minutes=date.getMinutes();
      var secondes=date.getSeconds();
      heure=((heure<10)?"0":"")+heure;
      minutes=((minutes<10)?" : 0":" : ")+minutes;
      secondes=((secondes<10)?" : 0":" : ")+secondes;
      var mon_heure=document.getElementById("mon_heure");
      mon_heure.textContent=heure+minutes+secondes;
      setTimeout("getTime()",1000);
    }
    getTime();
  </script>
</body>

</html>
