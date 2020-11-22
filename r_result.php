<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Account Activation</title>
</head>
<body class="hold-transition login-page" style="background-color:#F7F6F6; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
    <?php session_start() ?>
    <br><br>
    <br><br>
<center>
  <div class="login-box" style="background-color:#fff;width:400px; box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);">
    <div class="login-box-body"  style="border-width: 5px">      
    <div style="font-size: 12px;margin-bottom: 30px">
    <img src="img/privyid_logo.png" style="width:150px;">
    <br>
    <br>
    <h5>Your Activation Code :</h5>
    <br>
    <h1><?php echo $_SESSION['otp']['sugar_id'] ?></h1>
    <form action="register.php" method="POST" style="margin: 20px;">
    <input type="hidden" name="case" value="2">
    <input type="hidden" name="id" value="<?php echo $_SESSION['otp']['id'] ?>">
    <input type="hidden" name="sugar_id" value="<?php echo $_SESSION['otp']['sugar_id'] ?>">
    <input type="hidden" name="phone" value="<?php echo $_SESSION['otp']['phone'] ?>">
    <br>
    <button type="submit" class="btn btn-danger btn-block">Submit</button>
</form>
<br>
</body>
</html>