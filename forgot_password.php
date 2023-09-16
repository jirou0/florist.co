<?php

@include 'config.php';

if (isset($_POST['search_email'])) 
{
   $email = $_POST['email'];
   $question = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die('query failed');
   if(mysqli_num_rows($question) > 0){
      
      $row = mysqli_fetch_assoc($question);
      $question_string = $row['question_forgot'];
   }
   
   else{
      $message[] = 'incorrect email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>

<body>

   <?php
   if (isset($question_string)) {
         echo '
      <div class="message">
         <span>' . $question_string . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
   ?>

   <section class="form-container">
      <form action="" method="post">
         <h3>Lupa Katasandi</h3>
         <input type="email" name="email" class="box" placeholder="enter your email" required>
         <input type="submit" class="btn" name="search_email" value="check email">
         <p>Sudah mempunyai akun? <a href="login.php">Masuk sekarang</a></p>
      </form>

   </section>

</body>

</html>