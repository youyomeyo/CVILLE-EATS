<?php session_start();
?>

<?php
require('connect-db.php');
require('search-functions.php');

$restaurants = getAllRestaurants();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['action']) && $_POST['action'] == 'Filter') {
        $restaurants = filterRstsByPrice(2);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CVILLE EATS: Search Page">
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CVILLE EATS | Search</title>

    <!-- css, link for star icons, and bootstrap -->
    <link type="text/css" rel="stylesheet" href="style.css" async defer />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--using "plus jakarta sans" font from google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500&display=swap" rel="stylesheet">

    <!--favicon from favicon.io-->
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <!-- <link rel="manifest" href="site.webmanifest"> -->

    <style>
        .navbar-nav {
            text-align: right;
        }

        .navbar,
        .nav-link {
            background-color: #00bfc7;
            padding-right: 1em;
            color: black;
        }

        .navbar-right {
            float: right;
        }
    </style>
</head>



<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-md">
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
                    <a class="nav-link" href="login.php">Sign In</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>

<?php
        }
?>

<!--title and search bar-->
<div class="title-block">
    <h1 class="title">Search Restaurants</h1>
    <form name="search">
        <div id="searchInput" class="feedback"></div>
        <input type="text" size="30" autofocus required>
        <button type="button" class="btn btn-sm btn-dark" style="margin-bottom: 5px">Search</button>
    </form>
</div>

<!-- filters and sort by-->
<div class="row pt-4">
    <div class="col-6">
        <div class="row">
            <div class="col">
                <h5>Filter:</h5>
            </div>
            <!-- <form action="search.php" method="post"> -->
            <div class="col">
                <form action="">
                    <select name="cuisine" id="cuisine">
                        <option value="all-cuisine">Cuisine</option>
                        <option value="thai">Thai</option>
                        <option value="pizza">Pizza</option>
                        <option value="mexican">Mexican</option>
                        <option value="fast-food">Fast Food</option>
                    </select>
                </form>
            </div>

            <div class="col">
                <form action="">
                    <select name="location" id="location">
                        <option value="all-location">Location</option>
                        <option value="corner">The Corner</option>
                        <option value="downtown">Downtown</option>
                        <option value="barracks">Barracks</option>
                        <option value="jpa">JPA</option>
                    </select>
                </form>
            </div>

            <div class="col">
                <form action="">
                    <select name="rating" id="rating">
                        <option value="all-rating">Rating</option>
                        <option value="five-stars">5 Stars</option>
                        <option value="four-stars">4 Stars</option>
                        <option value="three-stars">3 Stars</option>
                        <option value="two-stars">2 Stars</option>
                        <option value="one-star">1 Star</option>
                    </select>
                </form>
            </div>

            <div class="col">
                <form method="get" action="search.php">
                    <select name="price-filter" id="price-filter">
                        <option value="all-price">Price</option>
                        <option value="four-dollar">$$$$</option>
                        <option value="three-dollar">$$$</option>
                        <option value="two-dollar">$$</option>
                        <option value="one-dollar">$</option>
                    </select>
                </form>
            </div>

            <div class="col">
                <form action="search.php" method="post">
                    <input type="submit" value="Filter" name="action" class="btn btn-dark" title="Filter Restaurants" />
                </form>
            </div>

        </div>
    </div>

    <div class="col">
        <p></p>
    </div>

    <div class="col-3">
        <div class="row">
            <div class="col">
                <h5>Sort By:</h5>
            </div>

            <div class="col">
                <form action="">
                    <select name="sort-by" id="sort-by">
                        <option value="highest-rated">Highest Rated</option>
                        <option value="most-reviewed">Most Reviewed</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

</div>

<!--restaurant cards using the database -->
<?php foreach ($restaurants as $rst) : ?>
    <div class="card mb-12" id="">
        <div class="row g-0">
            <div class="col-md-3">
                <img src="<?php echo $rst['image'] ?>" class="img-fluid rounded-start" alt="<?php echo $rst['name'] ?> food">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <h5 class="card-title"><?php echo $rst['name'] ?></h5>
                        </div>
                        <div class="col">
                            <p><?php echo display_price($rst['price']) ?></p>
                        </div>
                        <div class="col-2">
                            <?php $num_stars = display_rating($rst['rating']) ?>
                            <span class="fa fa-star <?php echo $num_stars[0] ?>"></span>
                            <span class="fa fa-star <?php echo $num_stars[1] ?>"></span>
                            <span class="fa fa-star <?php echo $num_stars[2] ?>"></span>
                            <span class="fa fa-star <?php echo $num_stars[3] ?>"></span>
                            <span class="fa fa-star <?php echo $num_stars[4] ?>"></span>
                        </div>
                        <div class="col-6">
                            <p></p>
                        </div>
                    </div>
                    <p class="card-text"><?php echo $rst['reviews'] ?> Reviews</p>
                    <p class="card-text">Location: <?php echo $rst['location'] ?></p>
                    <p class="card-text">Cuisine: <?php echo $rst['cuisine'] ?></p>
                    <p class="card-text">Hours: 11 AM - 9 PM</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row pt-5">
                    <form action="restaurant-detail.php" method="post">
                        <input type="submit" value="More Info" name="moreinfo" class="btn btn-dark"></a>
                        <input type="hidden" name="send_rest_name" value="<?php echo $rst['name'] ?>" />
                    </form>
                </div>
                <div class="row pt-5">
                    <a class="btn btn-dark" href="<?php echo $rst['website'] ?>" target="_blank">Website</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- footer -->
<footer class="footer-container">
    <div class="container">
        <div class="row">
        </div>
    </div>
    <div class="text-center">&copy; Esha Nama, Cynthia Wang, and Claire Yoon</div>
</footer>

</body>

<script>
    function showRestaurantsPrice() {

        var selectedPrice = function() {
            return document.getElementById("price").value;
        }();

        if (selectedPrice == "all-price") {
            document.getElementById("silk-thai").style.display = "block";
            document.getElementById("monsoon-siam").style.display = "block";
            document.getElementById("lemongrass").style.display = "block";
        }
        if (selectedPrice == "four-dollar") {
            document.getElementById("silk-thai").style.display = "none";
            document.getElementById("monsoon-siam").style.display = "none";
            document.getElementById("lemongrass").style.display = "none";
        }
        if (selectedPrice == "three-dollar") {
            document.getElementById("silk-thai").style.display = "none";
            document.getElementById("monsoon-siam").style.display = "block";
            document.getElementById("lemongrass").style.display = "none";
        }
        if (selectedPrice == "two-dollar") {
            document.getElementById("silk-thai").style.display = "block";
            document.getElementById("monsoon-siam").style.display = "none";
            document.getElementById("lemongrass").style.display = "none";
        }
        if (selectedPrice == "one-dollar") {
            document.getElementById("silk-thai").style.display = "none";
            document.getElementById("monsoon-siam").style.display = "none";
            document.getElementById("lemongrass").style.display = "block";
        }
    }

    function filter() {
        showRestaurantsPrice();
    }
</script>

</html>