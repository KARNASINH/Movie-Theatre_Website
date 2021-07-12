<?php

function validate_registration($user, $conn)
{
   $errors = [];

   if(empty(trim($user['email'])))
   {
      $errors['email'] = "Email can not be blank";
   }

   $email_regex = "/.+\@.+\..+/";

   if(!preg_match($email_regex, $user['email']))
   {
      $errors['email'] = "Username must be a valid email address";
   }

   if(empty(trim($user['new-password'])))
   {
      $errors['password'] = "Password can not be blank";
   }
    
   if(empty(trim($user['confirm-password'])))
   {
      $errors['confirm'] = "Confirmation password can not be blank";
   }     

   $sql = "SELECT * FROM viewers WHERE username='" . $user['email']."'";
   $cmd = $conn -> prepare($sql);
   $cmd -> execute();

   $found_username = $cmd -> fetch();

   if($found_username)
   {
      $errors['email'] = 'Username already taken';
   }
   return $errors;
}
?>