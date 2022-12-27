<!-- authors: Esha Nama, Cynthia Wang, and Claire Yoon -->
<?php

function addUserInfo($firstname, $lastname, $email, $username, $pwd)
{
global $db;

 $query = "INSERT INTO userinfo (firstname, lastname, email, username, pwd) VALUES (:firstname, :lastname, :email, :username, :pwd)";
 $statement = $db->prepare($query); 
 $statement->bindValue(':firstname', $firstname);
 $statement->bindValue(':lastname', $lastname);
 $statement->bindValue(':email', $email);
 $statement->bindValue(':username', $username);
 $statement->bindValue(':pwd', $pwd);
 $statement->execute();

 $statement->closeCursor();
}
?>