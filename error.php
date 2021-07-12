<?php
//Connect to the database.
require_once 'database.php';
$conn = db_connect();
?>

<?php

include_once 'shared/top.php';

?>

<main class="container">

   <div class="row">
      <div class="col">
         <h1 class="mt-5 pt-5">We are sorry.</h1>
         <p>Something unexpected just happned. Our support team has been niotified and will get right on it.</p>
         <a href="main.php" class="btn btn-outline-secondary">Back to Homepage</a>
      </div>
      <div class="col">
         <img src="img/404error02.png" alt="unexpected error" style="width: 800px">
      </div>
   </div>

</main>

<?php

include_once 'shared/footer.php';

?>