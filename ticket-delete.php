<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();

//If this page is fetched via GET.


//Then display record with cinfirmation button.
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
   $id = filter_var($_GET['ticket_id'], FILTER_SANITIZE_NUMBER_INT);

   $sql = "SELECT * FROM cinema WHERE ticket_id=" . $id; 
   $ticket = db_queryOne($sql, $conn);

   $firstname = $ticket['firstname'];
   $lastname = $ticket['lastname'];
   $movie = $ticket['movie'];
   $screen = $ticket['screen'];

   include_once 'shared/top.php';
?>

<h1 class="text-center mt-5 display-1 text-warning"><i class="bi bi-x-circle"></i></h1>
<h1 class="text-center mt-5">Are you sure you want to delete this?</h1>

<div class="row mt-5 justify-content-center">
   <form class="col-6 mb-5 " method="POST">
      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="firstname">Firstname</label>
         <div class="col-10">
            <input readonly class="form-control for-control-lg" type="text" name="title" value="<?php echo $firstname; ?>">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="year">Lastname</label>
         <div class="col-10">
            <input readonly class="form-control for-control-lg" type="text" name="lastname" value="<?php echo $lastname; ?>">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="genre">Movie</label>
         <div class="col-10">
            <input readonly class="form-control for-control-lg" type="text" name="movie" value="<?php echo $movie; ?>">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="url">Screen</label>
         <div class="col-10">
            <input readonly class="form-control for-control-lg" type="text" name="screen" value="<?php echo $screen; ?>">
         </div>
      </div>

      <div class="d-grid">
         <input readonly class="form-control for-control-lg" type="hidden" name="ticket_id" value="<?php echo $id; ?>">
         <button class="btn btn-danger btn-lg">Delete forever</button>
      </div>
   </form>
</div>
<?php  
}
 
else if($_SERVER['REQUEST_METHOD'] == 'POST')
{

   $id = filter_var($_POST['ticket_id'], FILTER_SANITIZE_NUMBER_INT);

   echo "id is $id";

//If this page is fetched via POST.

   try
   {
//Then go ahead and actually delete the record.

      $sql = "DELETE FROM cinema WHERE ticket_id=".$id;

      $cmd = $conn->prepare($sql);
      $cmd -> execute(); 

      header("Location: ticket_table.php");
   }
   catch(Exception $e)
      {
         header("Location: error.php");
      }
}
?>