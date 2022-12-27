<?php
function getAllReviews()
{
    global $db;
    $query ="select * from reviews";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll(); //retrieves all rows
    $statement->closeCursor();

    return $results;
}

function getReviewInfo_by_Name($review)
{
    global $db;
    $query = "SELECT * from reviews where rest_name = :restaurant";
    $statement = $db->prepare($query);
    $statement->bindValue(':restaurant', $review);
    $statement->execute();

    $results = $statement->fetch();

    $statement->closeCursor();
    return $results;

}

function addReview($review, $comments, $rating)
{
	//db handler
    global $db;

    //sql
    $query = "INSERT INTO reviews (rest_name, comment_desc, rating) VALUES (:restaurant, :comments, :rating)";
    //execute
    $statement = $db->prepare($query);
    $statement->bindValue(':restaurant', $review);
    $statement->bindValue(':comments', $comments);
    $statement->bindValue(':rating', $rating);
    $statement->execute();
    //release
    $statement->closeCursor();
}

function updateReviewInfo($review, $comments, $rating)
{
    //db handler
    global $db;
    //sql
    $query = "UPDATE reviews SET comment_desc=:comments, rating=:rating WHERE rest_name=:restaurant";
    //execute
    $statement = $db->prepare($query);
    $statement->bindValue(':comments', $comments);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':restaurant', $review);
    $statement->execute();
    //release
    $statement->closeCursor();
	
}

function deleteReview($review)
{
    global $db;
    $query = "DELETE FROM reviews WHERE rest_name=:restaurant";
    $statement = $db->prepare($query);
    $statement->bindValue(':restaurant', $review);
    $statement->execute();
    $statement->closeCursor();
}
?>





