<?php session_start();
?>

<?php
require('connect-db.php');
require('add-db.php');

$reviews = getAllReviews();
$review_to_update = NULL;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="custom-css.css" />
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">

    <style>
        .navbar-nav {
            text-align: right;
        }

        /* make the menu right justify */
        .navbar,
        .navbar-nav,
        .nav-link {
            padding-right: 1em;
        }

        /* add padding to the menu */
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <?php
        if ((isset($_COOKIE['user'])) && (isset($_SESSION['user']))) {
        ?>
            <div class="container-fluid">

                <a class="navbar-brand" href="main.php">CVILLE EATS</a>

                <!-- The button is hidden on desktop and becomes a dropdown hamburger menu on mobile.
       The navigation bar is hidden on small screens and
       replaced by a button in the top right corner (try to re-size this window).
       Only when the button (hamburger menu) is clicked, the navigation bar will be displayed. -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- To put navbar-brand on the right on small screen, put it after the toggler button -->
                <!-- <a class="navbar-brand" href="#">Your-Logo</a> -->

                <!-- ms-auto sets margin-start (i.e., set margin-left or margin-right -->

                <!-- nav-collapse makes it possible to expand and collapse the menu
       require: javascript plugin (we use js bootstrap here, at the bottom)                            
       commonly, lists with links are used for navigation -->

                <!-- navbar-nav is a sub-component of navbar which support dropdown -->

                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">

                        <!-- active and aria-current="page" indicate the state, use for breadcrumb trial purposes -->
                        <!-- <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="#">Home</a>
           </li> -->

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
<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-5 p-2">
            <p></p>
            <img src="https://thumbs.dreamstime.com/t/seafood-pasta-4852498.jpg" alt="pasta" width="240" height="180">
            <img src="https://thumbs.dreamstime.com/t/pizza-27972212.jpg" alt="pizza" width="240" height="180">
            <img src="https://thumbs.dreamstime.com/t/bagel-lox-12509641.jpg" alt="bagel" width="240" height="180">
            <p></p>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <h3 class="a"><?php echo $_POST['send_rest_name'] ?></h3>
            <span class="right-margin">American Cuisine with Italian Roots</span>
            <span class="fa fa-star checked big-stars"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="review-unhighlighted" id="total-reviews">120 reviews</span>
        </div>
        <div class="col-md-3 col-sm-5 p-2">
            <h3>Location and Hours</h3>
            <img src="https://cdn.pixabay.com/photo/2016/11/04/14/13/google-maps-1797882_1280.png" alt="Google Maps" width="180" height="180">
            <p>100 University Lane</p>
            <p>Charlottesville, VA 22904</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-sm-5 p-2">
            <a class="btn btn-primary btn-lg orange-btn" href="add-review.php"> Write a Review</a>
            <a class="btn btn-primary btn-lg yellow-btn" href="#"> Sort Reviews By </a>
            <p></p>
            <?php
            foreach ($reviews as $item) : ?>
                <tr>
                    <?php if ($item['rest_name'] == ($_POST['send_rest_name'])) { ?>
                        <?php for ($x = 0; $x < $item['rating']; $x++) { ?>
                            <span class="fa fa-star checked"></span>
                        <?php } ?>
                        <?php for ($x = 0; $x < 5 - $item['rating']; $x++) { ?>
                            <span class="fa fa-star"></span>
                        <?php } ?>
                        <br>
                        <td><?php echo $item['comment_desc'] ?></td>
                        <br>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
            <div class="col-md-3 col-sm-5 p-2">
                <p>Hours</p>
                <p class="hours">Monday 10:00 AM- 9:00 PM</p>
                <p class="hours">Tuesday 10:00 AM- 9:00 PM</p>
                <p class="hours">Wednesday 10:00 AM- 9:00 PM</p>
                <p class="hours">Thursday 10:00 AM- 9:00 PM</p>
                <p class="hours">Friday 10:00 AM- 11:00 PM</p>
                <p class="hours">Saturday 10:00 AM- 11:00 PM</p>
                <p class="hours">Sunday 12:00 AM- 9:00 PM</p>
            </div>
        </div>
    </div>

    <footer class="page-footer">
        <div class="text-center">&copy; 2022 Copyright: Esha Nama, Cynthia Wang, and Claire Yoom</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        //document.getElementById("total-reviews").onmouseover = function() {
        // do something like for example change the class of a div to change its color :
        //document.getElementById("total-reviews").className = "review-highlighted";
        let totalreviews = document.getElementById('total-reviews');

        totalreviews.addEventListener('mouseover', function handleMouseOver() {
            totalreviews.style.color = 'red';
        });

        totalreviews.addEventListener('mouseout', function handleMouseOut() {
            totalreviews.style.color = 'black';
        });
    </script>

</body>

</html>