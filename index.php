<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="RESSOURCES/css/index.css">
    <link rel="stylesheet" href="VENDORS/css/swiper-bundle.css" />
    <link rel="stylesheet" href="VENDORS/css/swiper-bundle.min.css" />
    <script src="RESSOURCES/js/jQuery 3.6.0.js"></script>
    <title>Site d'apprentissage</title>
</head>

<body>

    <?php
    session_start();
    include("navbar.php");
    ?>

    <header>
        <div class="hero_text">
            <h4>
                Commencer à apprendre, Partout ou vous etes !
            </h4>
            <p>Développez vos compétences grâce à des cours, des certificats et
                des diplômes en ligne proposés par les meilleures enseignants !</p><br>




        </div>
        <div class="hero_img">
            <img src="RESSOURCES/css/img/hero img.png" alt="">
        </div>
    </header>

    <!-------------------------------------------------------------------------------------------->
    <!----------------------------------ABOUT------------------------------------------------------>
    <!-------------------------------------------------------------------------------------------->

    <section class="about">
        <h2>Ce que nous offrons...</h2>
        <div class="three_descriptions">
            <div class="description">
                <img src="RESSOURCES/css/img/desc 1.svg" alt="">
                <p>Créer un compte personnel<br>
                    Choisissez vos cours<br>
                    Suivez votre progrés</p>
            </div>
            <div class="description">
                <img src="RESSOURCES/css/img/desc 2.svg" alt="">
                <p>Publier des cours<br>
                    Gain a following<br>
                    Get paid</p>
            </div>
            <div class="description">
                <img src="RESSOURCES/css/img/desc 3.svg" alt="">
                <p>Obtenir une attestation<br>
                    Approuver par votre<br>
                    Enseignant </p>
            </div>
        </div>
    </section>
    <!-------------------------------------------------------------------------------------------->
    <!----------------------------------CATEGORIES------------------------------------------------------>
    <!-------------------------------------------------------------------------------------------->
    <section class="section-meals">
        <h2>Categories</h2>

        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#">
                        <img src="RESSOURCES/css/img/electonics.jpg" alt="">
                        <a href="#">electronique</a>
                    </a>
                </div>

                ...
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>


        </div>
    </section>

    <!-------------------------------------------------------------------------------------------->
    <!----------------------------------TEMOINGNAGES------------------------------------------------------>
    <!-------------------------------------------------------------------------------------------->

    <section class="temoignages">
        <h2>NE NOUS ECOUTEZ PAS, ECOUTEZ NOS UTILISATEURS</h2>

        <div class="container">
            <div class="item item-l">
                <img src="RESSOURCES/css/img/temoin-l.jpg" alt="">
                <div class="temoingnage_text">
                    <blockquote>
                        <h3>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Obcaecati voluptatibus voluptas eligendi at
                            illo earum non. Quo aperiam facere officiis.</h3>
                    </blockquote>
                    <div>
                        <h5>Harriet Mitchell</h5>
                        <h6>Web Designer</h6>
                    </div>
                </div>
            </div>
            <div class="item item-m">
                <img src="RESSOURCES/css/img/temoin-m.jpg" alt="">
                <div class="temoingnage_text">
                    <blockquote>
                        <h3>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Obcaecati voluptatibus voluptas eligendi at
                            illo earum non. Quo aperiam facere officiis.</h3>
                    </blockquote>
                    <div>
                        <h5>Harriet Mitchell</h5>
                        <h6>Web Designer</h6>
                    </div>
                </div>
            </div>
            <div class="item item-r">
                <img src="RESSOURCES/css/img/temoin-r.jpg" alt="">
                <div class="temoingnage_text">
                    <blockquote>
                        <h3>Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Obcaecati voluptatibus voluptas eligendi at
                            illo earum non. Quo aperiam facere officiis.</h3>
                    </blockquote>
                    <div>
                        <h5>Harriet Mitchell</h5>
                        <h6>Web Designer</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>
    <!---------------------------------------------------------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------------------------------------------------------->
    <!---------------------------------------------------------------------------------------------------------------------------------------->
</body>
<script src="VENDORS/js/swiper-bundle.js"></script>
<script src="VENDORS/js/swiper-bundle.min.js"></script>
<script src="RESSOURCES/js/script.js"></script>

</html>