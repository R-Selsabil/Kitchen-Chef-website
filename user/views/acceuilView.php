<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './user/controller/userController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . './user/controller/affichController.php');
class userView
{
    public function header()
    {
?>

        <head>
            <meta charset="UTF-8">
            <!-- No need for X-UA-Compatible since last version of edge don't require it -->
            <title>Cuisine Chef</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="keywords" content="recipe, cuisine, ingredients, healthy,food" />
            <!-- Latest compiled and minified CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <!-- Font Awesome Icon Library -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link href="../css/style.css" rel="stylesheet">
            <!-- Custom CSS -->
            <!--     <link href="../css/style.css" rel="stylesheet"> -->

        </head>

        <body>
            <div class="bar" style=" height: 4rem;background-color: transparent ;">
                <div class="logo m-5">
                    <img style="background-color: transparent; 
                     width: 60px; 
                     height: auto; 
                     float: left;
                     margin-left:1%;
                     transform: translateY(10px);" src="../assets/logo.png" alt="Logo">
                    <button class="btn btn-outline-secondary secondary_text" style="float:right;transform: translateY(20px);margin-right:1%">Log In</button>
                </div>
            </div>




        <?php
    }

    public function menu()
    {
        $controller = new userController();
        $categories = $controller->getCategories();
        $i = 0;
        ?>
            <nav class="navbar navbar-expand-md navbar-light m-4">
                <div class="container-xxl">
                    <!--toggle button for mobile nav-->

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="main-nav">
                        <ul class="navbar-nav justify-content-between w-100 m-4" style="background-color: #F6E9DD;">
                            <?php
                            foreach ($categories as $item) {
                                if ($i == 0) {
                            ?>
                                    <li class="topnav nav-item"><a class="nav-link active secondary_text" href="#" style=" border-bottom: 3px solid #990000;">
                                            <?php echo $item['Nom_item_menu'] ?></a></li>
                                <?php
                                } else {
                                ?>
                                    <li class="nav-item secondary_text"><a class="nav-link" href="#"><?php echo $item['Nom_item_menu'] ?></a></li>
                            <?php

                                }
                                $i++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
    }
    public function popular_news()
    {
    }

    public function cardHeader($menu)
    {
        $i = 0;

        ?>
            <div class="  card-header border-0 " style="background-color:white">
                <ul class="  nav card-header-tabs mx-n5" style="margin-left:-0.3%;">
                    <?php
                    foreach ($menu as $item) {
                        if ($i == 0) {
                    ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="#description" style="  border-bottom: 3px solid #990000;">
                                    <?php echo $item['Nom_item_menu'] ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link " href="#description"><?php echo $item['Nom_item_menu'] ?></a>
                            </li>
                    <?php
                        }
                        $i++;
                    }
                    ?>
                </ul>
            </div>
        <?php

    }
    public function card($value)
    {
        ?>
            <div style="max-height:150px">
                <?php echo '<img class="pt-3 img-fluid border-top border-light 
                                    rounded-top" src="../assets/recipes/' . $value['image'] . '"
                                     alt="" style="height=300px;width=auto"> '
                ?>
            </div>

            <div class="card mb-3 border-bottom border-light rounded-end">
                <div class="card-body text-center">
                    <h6 class="card-title" style="display: block;
                                            overflow: hidden;
                                            max-height: 2.6em;
                                            line-height: 1.3em;"><?php echo $value['title'] ?></h6>
                    <h6 class="card-text"><small>By Chef name</small></h6>
                    <div class="border-0 ">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <p class="card-text text-muted d-none d-lg-block d-inline-block " style="display: block;
                                            overflow: hidden;
                                            max-height: 2.6em;
                                            line-height: 1.3em;">
                        <?php echo $value['description'] ?></p>
                    <a href="#" class="btn btn-outline-primary btn-sm text-light  " style="background-color: #990000;">Learn more</a>
                </div>

            </div>
        <?php
    }
    public function recipes_page()
    {
        $controller = new userController();
        $menu = $controller->getMenu();
        $i = 0;
        ?>
            <section id="slider" class="">
                <div class="mx-5 ">
                    <?php $this->cardHeader($menu) ?>
                    <div class=" row align-items-center justify-content-center justify-content-between mb-3" style="margin-right:1%;margin-left:1%;background-color:#F6E9DD">

                        <?php
                        $_controller = new affichController();
                        $popularRecipes = $_controller->getPopoularRecipes();
                        foreach ($popularRecipes as $value) {
                            $this->card_recipes($value);
                        }
                        ?>
                    </div>
            </section>
        <?php
    }
    public function card_recipes($value)
    {
        ?>

            <div class="card">
                <div class="content   text-center">
                    <div class="img">

                        <?php echo '<img src="./assets/recipes/' . $value['image'] . '"
                                     alt="" > '
                        ?>
                    </div>

                    <h6 class="card-title" style="display: block;
                                            overflow: hidden;
                                            max-height: 2.6em;
                                            line-height: 1.3em;"><?php echo $value['title'] ?></h6>
                    <h6 class="card-text"><small>By Chef name</small></h6>
                    <div class="border-0 ">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <p class="card-text text-muted d-none d-lg-block d-inline-block " style="display: block;
                                            overflow: hidden;
                                            max-height: 2.6em;
                                            line-height: 1.3em;">
                        <?php echo $value['description'] ?></p>
                    <a href="#" class="btn btn-outline-primary btn-sm text-light  " style="background-color: #990000;">Learn more</a>

                </div>

            </div>

        <?php
    }
    public function recipes_test()
    {
        $controller = new userController();
        $menu = $controller->getMenu();
        $i = 0;
        ?>
            <div>
                <?php  $this->cardHeader($menu) ?>
            </div>
            <div class="container ">
                <input type="radio" name="dot" id="one">
                <input type="radio" name="dot" id="two">

                <div class="main-card">
                    <div class="cards">

                        <?php
                        $_controller = new affichController();
                        $popularRecipes = $_controller->getPopoularRecipes();
                        foreach ($popularRecipes as $value) {

                            $this->card_recipes($value);
                        }
                        ?>
                    </div>
                </div>
                <div class="button">
                    <label for="one" class=" active one"></label>
                    <label for="two" class="two"></label>
                </div>
            </div>
        <?php
    }

    public function footer()
    {
        ?>
            <!-- Remove the container if you want to extend the Footer to full width. -->
            <div class="container ">
                <!-- Footer -->
                <footer class="text-center text-secondary " style="background-color: #F6E9DD ; ">
                    <!-- Grid container -->
                    <div class="container">
                        <!-- Section: Links -->
                        <section class="">
                            <!-- Grid row-->
                            <div class="row text-center d-flex justify-content-center">
                                <!-- Grid column -->
                                <div class="col-">
                                    <h6 class="text-uppercase font-weight-bold">
                                        <a href="#!" class=" secondary_text">About us</a>
                                    </h6>
                                </div>
                                <!-- Grid column -->


                                <!-- Grid column -->
                            </div>
                            <!-- Grid row-->
                        </section>
                        <!-- Section: Links -->

                        <hr class="my-3" />

                        <!-- Section: Text -->
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <p class="secondary_text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                                    distinctio earum repellat quaerat voluptatibus placeat nam,
                                    commodi optio pariatur est quia magnam eum harum corrupti
                                    dicta, aliquam sequi voluptate quas.
                                </p>
                            </div>
                        </div>
                        <!-- Section: Text -->

                        <!-- Section: Social -->
                        <section class="text-center mb-5">
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="" class="text-secondary me-4">
                                <i class="fab fa-github"></i>
                            </a>
                        </section>
                        <!-- Section: Social -->
                    </div>
                    <!-- Grid container -->

                    <!-- Copyright -->
                    <div class="text-center p-3 secondary_text">
                        © 2020 Copyright:
                        <a class=" secondary_text " href="https://chefcuisine.com/">chefcuisine.com</a>
                    </div>
                    <!-- Copyright -->
                </footer>
                <!-- Footer -->
            </div>
            <!-- End of .container -->

        </body>

        <footer style=" width: 100% ;">
        </footer>


<?php
    }
    public function display()
    {
        $this->header();
        $this->menu();
        $this->recipes_test();
        $this->footer();
    }
}
