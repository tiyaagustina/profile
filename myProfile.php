<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add Profile</title>
</head>
<body class="hold-transition login-page" style="font-size:17px;background-color:#fff; margin:30px;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
    <?php 
    session_start();
    if (!empty($_SESSION['access_token'])) { 
    ?>
<br>   
<?php 
 $opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Authorization: ".$_SESSION['access_token']."\r\n"
    )
  );

$context = stream_context_create($opts);
$url = 'http://pretest-qa.privydev.id/api/v1/profile/me';
// Open the file using the HTTP headers set above
$file = file_get_contents($url, false, $context);
$response=json_decode($file);
$item=$response->data->user;
?> 
<center><img src="img/privyid_logo.png" style="width:130px;"></center>
<br>
<br>
<form action="register.php" method="POST">
<div class="row">
  <div class="col-sm-4">
    <div class="card" style="box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);">
      <div class="card-body">
      <h5 class="card-header">#Personal Information</h5>
        <br>
        <span class="badge badge-pill badge-light">Name</span>
        <p class="card-text"><?php echo $item->name?></p>
        <span class="badge badge-pill badge-light">Gender</span>
        <p class="card-text"><?php echo $item->gender?></p>
        <span class="badge badge-pill badge-light">Birthday</span>
        <p class="card-text"><?php echo $item->birthday?></p>
        <span class="badge badge-pill badge-light">Home Town</span>
        <p class="card-text"><?php echo $item->hometown?></p>
        <span class="badge badge-pill badge-light">Bio</span>
        <p class="card-text"><?php echo $item->bio?></p>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card" style="box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);">
      <div class="card-body">
      <h5 class="card-header">#Education</h5>
        <br>
        <span class="badge badge-pill badge-light">School Name</span>
        <p class="card-text"><?php echo $item->education->school_name?></p>
        <span class="badge badge-pill badge-light">Graduation Time</span>
        <p class="card-text"><?php echo $item->education->graduation_time?></p>
    </div>
    </div>
  </div>
<div class="col-sm-4">
    <div class="card" style="box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);">
      <div class="card-body">
      <h5 class="card-header">#Career</h5>
        <br>
        <span class="badge badge-pill badge-light">Position</span>
        <p class="card-text">PM</p>
        <span class="badge badge-pill badge-light">Company</span>
        <p class="card-text"><?php echo $item->career->company_name?></p>
        <span class="badge badge-pill badge-light">Starting From</span>
        <p class="card-text"><?php echo $item->career->starting_from?></p>
        <span class="badge badge-pill badge-light">Ending In</span>
        <p class="card-text"><?php echo $item->career->ending_in?></p>
    </div>
    </div>
  </div>
</div>
  <br>
  <br>
  <br>
  <button type="submit" name="case" value=5 class="btn btn-outline-danger btn-block">Logout</button>
  </form>  
  <br>
    <?php
        }else{
    ?>
        <h1>Failed To Sign In!</h1>
    <?php }?>
</body>
</html>
