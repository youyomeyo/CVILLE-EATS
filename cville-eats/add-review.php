<?php session_start(); ?>
<?php
require('connect-db.php');
require('add-db.php');

$reviews = getAllReviews();
$review_to_update = NULL;

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['action']) && $_POST['action']=='Submit Review'){
        addReview($_POST['restaurant'], $_POST['comments'], $_POST['rating']);
        //reflects what was just added
        $reviews = getAllReviews();
    }
    else if(!empty($_POST['action']) && $_POST['action']=='Update'){
        //retrieve task to update
        $review_to_update = getReviewInfo_by_Name($_POST['review_desc_to_update']);
        //update after confirm
    }
    else if(!empty($_POST['action']) && $_POST['action']=='Delete'){
        //delete the given task
        deleteReview($_POST['review_desc_to_delete']);
        $reviews = getAllReviews();
    }

    if(!empty($_POST['action']) && $_POST['action']=='Update Review'){
        updateReviewInfo($_POST['restaurant'], $_POST['comments'], $_POST['rating']);
        $reviews= getAllReviews();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Reviews</title>
    <meta name="author" content="Esha Nama, Cynthia Wang, Claire Yoon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="custom-css.css" />

    <style>
        .error {
            color: red;
            font-style: italic;
            font-size: 0.8em;
            padding-left: 16px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="main.php">CVILLE EATS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
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
<div class="container">

<h1 class="mt-3">Add Review</h1>

<form name="mainForm" action="add-review.php" method="post">
  <div class="mb-3">
    <label for="restaurant">Restaurant </label>
    <input type="text" name="restaurant" class="form-control" name="desc"
    value="<?php if ($review_to_update != null) echo $review_to_update['rest_name']?>" />
  </div>  
  <div class="mb-3">
    <label for="comments">Comments</label>  
    <input type="text" name="comments" class="form-control" 
    value="<?php if ($review_to_update != null) echo $review_to_update['comment_desc']?>"/> 
  </div>  
  <div class="mb-3">
    <label for="rating">Rating</label>
    <select name="rating" class="form-select" >
      <option value=""></option>
      <option value="1"
    <?php if ($review_to_update != null && $review_to_update['rating']=='1') { ?>
        selected
        <?php } ?>
        >1</option> 
      <option value="2"
      <?php if ($review_to_update != null && $review_to_update['rating']=='2') { ?>
        selected
        <?php } ?>
        >2</option>
        <option value="3"
      <?php if ($review_to_update != null && $review_to_update['rating']=='3') { ?>
        selected
        <?php } ?>
        >3</option>
        <option value="4"
      <?php if ($review_to_update != null && $review_to_update['rating']=='4') { ?>
        selected
        <?php } ?>
        >4</option>
        <option value="5"
      <?php if ($review_to_update != null && $review_to_update['rating']=='5') { ?>
        selected
        <?php } ?>
        >5</option>
    </select>
  </div>

  <input type="submit" value="Submit Review" name="action" class="btn btn-dark" title="Insert a task into a todo table" />
  <input type="submit" value="Update Review" name="action" class="btn btn-dark" title="Confirm update a task" />
  
</form>  

  
<hr/>
<h3>My Reviews</h3>
<table class="w4-table w3-bordered w3-card-4 center" style="width:100%">
  <thead>
  <tr style="background-color:#00bfc7; color:white">
    <th width="20%">Restaurant</th>        
    <th width="50%">Comments</th>        
    <th width="10%">Rating</th> 
    <th width="10%">(Update?)</th>
    <th width="10%">(Delete?)</th> 
  </tr>
  </thead>
<?php
foreach ($reviews as $item):?>
<tr>
    <td><?php echo $item['rest_name'] ?></td>
    <td><?php echo $item['comment_desc'] ?></td>
    <td><?php echo $item['rating'] ?></td>
    <td>
        <form action="add-review.php" method="post">
            <input type="submit" value="Update" name="action" class="btn btn-primary"/>
            <input type="hidden" name="review_desc_to_update"
            value="<?php echo $item['rest_name'] ?>"/>
</form>
</td>
<td>
        <form action="add-review.php" method="post">
            <input type="submit" value="Delete" name="action" class="btn btn-danger"/>
            <input type="hidden" name="review_desc_to_delete"
            value="<?php echo $item['rest_name'] ?>"/>
</form>
</td>
</tr>
<?php endforeach;?>
</table>
       
</div>    
</body>
</html>
  