<?php
require('connect-db.php');
require('userinfo.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['action']) && $_POST['action'] == 'Sign Up') {
        // add userinfo
        addUserInfo($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['pwd']);
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
    <meta name="description" content="CVILLE EATS restaurant review site">
    <meta name="keywords" content="restaurant, review, Charlottesville, food, drinks">
    <meta name="citation" content="https://www.tutorialrepublic.com/snippets/preview.php?topic=bootstrap&file=simple-registration-form">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign Up</title>
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar-nav {
            text-align: right;
        }

        .navbar,
        .navbar-nav,
        .nav-link {
            padding-right: 1em;
        }

        body {
            /* display: flex; */
            /* justify-content: center; */
            /* align-items: center;*/
            height: 100vh;
            background: url("https://images.unsplash.com/photo-1536238202089-6ce355328a96?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80") no-repeat center;
            background-size: cover;
        }

        .form-control {
            height: 40px;
            box-shadow: none;
            color: #969fa4;
        }

        .form-control:focus {
            border-color: #5cb85c;
        }

        .form-control,
        .btn {
            border-radius: 3px;
            border-radius: 15px;
        }

        .signup-form {
            width: 450px;
            /* margin: 0 auto; */
            margin-left: 700px;
            margin-top: 150px;
            padding: 30px 0;
            font-size: 15px;
        }

        .signup-form h2 {
            color: #636363;
            margin: 0 0 15px;
            position: relative;
            text-align: center;
        }

        .signup-form h2:before,
        .signup-form h2:after {
            content: "";
            height: 2px;
            width: 30%;
            background: #d4d4d4;
            position: absolute;
            top: 50%;
            z-index: 2;
        }

        .signup-form h2:before {
            left: 0;
        }

        .signup-form h2:after {
            right: 0;
        }

        .signup-form .hint-text {
            color: #999;
            margin-bottom: 30px;
            text-align: center;
            /* border-radius: 25px; */
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.5);
            padding: 30px;
            border-radius: 25px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
            /* border-radius: 25px; */
        }

        .signup-form input[type="checkbox"] {
            margin-top: 3px;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            min-width: 140px;
            outline: none !important;
            background: #166cea;
            color: white;
            border-radius: 18px;
        }

        .signup-form .row div:first-child {
            padding-right: 10px;
        }

        .signup-form .row div:last-child {
            padding-left: 10px;
        }

        .signup-form a {
            /* color: #5cb85c; */
            color: #166cea;
            text-decoration: underline;
        }

        .signup-form a:hover {
            text-decoration: none;
        }

        .signup-form form a {
            /* color: #5cb85c; */
            color: #166cea;
            text-decoration: none;
        }

        .signup-form form a:hover {
            text-decoration: underline;
        }

        .text-center {
            color: gray;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- // if ($_SERVER['REQUEST_METHOD'] == 'POST') { // authenticated
    //     if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['username']))   // isset, !empty
    //     {
    //         setcookie('test', "testtest", time() + 3600);
    //         // setcookie('first', $_POST['first_name'], time() + 3600);
    //         // setcookie('last', $_POST['last_name'], time() + 3600);
    //         // setcookie('user', $_POST['username'], time() + 3600);
    //         // setcookie('pwd', password_hash($_POST['pwd'], PASSWORD_DEFAULT), time() + 3600);
    //         // setcookie('confirm', $_POST['confirm_password'], time() + 3600);
    //         // header('Location: main.php');
    //     }
    // } -->

    <?php include('header.html') ?>

    <div class="signup-form">
        <form action="signup.php" method="post">
            <h2>Join Us!</h2>
            <p class="hint-text">Create your account. It's free and only takes a minute.</p>
            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control" name="firstname" placeholder="First Name" required></div>
                    <div class="col"><input type="text" class="form-control" name="lastname" placeholder="Last Name" required></div>
                </div>
            </div>
            <div class="form-group">
                <input type="name" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="name" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" id="pwd1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_pwd" id="pwd2" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <label class="form-check-label"><input type="checkbox" required> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-lg" name="action" value="Sign Up" />
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.php">Sign In</a></div>
    </div>

</body>

</html>