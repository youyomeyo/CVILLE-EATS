<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
    <meta name="description" content="CVILLE EATS restaurant review site">
    <meta name="keywords" content="restaurant, review, Charlottesville, food, drinks">
    <title>CVILLE EATS</title>

    <!--using "plus jakarta sans" font from google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">

    <!--favicon from favicon.io-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <link type="text/css" rel="stylesheet" href="main-css.css" async defer />

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-md navbar-light">
        <?php
        if ((isset($_COOKIE['user'])) && (isset($_SESSION['user']))) {
        ?>
            <div class="container-fluid">
                <a class="navbar-brand" href="main.php">CVILLE EATS</a>

                <!--This navbar will be hidden where it is mobile or small screen-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Map</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search.php">Restaurants</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Suggestions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="my-account.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><?php echo "Sign Out" ?></a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>

<?php
        } else {
?>
    <div class="container-fluid">
        <a class="navbar-brand" href="main.php">CVILLE EATS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Map</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Suggestions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-account.php">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Sign In</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>
<?php
        }
?>
<div class="title-block">
    <!--title and search bar-->
    <h1 class="title">CVILLE EATS</h1>
    <form name="search" action="main.php" method="get">
        <div id="searchInput" class="feedback"></div>
        <input type="text" id="searchName" name="searchName" size="30" placeholder="type, food or restaurant name" autofocus required>
        <input type="submit" value="Search" class="btn btn-sm btn-dark" style="margin-bottom: 5px">
        <br>
        <font color="blue" style="font-style:italic"><?php validityCheck(); ?></font>
    </form>
</div>

<div>
    <!--recent reviews-->
    <a class="btn">
        <h2 class="header" href="#">Recent Reviews</h2>
    </a>
    <section class="top-bottom">
        <div class="rowspace">
            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://www.davisenterprise.com/files/2021/11/raisingcanes-800x500.jpeg" alt="chicken" width="320" height="240">
                    <p>Raising Cane's Chicken</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </a>
            </section>

            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://media-cdn.tripadvisor.com/media/photo-s/13/e8/11/dd/spider-roll.jpg" alt="sushi" width="320" height="240">
                    <p>Sushi King</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </a>
            </section>

            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://images.squarespace-cdn.com/content/v1/607f3c351d1dad13a1128b21/1634921911321-6UBSW6DR0AA5WD6GO46U/JohnRobinson_CitizenBurger+%2856%29.jpg" alt="burger" width="320" height="240">
                    <p>Citizen Burger Bar</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                </a>
            </section>
        </div>
    </section>
</div>

<div>
    <!--higest average rating-->
    <a class="btn">
        <h2 class="header" href="#">High Average Rating</h2>
    </a>

    <section class="top-bottom">
        <div class="rowspace">
            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://photos.bringfido.com/restaurants/6/8/9/34986/34986_98630.jpg?size=slide&density=2x" alt="pasta" width="320" height="240">
                    <p>Orzo Kitchen & Wine Bar</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                </a>
            </section>

            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://d1ralsognjng37.cloudfront.net/9763793f-6118-4d3d-9907-ddf4f6728b34.jpeg" alt="thai food" width="320" height="240">
                    <p>Silk Thai Restaurant</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </a>
            </section>

            <section class=" col-separater col">
                <a class="btn btn-white" href="#">
                    <img src="https://img.taste.com.au/w_-0kcUJ/taste/2016/11/aussie-style-beef-and-salad-tacos-86525-1.jpeg" alt="tacos" width="320" height="240">
                    <p>Brazos Tacos</p>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                </a>
            </section>
        </div>
    </section>
</div>

<!--footer: copywrite-->
<footer class="footer-container">
    <div class="container">
        <div class="row">
        </div>
    </div>
    <div class="text-center">&copy; 2022 Copyright: Esha Nama, Cynthia Wang, and Claire Yoon</div>
</footer>
<?php
function validityCheck()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!empty($_GET['searchName'])) {

            if (intval(strlen(trim($_GET['searchName']))) < 3) {
                echo "Please write at least 3 letters!";
            }
        }
    }
}
?>
</body>

</html>