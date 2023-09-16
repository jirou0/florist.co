<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_question = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
   $filter_answer = filter_var($_POST['answer'], FILTER_SANITIZE_STRING);
   $question = mysqli_real_escape_string($conn, $filter_question);
   $answer = mysqli_real_escape_string($conn, $filter_answer);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, question_forgot, answer_forgot) VALUES('$name', '$email', '$pass', '$question', '$answer')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
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
   <link rel="stylesheet" href="./css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="post">
      <h3>Lupa Katasandi</h3>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="question_forgot" name="question" class="box" placeholder="enter hint for forgot password" required>
      <input type="answer_forgot" name="answer" class="box" placeholder="enter the hint" required>
      <input type="submit" class="btn" name="submit" value="register now">
      <p>Sudah mempunyai akun? <a href="login.php">Masuk sekarang</a></p>
   </form>

</section>

</body>
</html>