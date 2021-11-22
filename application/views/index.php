<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Accueil-SSA</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/images/logo.png');?>" rel="icon">
  <link href="<?php echo base_url('assets/images/logo.png')?>" rel="apple-touch-icon">
  <?php 
      $this->session->unset_userdata('identifiant');
      $this->session->unset_userdata('mot_de_passe');
      $this->session->unset_userdata('id_membre');
      $this->session->unset_userdata('nom_membre');
      $this->session->unset_userdata('prenom_membre');
      $this->session->unset_userdata('categorie_compte');
  ?>

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">-->

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/aos/aos.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/swiper/swiper-bundle.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/glightbox/css/glightbox.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/vendors/accueil/assets/vendor/bootstrap/css/owl.carousel.min.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url('assets/vendors/accueil/assets/css/style.css');?>" rel="stylesheet">
  <style type="text/css">
    .modal p
    {
        word-wrap: break-word;
        text-align: justify;
        text-indent: 4em;
    }
  </style>
</head>

<body>
  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img  src="<?php echo base_url('assets/images/logo-gauche.png');?>" style="max-height: 70px;" alt="">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#Accueil">Accueil</a></li>
          <li><a class="nav-link scrollto" href="#Propos">A Propos</a></li>
          <li><a class="nav-link scrollto" href="#Articles">Articles</a></li>
          <li><a class="nav-link scrollto" href="#Annonces">Annonces</a></li>
          <li><a class="nav-link scrollto" href="#Temoignages">Témoignages</a></li> 
          <li><a class="nav-link scrollto" href="#counts">Statistiques</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contacts</a></li>         
          <li><a class="getstarted scrollto" href="<?= base_url() ?>index/page_de_connexion" style="background-color: #407d45;">Connexion</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->

  <section id="Accueil" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 d-flex flex-column justify-content-center" >
          <h1 data-aos="fade-up" class="text-center text-success">PLATEFORME DE SUIVI DES AGRICULTEURS</h1>
          <h2 data-aos="fade-up" data-aos-delay="400" class="text-center">Itinéraires Techniques des cultures</h2>
          <br><hr data-aos="fade-up" style="color: #C0C0C0;">
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-8">
              <div data-aos="fade-up" data-aos-delay="600" style="margin-bottom: auto;">
                <div class="text-center text-lg-start">
                  <a href="<?= base_url("Index/forum");?>" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center" style="background-color: #407d45;">
                    <span>Forum</span>&nbsp;
                    <i class="bi bi-chat"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>  
        <div class="col-lg-5 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="<?php echo base_url('assets/images/img3.jpg');?>" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="Propos" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">
          <hr>
          <div class="col-lg-8 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200" >
            <div class="content" style="background-color: white;">
              <h2 class="text-success font-weight-bold">A propos de nous</h2><br>
              <span style="text-align: justify;">
                <p style="text-indent: 4em;word-wrap: break-word;text-align: justify; font-size:1.2em;">L'objectif que nous visons est celui d'accompagner le paysan en lui fournissant les itinéraires techniques des cultures qu'il en envisage cultiver. L’itinéraire technique caractérise les différentes manières de conduire une culture, selon les objectifs que l’on se fixe.</p>
                </span>
                <p style="text-indent: 4em;word-wrap: break-word;text-align: justify; font-size:1.2em;">
                  Cette plateforme est dédiée au suivi des agriculteurs dans leurs projets agricoles.
                </p>

              </div>
            </div>
            <div class="col-lg-4 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
              <img src="<?php echo base_url('assets/images/logo-haut.png');?>" class="img-fluid" alt="" style="width: 98%; height: 90%;">
            </div>

          </div>
        </div>

      </section><!-- End About Section -->



      <section id="Articles" class="testimonials">

        <div class="container aos-init aos-animate" data-aos="fade-up">
          <hr>
          <header class="section-header">
            <p style="color:#0D360C; font-weight: bold;">Nos Articles</p>
          </header>

          <div class="testimonials-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper" id="swiper-wrapper-31026678a36fe592b" aria-live="off" style="transform: translate3d(-4880px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" role="group" aria-label="8 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="4">
                <div class="testimonial-item">
                </div>
              </div>

              <?php
                if($liste_culture->num_rows()>0)
                {
                  $nb_culture=0;
                  foreach ($liste_culture->result() as $row)
                  {
                    if($nb_culture<=4)
                      { 
                        ?>
                          <div class="swiper-slide swiper-slide-duplicate-next" role="group" aria-label="4 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="<?=$nb_culture;?>">
                            <div class="testimonial-item">
                              <div class="box aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <img src="<?php echo base_url($row->image_culture);?>" class="img-fluid" alt="" style="max-height: 120px;min-height: 120px;">
                                <h3><?=$row->designation_culture;?></h3>
                                <p style="text-overflow: ellipsis; max-height: 150px;min-height: 150px;">
                                  <?php
                                    if($row->definition_culture!="")
                                    {
                                      if(strlen($row->definition_culture)<=250)
                                      {
                                        echo $row->definition_culture;
                                      }
                                      else
                                      {
                                        for ($i=0; $i <250 ; $i++) 
                                        { 
                                          echo $row->definition_culture[$i];
                                        }
                                        while($row->definition_culture[$i]!=" ")
                                        {
                                          echo $row->definition_culture[$i];
                                          $i++;
                                        }
                                        echo "...";
                                      }
                                    }
                                    else
                                    {
                                      echo "Pour plus d'information veuillez-vous connecter à votre compte. <br> Merci de votre aimabilité.";
                                    }
                                  ?>
                                  <hr>
                                  <a data-toggle="modal"  href="" data-target="#cu<?php echo $row->id_culture;?>" class="btn btn-outline-success" style="text-align: right;">
                                    <span >Voir plus</span>
                                    <i class="bi bi-arrow-right"></i>
                                  </a>
                                </p>
                              </div>
                            </div>
                          </div>
                        <?php
                      $nb_culture++;
                    }             
                  }
                }
                else
                {
                  ?>
                    <div class="swiper-slide swiper-slide-duplicate-next" role="group" aria-label="4 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="0">
                      <div class="testimonial-item">
                        <div class="box aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                          <img src="<?php echo base_url('assets/images/logo-haut.png');?>" class="img-fluid" alt="">
                          <h3>SSA</h3>
                          <p>Retrouvez bientôt nos articles.</p>
                        </div>
                      </div>
                    </div>
                  <?php
                }
              ?>

            <div class="swiper-slide swiper-slide-duplicate swiper-slide-next" role="group" aria-label="4 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="0">
                <div class="testimonial-item">
                </div>
              </div></div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span>
              <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 5"></span>
            </div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        </div>

      </section>


    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="Annonces" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">
        <hr>
        <header class="section-header">
          <p style="color:#0D360C; font-weight: bold;">Informations importantes</p>
        </header>
        <div class="row">
          <?php
          if($liste_annonce->num_rows()>0)
          {
            $nb_annonce=1;
            foreach ($liste_annonce->result() as $row)
            {
              $date_annonce= new DateTime($row->date_creation_annonce);
              if($nb_annonce<=8){ ?>
                <div class="col-lg-3">
                  <div class="post-box" style="height: 330px;">
                    <span class="post-title" style="text-align: center; font-size:1.5em; font-weight: bold;font-family: 'Times New Roman';"><?php echo $row->titre_annonce;?><hr></span>
                    <span class="post-date" style="color:#0D360C; font-weight: bold;">Publiée le <?php echo $date_annonce->format('d / m / Y'); ?></span>
                    <div class="row">
                      <span class="post-body" style="max-height: 50px; overflow: hidden;">
                        <?php echo $row->contenu_annonce; ?>
                      </span>
                    </div>
                    <hr>
                    <div class="row">
                      <a data-toggle="modal"  href="" data-target="#ad<?php echo $row->id_annonce;?>" class="stretched-link text-success" style="text-align: right;">
                        <span >Voir plus</span>
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <?php
                $nb_annonce++;
              }             
            }
          }
          else
          {
            ?>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                  <div class="post-box" style="height: 330px;">
                    <span class="post-title" style="text-align: center; font-size:1.5em; font-weight: bold;font-family: 'Times New Roman';">Aucune annonce<hr></span>
                    <div class="row">
                      <span class="post-body">
                        <p  style="text-indent: 4em;word-wrap: break-word;text-align: justify; font-size:1.2em;">Aucune annonce n'est disponible actuellement. Nous vous tiendrons informer de tous changements. <br> Merci de votre aimabilité</p>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4"></div>
            <?php
          }
          ?>

          </div>

        </div>

      </section>


      <section id="Temoignages" class="testimonials">

        <div class="container aos-init aos-animate" data-aos="fade-up">
          <hr>
          <header class="section-header">
            <p style="color:#0D360C; font-weight: bold;">Témoignages</p>
          </header>

          <div class="testimonials-slider swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper" id="swiper-wrapper-31026678a36fe592b" aria-live="off" style="transform: translate3d(-4880px, 0px, 0px); transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" role="group" aria-label="8 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="4">
                <div class="testimonial-item">
                </div>
              </div>

              <?php
                if($liste_temoignage->num_rows()>0)
                {
                  $nb_temoignage=0;
                  foreach ($liste_temoignage->result() as $row)
                  {
                    if($nb_temoignage<=4)
                      { 
                        ?>
                          <div class="swiper-slide" role="group" aria-label="4 / 11" style="width: 516px; margin-right: 40px;" data-swiper-slide-index="<?=$nb_temoignage;?>">
                            <div class="testimonial-item">
                              <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                              </div>
                              <p style="text-overflow: ellipsis; max-height: 150px;min-height: 150px;">
                                  <?php
                                    if(strlen($row->contenu_temoignage)<=200)
                                    {
                                      echo $row->contenu_temoignage;
                                    }
                                    else
                                    {
                                      for ($i=0; $i <200 ; $i++) 
                                      { 
                                        echo $row->contenu_temoignage[$i];
                                      }
                                      while($row->contenu_temoignage[$i]!=" ")
                                      {
                                        echo $row->contenu_temoignage[$i];
                                        $i++;
                                      }
                                      echo "...";
                                    }
                                  ?>
                              </p>
                              <div class="profile mt-auto">
                                <img src="<?php echo base_url($row->photo_membre);?>" class="testimonial-img" alt="">
                                <h3><?=$row->nom_membre." ".$row->prenom_membre[0].".";?></h3>
                              </div>
                            </div>
                          </div>
                        <?php
                      $nb_temoignage++;
                    }             
                  }
                }
                else
                {
                  ?>
                    <div class="swiper-slide swiper-slide-duplicate-next" role="group" aria-label="4 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="0">
                      <div class="testimonial-item">
                        <div class="box aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                          <img src="<?php echo base_url('assets/images/logo-haut.png');?>" class="img-fluid" alt="">
                          <h3>SSA</h3>
                          <p>A bientôt.</p>
                        </div>
                      </div>
                    </div>
                  <?php
                }
              ?>
              <?php 

              ?>

            <div class="swiper-slide swiper-slide-duplicate swiper-slide-next" role="group" aria-label="4 / 11" style="width: 936px; margin-right: 40px;" data-swiper-slide-index="0">
                <div class="testimonial-item">
                </div>
              </div></div>
            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 1"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 3"></span>
              <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span>
              <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 5"></span>
            </div>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

        </div>

      </section>

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
          <hr>
          <header class="section-header">
            <p style="color:#0D360C; font-weight: bold;">Quelques chiffres</p>
          </header>
          <div class="container" data-aos="fade-up">
            <div class="row gy-4">
              <div class="col-lg-3 col-md-6">
                <div class="count-box">
                  <i class="bi bi-people"></i>
                  <div>
                    <span data-purecounter-start="0" data-purecounter-end="<?php if(isset($nb_membre)){echo $nb_membre;} else{ echo "0";}  ?>" data-purecounter-duration="1" class="purecounter text-center"></span>
                    <p style="font-weight: bold;">Membres</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="count-box">
                  <i class="bi bi-flower1" style="color: #407d45;"></i>
                  <div>
                    <span style="color: #407d45;" data-purecounter-start="0" data-purecounter-end="<?php if(isset($nb_culture)){echo $nb_culture;} else{ echo "0";}  ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p style="font-weight: bold;">Itinéraires techniques</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="count-box">
                  <i class="bi bi-menu-button-wide" style="color: #ee6c20;"></i>
                  <div>
                    <span style="color: #ee6c20;" data-purecounter-start="0" data-purecounter-end="<?php if(isset($nb_projet)){echo $nb_projet;} else{ echo "0";}  ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p style="font-weight: bold;">Projets suivis</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <div class="count-box">
                  <i class="bi bi-lightbulb" style="color: #bb0852;"></i>
                  <div>
                    <span style="color: #bb0852;" data-purecounter-start="0" data-purecounter-end="<?php if(isset($nb_astuce)){echo $nb_astuce;} else{ echo "0";}  ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p style="font-weight: bold;">Astuces</p>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section><!-- End Counts Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

          <div class="container" data-aos="fade-up">
            <hr>
            <header class="section-header">
              <p style="color:#0D360C; font-weight: bold;">Contacts</p>
            </header>
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-3">
                    <div class="info-box">
                      <i class="bi bi-geo-alt text-success"></i>
                      <h3 style="font-weight: bold;" class="text-success">Adresse</h3>
                      <p>BP 13904 <br>Yaoundé, Cameroun</p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      <i class="bi bi-telephone text-success"></i>
                      <h3 style="font-weight: bold;" class="text-success">Téléphone</h3>
                      <p>(+237) 6 55 81 19 16</p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      <i class="bi bi-envelope text-success"></i>
                      <h3 style="font-weight: bold;" class="text-success">Email</h3>
                      <p>
                        <a href="mailto:officebaccam@obc.cm?" style="color:black;">
                          fendjilouisebongue@gmail.com
                        </a>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="info-box">
                      <i class="bi bi-clock  text-success"></i>
                      <h3 style="font-weight: bold;" class="text-success">Heures d'ouvertures</h3>
                      <p>Lundi - Vendredi<br>9h:00 - 17h:00</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </section><!-- End Contact Section -->

      </main><!-- End #main -->

      <!-- ======= Footer ======= -->
      <footer id="footer" class="footer">
        <div class="container">
          <div class="copyright" style="color:black;">
            &copy; Copyright <strong><span class="text-success">SSA</span></strong>. All Rights Reserved
          </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="background-color:#0D360C;"><i class="bi bi-arrow-up-short "></i></a>
        <?php
        if($liste_annonce->num_rows()>0)
        {
          $nb_annonce=1;
          foreach ($liste_annonce->result() as $row)
          {
            $date_annonce= new DateTime($row->date_creation_annonce);
            if($nb_annonce<=8){ ?>
              <div class="modal" id="ad<?php echo $row->id_annonce;?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-success" style="text-align: left; font-weight: bold;">
                        <?php echo $row->titre_annonce; ?>
                      </h5>
                      <a type="button" class="close btn btn-danger" data-dismiss="modal" style="color: white;">x</a>
                    </div>
                    <div class="modal-body" style="text-align: justify; font-size: 1.2em; font-family: 'Times New Roman',Arial,serif;">
                      <p>
                        <?php echo $row->contenu_annonce; ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <p>
                        <?php $date_annonce= new DateTime($row->date_creation_annonce); ?>
                        <span style="color:#0D360C; font-weight: bold;">Publiée le <?php echo $date_annonce->format('d / m / Y'); ?></span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $nb_annonce++;
            }             
          }
        }
        ?>
        <?php
        if($liste_culture->num_rows()>0)
        {
          $nb_culture=1;
          foreach ($liste_culture->result() as $row)
          {
            if($nb_culture<=8){ ?>
              <div class="modal" id="cu<?php echo $row->id_culture;?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-success" style="text-align: left; font-weight: bold;">
                        <?php echo $row->designation_culture; ?>
                      </h5>
                      <a type="button" class="close btn btn-danger" data-dismiss="modal" style="color: white;">x</a>
                    </div>
                    <div class="modal-body" style="text-align: justify; font-size: 1.2em; font-family: 'Times New Roman',Arial,serif;">
                      <div class="row">
                        <table class="table table-responsive-xl table-hover dt-responsive table-striped nowrap" style="width: 980%; text-align: justify;font-family:'Times New Roman','Arial',serif; font-size: 1em;" >
                          <tbody>
                            <tr>
                              <td style="width:25%;">
                                <img src="<?php echo base_url($row->image_culture);?>" class="img-fluid img-thumbnail" alt="" style="width: 100%;">
                              </td>
                              <td style="text-indent: 3em;">
                                <?php 
                                  if($row->definition_culture!="")
                                  {
                                    echo $row->definition_culture;                                      
                                  }
                                  else
                                  {
                                    echo "Pour plus d'information veuillez-vous connecter à votre compte. <br> Merci de votre aimabilité.";
                                  }
                                ?>                                
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              $nb_culture++;
            }             
          }
        }
        ?>

        <!-- Vendor JS Files -->

        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/bootstrap/js/owl.carousel.min.js');?>"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
          });
        </script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/js/jQuery.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/bootstrap/js/bootstrap.bundle.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/aos/aos.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/swiper/swiper-bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/purecounter/purecounter.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/isotope-layout/isotope.pkgd.min.js');?>"></script>
        <script src="<?php echo base_url('assets/vendors/accueil/assets/vendor/glightbox/js/glightbox.min.js');?>"></script>

        <!-- Template Main JS File -->
        <script src="<?php echo base_url('assets/vendors/accueil/assets/js/main.js');?>"></script>
        <script src="<?php echo base_url("assets/vendors/bootstrap-4.1/bootstrap.min.js");?>"></script>
      </body>

      </html>
