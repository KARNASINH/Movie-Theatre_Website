<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();
?>

<?php
include_once 'shared/top.php';

//Build sql query.
try
   {
      $sql = "SELECT * FROM cinema";
      $cinema = db_queryAll($sql, $conn);
   }
catch(Exception $e)
   {
      header("Location: error.php");
   }
?>

<table class="table table-danger table-boardered border-dark table-hover fs-5 mt-4">
   <thead>
      <tr>
         <th scope="col">First Name</th>
         <th scope="col">Last Name</th>
         <th scope="col">Movie</th>
         <th scope="col">Screen</th>
         <th scope="col"class="col-1">Edit</th>
         <th scope="col"class="col-1">Delete</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         foreach($cinema as $ticket) {
      ?>
      <tr>
         <th class="table-secondary" scope="row">
            <?php 
               echo $ticket['firstname']; 
            ?>
         </th>

         <td class="table-success">
            <?php echo $ticket['lastname']; ?>
         </td>

         <td class="table-warning">
            <?php 
            echo $ticket['movie']; 
         ?>
         </td>

         <td class="table-warning">
            <?php 
            echo $ticket['screen']; 
         ?>
         </td>

         <td>
            <a href="ticket-edit.php? ticket_id=<?php echo $ticket['ticket_id']; ?>" class="btn btn-secondary">Edit <i class="bi bi-pencil-square"></i></a>
         </td>

         <td>
            <a href="ticket-delete.php? ticket_id=<?php echo $ticket['ticket_id']; ?>" class="btn btn-warning"><span class="visually-hidden">Delete</span> <i class="bi bi-trash"></i></a>
         </td>
      </tr>

      <?php 
         } 
      ?>
   </tbody>
</table>


<?php

include_once 'shared/footer.php';

?>