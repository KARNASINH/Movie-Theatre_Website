<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();
?>

<?php
//inputs into form variables
$firstname = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING));
$lastname = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING));
$movie = trim(filter_var($_POST['movie'], FILTER_SANITIZE_STRING));
$screen = trim(filter_var($_POST['screen'], FILTER_SANITIZE_STRING));

$is_from_valid = true;

$firstname_regex = "([A-Z][a-zA-Z]*)";

if (empty($firstname) || !preg_match($firstname_regex, $firstname))
{
   echo "Please enter firstname and make sure first letter is capital";
   $is_from_valid = false;
}

if (empty($lastname))
{
   echo "Please enter lastname";
   $is_from_valid = false;
}

if (empty($movie))
{
   echo "Please select movie";
   $is_from_valid = false;
}

if (empty($screen))
{
   echo "Please select screen";
   $is_from_valid = false;
}

if($is_from_valid == true)
{
   try
   {
      //setup SQL insert command
      $sql = "INSERT INTO cinema (firstname, lastname, movie, screen) VALUES (:firstname, :lastname, :movie, :screen)";

      //creating command object and preparing with the form values
      $cmd = $conn->prepare($sql);
      $cmd -> bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
      $cmd -> bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
      $cmd -> bindParam(':movie', $movie, PDO::PARAM_STR, 50);
      $cmd -> bindParam(':screen', $screen, PDO::PARAM_STR, 50);

      //executing the command
      $cmd -> execute();

      //disconnecting from database
      $conn = null;
   }
   catch(Exception $e)
   {
      header("Location: error.php");
   }
//show message
echo "Ticket Bought";
}
?>