<!-- authors: Esha Nama, Cynthia Wang, and Claire Yoon -->
<?php

$username = 'cville_eats';
$password = 'cville';
$host = 'localhost:3306';
$dbname = 'cvilleusers';
$dsn = "mysql:host=$host;dbname=$dbname";  

/** connect to the database **/
try 
{
   $db = new PDO($dsn, $username, $password);
   
   // dispaly a message to let us know that we are connected to the database 
   // echo "<p>You are connected to the database --- $dsn </p>";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>