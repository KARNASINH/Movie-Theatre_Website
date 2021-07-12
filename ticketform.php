<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();
?>

<?php
include_once 'shared/top.php';
?>

<h1 class="text-center mt-5">Buy Ticket here <i class="bi bi-film"></i></h1>

<div class="row mt-5 justify-content-center">
   <form class="col-6 mb-5 " action="ticket_sql-data.php" method="POST">
      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="firstname">Firstname</label>
         <div class="col-10">
            <input type="text" class="form-control for-control-lg" type="text" name="firstname">
         </div>
      </div>

      <div class="row mb-4">
         <label class="col-2 col-form-label fs-4" for="lastname">Lastname</label>
         <div class="col-10">
            <input type="text" class="form-control for-control-lg" type="text" name="lastname">
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
         <button class="btn btn-success btn-lg">Submit</button>
      </div>
   </form>
</div>


<?php
include_once 'shared/footer.php';
?>