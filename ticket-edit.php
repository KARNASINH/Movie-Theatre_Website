<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();
?>

<?php
include_once 'shared/top.php';


//if post request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   
   //- use same form fields as before
   $firstname = trim(filter_var($_POST['firstname'], FILTER_SANITIZE_STRING));
   $lastname = trim(filter_var($_POST['lastname'], FILTER_SANITIZE_STRING));
   $movie = trim(filter_var($_POST['movie'], FILTER_SANITIZE_STRING));
   $screen = trim(filter_var($_POST['screen'], FILTER_SANITIZE_STRING));
   $id = trim(filter_var($_POST['ticket_id'], FILTER_SANITIZE_NUMBER_INT));

//- run update statements
$sql = "UPDATE cinema SET firstname=:firstname, ";
$sql .="lastname=:lastname, movie=:movie, screen=:screen ";
$sql .="WHERE ticket_id=:id";


//creating command object and preparing with the form values
$cmd = $conn->prepare($sql);
$cmd -> bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
$cmd -> bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
$cmd -> bindParam(':movie', $movie, PDO::PARAM_STR, 50);
$cmd -> bindParam(':screen', $screen, PDO::PARAM_STR, 50);
$cmd -> bindParam(':id', $id, PDO::PARAM_INT);

//executing the command
$cmd -> execute();
//- redirect to game
header("Location: ticket_table.php");
}
//if get request
else if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

    // - get if from url
   $id = filter_var($_GET['ticket_id'], FILTER_SANITIZE_NUMBER_INT);

   //- query db for 1 record
   $sql = "SELECT * FROM cinema WHERE ticket_id=" . $id; 
   $ticket = db_queryOne($sql, $conn);

   $firstname = $ticket['firstname'];
   $lastname = $ticket['lastname'];
   $movie = $ticket['movie'];
   $screen = $ticket['screen'];
}

?>

<h1 class="text-center mt-5">Edit ticket <i class="bi bi-film"></i></h1>

<div class="row mt-5 justify-content-center">
   <form class="col-6 mb-5 " action="ticket-edit.php" method="POST">
      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="firstname">Firstname</label>
         <div class="col-10">
            <input type="text" class="form-control for-control-lg" type="text" name="firstname"
               value="<?php echo $firstname; ?>">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="lastname">Lastname</label>
         <div class="col-10">
            <input type="text" class="form-control for-control-lg" type="text" name="lastname"
               value="<?php echo $lastname; ?>">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="movie">Movie</label>
         <div class="col-10">
            <select name="movie" id="" class="form-select form-select-lg">
               <?php
                     $sql = "SELECT DISTINCT movie FROM movielist ORDER BY movie";
                     $movieRange = db_queryAll($sql, $conn);
                     
                     foreach($movieRange as $movie)
                     {
                        echo "<option value=" . ucfirst($movie["movie"]) . ">" . ucfirst($movie["movie"]) . "</option>";
                     }
                  ?>
            </select>
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="url">Screen</label>
         <div class="col-10">
            <select name="screen" id="" class="form-select form-select-lg">
               <?php
                     $sql = "SELECT DISTINCT screen FROM movielist ORDER BY screen";
                     $screenRange = db_queryAll($sql, $conn);
                     
                     foreach($screenRange as $screen)
                     {
                        echo "<option value=" . ucfirst($screen["screen"]) . ">" . ucfirst($screen["screen"]) . "</option>";
                     }
                  ?>
            </select>
         </div>
      </div>

      <div class="d-grid">
      <input readonly class="form-control for-control-lg" type="hidden" name="ticket_id" value="<?php echo $id; ?>">
         <button class="btn btn-success btn-lg">Update Ticket</button>
      </div>
   </form>
</div>

<?php
include_once 'shared/footer.php';
?>