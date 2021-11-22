<title><?php echo $titre_page. ' - '.  'SSA'?> </title>
<script src="<?php echo base_url("assets/vendors/sweet-alert/js/sweetalert.js"); ?>"></script>
<?php
    if($this->session->userdata('operation')!='')
    {
        if($this->session->userdata('operation'))
        {?>
            <script type="text/javascript">
                alert('Message envoyé avec succès !');
            </script><?php
        }
        $this->session->unset_userdata('operation');
    }
?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="<?php echo base_url("assets/vendors/messagerie/jquery-1.10.2.min.js");?>"></script>
	<script src="<?php echo base_url("assets/vendors/messagerie/bootstrap.min.js");?>"></script>
<?php
        if(isset($infos_admin))
        {
            foreach ($infos_admin->result() as $row) 
            {
                $id_admin=$row->login;
                $this->session->set_userdata("admin",$id_admin);            
            }
        }
?>

<script src="<?php echo base_url("assets/vendors/messagerie/jquery.nicescroll.min.js");?>"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fa fa-envelope-o icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Messagerie 
                        <div class="page-title-subheading">
                        </div>
                    </div>
                </div>
                <div class="page-title-actions" id="arborescence">
                    <a href="<?php  echo base_url('Message/index_client');?>">Messagerie &nbsp</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10 col-xs-12 chat" >
              <div class="col-inside-lg decor-default">
                <h6>Conversation</h6><hr>
                <div class="chat-body" style="overflow: hidden; outline: none;" tabindex="5001">
                    <?php
                        if(isset($liste_message))
                        {
                            foreach ($liste_message as $row) 
                            {
                                $date_message= new DateTime($row->date_creation_message);
                                ?>
                                    <div class="<?php if($row->emeteur_message==$id_admin){ echo "answer left";} else{ echo "answer right";} ?>" >
                                        <div class="avatar">
                                            <img src="<?php if($row->emeteur_message==$id_admin){ echo base_url("assets/images/admin_avatar.jpg");} else{ echo base_url($this->session->userdata('photo_membre'));} ?>" alt="Avatar">
                                        </div>
                                        <div class="name"><strong><?= $row->objet_message;?></strong></div>
                                        <div class="text"><?= $row->contenu_message;?>
                                        </div>
                                        <div class="time">
                                            <?php echo $date_message->format('d / m / Y à H : i : s'); ?><?php if($row->emeteur_message!=$id_admin){ echo "&nbsp; <a class='supprimer_message' id='".$row->id_message."'><span class='text-danger fa fa-trash'></span></a>";} ?>
                                            
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
                <div class="answer-add">
                    <form method="post" action="<?php echo site_url('Message/envoyer_message'); ?>">
                        <div class="row">
                            <div class="col-xl-11">
                                <input placeholder="Objet du message" id="objet" type="text" name="objet" class="form-control" maxlength="200"/>
                            </div>
                            <div class="col-xl-1">
                                <button class="btn-transition btn btn-outline-light" type="submit">
                                    <span class="fa fa-paper-plane-o" style="font-size:1.5em;"></span>
                                </button>
                            </div>
                        </div><hr>
                        <div class="row">
                            <div class="col-xl-12">
                                <textarea rows="2" class="form-control" placeholder="Nouveau message" name="contenu" maxlength="750" required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <hr>
        <br>
    </div>
 </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $(document).on('click','.supprimer_message',function(){ 
            var id = $(this).attr("id");
            swal({
              title: "Etes-vous sûr de vouloir supprimer ce message ?",
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
                        url: "<?php  echo base_url('Message/supprimer_message/');?>"+id,
                        type: 'POST',
                        error: function() {
                            alert('Une erreur s\'est produite');
                        },
                        success: function(data) {
                            swal({
                                title: "Supprimé!",
                                text: "Opération effectuée avec succès",
                                type: "success"
                            });
                            window.setTimeout(function(){
                              location.reload();
                            }, 2000);
                        }   
                    });
                } 
                else
                {
                    swal("Annulé", "La suppression a été annulée", "error");
                }
            });

        });
    });
</script>
<style type="text/css">
.row.row-broken {
    padding-bottom: 0;
}
.col-inside-lg {
    padding: 20px;
}
.chat-body {
    height: calc(60vh - 85px);
}
.decor-default {
    background-color: #ffffff;
}

/*****************CHAT BODY *******************/
.chat h6 {
    font-size: 1.5em;
    margin: 0 0 20px;
    font-weight: bold;
}
.chat-body .answer.left {
    padding: 0 0 0 58px;
    text-align: left;
    float: left;
}
.chat-body .answer {
    position: relative;
    max-width: 600px;
    overflow: hidden;
    clear: both;
}
.chat-body .answer.left .avatar {
    left: 0;
}
.chat-body .answer .avatar {
    bottom: 36px;
}
.chat .avatar {
    width: 40px;
    height: 40px;
    position: absolute;
}
.chat .avatar img {
    display: block;
    border-radius: 20px;
    height: 100%;
}
.chat-body .answer .name {
    font-size: 14px;
    line-height: 36px;
}
.chat-body .answer.left .avatar .status {
    right: 4px;
}
.chat-body .answer .avatar .status {
    bottom: 0;
}
.chat-body .answer.left .text {
    background: #ebebeb;
    color: #333333;
    border-radius: 8px 8px 8px 0;
}
.chat-body .answer .text {
    padding: 12px;
    font-size: 16px;
    line-height: 26px;
    position: relative;
}
.chat-body .answer.left .text:before {
    left: -30px;
    border-right-color: #ebebeb;
    border-right-width: 12px;
}
.chat-body .answer .text:before {
    content: '';
    display: block;
    position: absolute;
    bottom: 0;
    border: 18px solid transparent;
    border-bottom-width: 0;
}
.chat-body .answer.left .time {
    padding-left: 12px;
    color: #333333;
}
.chat-body .answer .time {
    font-size: 16px;
    line-height: 36px;
    position: relative;
    padding-bottom: 1px;
}
/*RIGHT*/
.chat-body .answer.right {
    padding: 0 58px 0 0;
    text-align: right;
    float: right;
}

.chat-body .answer.right .avatar {
    right: 0;
}
.chat-body .answer.right .avatar .status {
    left: 4px;
}
.chat-body .answer.right .text {
    background: #69AAE3;
    color: #ffffff;
    border-radius: 8px 8px 0 8px;
}
.chat-body .answer.right .text:before {
    right: -30px;
    border-left-color: #69AAE3;
    border-left-width: 12px;
}
.chat-body .answer.right .time {
    padding-right: 12px;
    color: #333333;
}

/**************ADD FORM ***************/
.answer-add {
    clear: both;
    position: relative;
    margin: 20px -20px -20px;
    padding: 20px;
    background: #46be8a;
}
.chat input {
    -webkit-appearance: none;
    border-radius: 0;
}
</style>

<script type="text/javascript">
$(function(){
    $(".chat-body").niceScroll();
})
</script>