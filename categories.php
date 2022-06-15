<?php
require_once('includes/db.php');
require_once('includes/function.php');
require_once('includes/sessions.php')
 ?>

 <?php
if(isset($_POST['submit'])){
  $admin='Eshita';
  date_default_timezone_set('America/Los_Angeles');
  $datetime=strftime('%B-%d-%Y %H:%M:%S',time());
  $category=$_POST['title'];

  if(empty($category)){
    $_SESSION['ErrorMessage']='All fields must be filled out!';
    redirect_to('categories.php');
  }
  else if(strlen($category)<=2){
    $_SESSION['ErrorMessage']='Category title should be greater than 2 characters';
    redirect_to('categories.php');
  }
  else if(strlen($category)>49){
    $_SESSION['ErrorMessage']='Category title should be greater than 2 characters';
    redirect_to('categories.php');
  }
  else {
  //Query to insert the data into the database
  $sql='INSERT INTO category(title,author,datetime)';
  $sql.='VALUES(:categoryName,:adminName,:datetime)';
  $stmt=$ConnectingDB->prepare($sql);
  $stmt->bindValue(':categoryName',$category);
  $stmt->bindValue(':adminName',$admin);
  $stmt->bindValue(':datetime',$datetime);
  $execute=$stmt->execute();
  if($execute){
    $_SESSION['SuccessMessage']='Category with id: '.$ConnectingDB->lastInsertId().' Added Successfully';
      redirect_to('categories.php');
  }
  else {
    $_SESSION['ErrorMessage']='Something went wrong. Please try again';
    redirect_to('categories.php');
  }
  }

}


  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Categories</title>
    <script src="https://kit.fontawesome.com/8e99dbf26b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">

  </head>
  <body>
    <div class='hello'>

  <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class="container">
      <a href="#" class='navbar-expand'>Eshita</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target='#navbarcollapseCMS' aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class="collapse navbar-collapse" id='navbarcollapseCMS'>


      <ul class='navbar-nav'>
        <li class='nav-item'>
          <a href="myprofile.php" class='nav-link'> <i class="fa-solid fa-user text-success"></i> My Profile</a>
        </li>

        <li class='nav-item'>
          <a href="dashboard.php" class='nav-link'>Dash Board</a>
        </li>

        <li class='nav-item'>
          <a href="posts.php" class='nav-link'>Posts</a>
        </li>

        <li class='nav-item'>
          <a href="categories.php" class='nav-link'>Categories</a>
        </li>

        <li class='nav-item'>
          <a href="manageadmins.php" class='nav-link'>Manage Admins</a>
        </li>

        <li class='nav-item'>
          <a href="comments.php" class='nav-link'>Comments</a>
        </li>

        <li class='nav-item'>
          <a href="liveblog.php" class='nav-link'>Live Blog</a>
        </li>



        <li class='nav-item'>
          <a href="logout.php" class="nav-link"><i class="fa-solid fa-user text-danger"></i> Logout</a>
        </li>

      </ul>
      </div>
    </div>
  </nav>

  </div>

  <header class='bg-dark text-white py-3'>
  <div class="container">
    <div class="row">
      <div class="col-md-12">

      </div>
        <h1><i class="fa-solid fa-pen-to-square" style="color:yellow "></i>Manage Categories </h1>
    </div>
  </div>
  </header>
<section class='container py-2 mb-4'>
  <div class="row">
    <div class=" offset-lg-1 col-lg-10">
      <?php
      echo errormessage();
      echo successmessage();
       ?>
      <form class="" action="categories.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1>Add New Category</h1>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"><span class='fieldinfo'>Category Title:</span></label>
                <input class='form-control' type="text" name="title" id='title' placeholder="Enter title here">
              </div>


              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="dashboard.php" class='btn btn-warning btn-block'><i class="fa-solid fa-backward"></i> Back To Dashboard</a>
                </div>

                <div class="col-lg-6 mb-2">
                  <button type="submit" name="submit" class='btn btn-success btn-block'><i class="fas fa-check">Publish</i>
                  </button>
                </div>

              </div>

            </div>

          </div>

        </div>

      </form>

    </div>

  </div>

</section>

    <div class="hello">
      <footer class='bg-dark text-white'>
        <div class="container">
          <div class="row">
            <div class="col">
            <p class='lead text-center'>Theme By||Eshita|<span id='year'></span> &copy; -----All rights Reserved.</p>
            <p class='text-center small'>This site is for study purpose only. Do not copy. <br>&trade; symbol</p>
          </div>
          </div>
        </div>
      </footer>
    </div>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
  $('#year').text(new Date().getFullYear());

  </script>
  </body>
</html>
