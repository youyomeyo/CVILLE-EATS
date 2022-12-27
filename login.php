<?php session_start();
?>

<?php
function reject($entry)
{
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
    <meta name="description" content="CVILLE EATS login page">
    <meta name="keywords" content="restaurant, review, Charlottesville, food, drinks">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign In</title>
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
            min-width: 100vw;
            height: 100vh;
            background: url("https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80") no-repeat center;
            background-size: cover;
        }

        .msg {
            font-style: italic;
            color: red;
        }

        .container {
            margin-left: 150px;
            margin-top: 250px;
            width: 450px;
            height: 360px;
            /* position: relative; */
            /* z-index: 2; */
            position: relative;
            text-align: center;
        }

        .container h1 {
            font-size: 48px;
            color: #fff;
            text-align: center;
            margin-bottom: 60px;
        }

        /* @media only screen and (max-width: 768px) {
            .narrow {
                left: 0px;
            }
        } */

        .input-area {
            width: 400px;
            position: relative;
            margin-top: 20px;
        }

        .input-area:first-child {
            margin-top: 0;
        }

        .input-area input {
            width: 100%;
            padding: 20px 10px 10px;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            font-size: 18px;
            color: #fff;
            outline: none;
        }

        .input-area label {
            text-align: center;
            position: absolute;
            left: 10px;
            top: 15px;
            font-size: 18px;
            color: #999;
            transition: all .5s ease;
        }

        .input-area input:focus+label,
        .input-area input:valid+label {
            top: 0;
            font-size: 13px;
            color: #166cea;
        }

        .btn-area {
            margin-top: 30px;
        }

        .btn-area button {
            width: 400px;
            height: 50px;
            background: #fff;
            color: #166cea;
            font-size: 20px;
            border: none;
            border-radius: 25px;
            background-color: rgba(255, 255, 255, 0.5);
        }

        .caption {
            margin-top: 20px;
            text-align: center;
            color: gray;
        }

        .caption a {
            font-size: 15px;
            color: #166cea;
            text-decoration: none;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php include('login-handler.php'); ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0 && !empty($_POST['pwd'])) {
        $user = trim($_POST['username']);
        if (!ctype_alnum($user))
            reject('User Name');

        if (isset($_POST['pwd'])) {
            $pwd = trim($_POST['pwd']);
            if (!ctype_alnum($pwd))
                reject('Password');
            else {
                $_SESSION['user'] = $user;
                $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $_SESSION['pwd'] = $hash_pwd;
            }
        }
    }
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (strlen($_POST['username']) > 0 && !empty($_POST['pwd'])) {
            setcookie('user', $_POST['username'], time() + 3600);
            setcookie('pwd', password_hash($_POST['pwd'], PASSWORD_DEFAULT), time() + 3600);
            header('Location: main.php');
        }
    }
    ?>

    <?php include('header.html') ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>CVILLE EATS</h1>
                    <div class="input-area">
                        <input type="text" name="username" autocomplete="off" autofocus>
                        <?php if (isset($_POST['username'])) echo "<span class='msg'>$name_msg</span> <br/>" ?>
                        <label for="id">Username</label>
                    </div>
                    <div class="input-area">
                        <input type="password" name="pwd" autocomplete="off" autofocus>
                        <?php if (isset($_POST['pwd'])) echo "<span class='msg'>$pwd_msg</span> <br/>" ?>
                        <label for="pwd">Password</label>
                    </div>
                    <div class="btn-area">
                        <button id="btn" type="submit">Sign In</button>
                    </div>
                    <div class="caption">Not a member, yet? <a href="signup.php">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>