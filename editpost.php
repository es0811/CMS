<?php
require_once('includes/db.php');
require_once('includes/function.php');
require_once('includes/sessions.php')
 ?>

 <?php
$SQP=$_GET['id'];

if(isset($_POST['submit'])){
  $admin='Eshita';
  date_default_timezone_set('America/Los_Angeles');
  $datetime=strftime('%B-%d-%Y %H:%M:%S',time());
  $title=$_POST['title'];
  $category=$_POST['category'];
  $image=$_FILES['image']['name'];
  $target='uploads/'.basename($_FILES['image']['name']);
  $post=$_POST['postdesc'];



  if(empty($title)){
    $_SESSION['ErrorMessage']='Title cannot be empty!';
    redirect_to('post.php');
  }
  else if(strlen($title)<5){
    $_SESSION['ErrorMessage']='Post title should be greater than 5 characters';
    redirect_to('post.php');
  }
  else if(strlen($post)>999){
    $_SESSION['ErrorMessage']='Post description should be less than 1000 characters';
    redirect_to('post.php');
  }
  else {
  //Query to insert the data into the database
  if(empty($image)){
    $sql="UPDATE post SET title='$title', category='$category', post='$postdesc' WHERE id='$SQP'";
      $execute=$ConnectingDB->query($sql);
  }
  else{
    $sql="UPDATE post SET title='$title', category='$category', image='$image', post='$postdesc' WHERE id='$SQP'";
      $execute=$ConnectingDB->query($sql);
  }


  move_uploaded_file($_FILES['image']['tmp_name'], $target);
  if($execute){
    $_SESSION['SuccessMessage']='Post with id: '.$SQP.' Updated Successfully '.$title;
      redirect_to('post.php');
  }
  else {
    $_SESSION['ErrorMessage']='Something went wrong. Please try again';
    redirect_to('post.php');
  }
  }

}


  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>EditPost</title>
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
        <h1><i class="fa-solid fa-pen-to-square" style="color:yellow "></i>Edit Post</h1>
    </div>
  </div>
  </header>
<section class='container py-2 mb-4'>
  <div class="row">
    <div class=" offset-lg-1 col-lg-10">
      <?php
      echo errormessage();
      echo successmessage();

      $sql="SELECT* FROM post WHERE id='$SQP'";
      $stmtPost=$ConnectingDB->query($sql);
      while($DataRows=$stmtPost->fetch()){
        $TitleToUpdate=$DataRows['title'];
        $CategoryToUpdate=$DataRows['category'];
        $ImageToUpdate=$DataRows['image'];
        $PostToUpdate=$DataRows['post'];

      }

       ?>
      <form class="" action="editpost.php?id=<?php echo $SQP;  ?>" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">

            <div class="card-body bg-dark">
              <div class="form-group">

                <label for="title"><span class='fieldinfo'>Post Title:</span></label>
                <input class='form-control' type="text" name="title" id='title' value="<?php echo $TitleToUpdate ?>">
              </div>

              <div class="form-group">
                <span class='fieldinfo'>Existing Category:</span>
                <?php echo $CategoryToUpdate ?>
                <br>
                <label for="categorytitle"><span class='fieldinfo'>Choose Category:</span></label>
                <select class="form-control" id='categorytitle' name="category">
                  <?php
                  //fetching all Categories
                  $sql='SELECT * FROM category';
                  $stmt=$ConnectingDB->query($sql);
                  while($DataRows=$stmt->fetch()){
                    $id=$DataRows['id'];
                    $title=$DataRows['title'];

                   ?>
                  <option ><?php echo $title ?></option>
                  <?php
                  }
                  ?>

                </select>
                <br>
                <span class='fieldinfo'>Existing Image:</span>
                <img class='mb-1' src="uploads/<?php echo $ImageToUpdate; ?>"width="170px";height="70px">
                <br>
                <div class="input-group mb-2">
                <input type="file" name="image" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload Image</label>
                </div>

                <label class='fieldinfo' for="post"><span>Post:</span></label>
                <textarea class='form-control'id='post' name="postdesc" rows="8" cols="80">
                  <?php echo $PostToUpdate ?>
                </textarea>

                </div>

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
