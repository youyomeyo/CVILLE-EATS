<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
  <meta name="description" content="CVILLE EATS logout page">
  <meta name="keywords" content="restaurant, review, Charlottesville, food, drinks">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Sign Out</title>
  <style>
    body {
      height: 100vh;
      background: url("https://images.unsplash.com/photo-1486427944299-d1955d23e34d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80") no-repeat center;
      background-size: cover;
    }

    .checkbox {
      background-color: transparent;
      outline: none;
      border: none;
      text-align: center;
    }

    .card {
      background-color: transparent;
      outline: none;
      border: none;
      display: block;
      margin-top: 80px;
      margin-left: auto;
      margin-right: auto;
    }

    .card-body {
      color: gray;
    }
  </style>

</head>

<body>
  <?php
  if (count($_SESSION) > 0)   
  {
    foreach ($_SESSION as $key => $value) {
      unset($_SESSION[$key]);
    }
    session_destroy();    // remove session on the server side
    setcookie('PHPSESSID', '', time() -3600, "/");    // remove session on the client side

    if (isset($_COOKIE['user'])) {
  ?>
      <div class="checkbox">
        <div class="card" style="width: 15rem;">
          <img src="https://www.freeiconspng.com/thumbs/checkmark-png/checkmark-png-5.png" class="card-img-top">
        </div>
        <div class="card-body">
          <h1 class="card-title">Thank you, <font color="green" style="font-style:italic"> <?php echo $_COOKIE['user'] ?></font>
          </h1>
          <h2 class="card-title">You have been successfully signed out</h2>
          <h3 class="card-text">Redirecting to the main page...</h3>
        </div>
      </div>
    <?php
    }
    ?>
  <?php
    if (count($_COOKIE) > 0) { // delete cookies
      foreach ($_COOKIE as $key => $value) {
        unset($_COOKIE[$key]);
        setcookie($key, '', time() - 3600);
      }
      header('refresh:4; url=main.php'); // redirect to the main page after 4 seconds
    }
  }
  ?>

</body>

</html>