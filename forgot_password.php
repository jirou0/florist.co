<?php
@include 'config.php';

$message = []; // Initialize the message array to avoid undefined variable errors
$email = '';

if (isset($_POST['search_email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']); // Sanitize and escape the input

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die('Query failed');

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $question_string = $row['question_forgot'];
    } else {
        $message[] = 'Incorrect email';
    }
}

if (isset($_POST['validate'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query) or die('Query failed');
    $answer = $_POST['answer'];

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $question_string = $row['question_forgot'];

        if ($row['answer_forgot'] !== $answer) {
            $message[] = 'Incorrect answer';
        } else {
            $filter_pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $pass = mysqli_real_escape_string($conn, md5($filter_pass));

            // Update the user's password
            $updateQuery = "UPDATE users SET password = '$pass' WHERE id = " . $row['id'];
            mysqli_query($conn, $updateQuery);

            $message[] = 'Success Changing Password!';
            $question_string = null;
        }
    } else {
        $message[] = 'Incorrect email';
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

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>

<body>

    <?php
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '
            <div class="message">
                <span>' . $msg . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }
    ?>

    <?php if (isset($question_string)&&isset($email)) { ?>
        <section class="form-container">
            <form action="" method="post">
                <h3>
                    <?php echo $email ?>
                </h3>
                <input type="text" name="answer" class="box" placeholder="enter your answer" required>
                <input type="password" class="box" name="password" placeholder="enter your new password" required>
                <input type="hidden" name="email" value="<?php echo $email?>">
                <input type="submit" class="btn" name="validate" value="Check Email">
                <p>Sudah mempunyai akun? <a href="login.php">Masuk Sekarang</a></p>
            </form>
        </section>
    <?php } else { ?>
        <section class="form-container">
            <form action="" method="post">
                <h3>Lupa Katasandi</h3>
                <input type="email" name="email" class="box" placeholder="enter your email" required>
                <input type="submit" class="btn" name="search_email" value="Check Email">
                <p>Sudah mempunyai akun? <a href="login.php">Masuk sekarang</a></p>
            </form>
        </section>
    <?php } ?>

</body>

</html>