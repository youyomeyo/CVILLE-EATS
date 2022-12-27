<!-- authors: Esha Nama, Cynthia Wang, and Claire Yoon -->
<?php
$name = $password = NULL;
$name_msg = $pwd_msg = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (empty($_POST['username']) && !empty($_POST['pwd'])) {
      $name_msg = "Please enter your username!";
   }
   else if (empty($_POST['pwd']) && !empty($_POST['username'])) {
      $pwd_msg = "Please enter your password!";
   }
   else {
      $name = trim($_POST['username']);
      $password = trim($_POST['pwd']);
   }
}
?>