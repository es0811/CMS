<?php
require_once('includes/db.php');
require_once('includes/function.php');
require_once('includes/sessions.php')
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Blog Page</title>
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
          <a href="#" class='nav-link'>Home</a>
        </li>

        <li class='nav-item'>
          <a href="posts.php" class='nav-link'>About Us</a>
        </li>

        <li class='nav-item'>
          <a href="blog.php" class='nav-link'>Blog</a>
        </li>

        <li class='nav-item'>
          <a href="#" class='nav-link'>Contact Us</a>
        </li>

        <li class='nav-item'>
          <a href="#" class='nav-link'>Features</a>
        </li>

        </ul>

        <ul class='navbar-nav ml-auto'>
          <form class="form-inline d-none d-sm-block" action="blog.php">
            <div class="input-group">
              <input class='form-control mr-2' type="text" name="Search" placeholder="Search Here"value="">
              <button class="btn btn-primary" name="searchbutton">Search</button>

            </div>


          </form>

        </ul>
      </div>
    </div>
  </nav>

  </div>

<div class="container">
  <div class="row mt-4">
    <div class="col-sm-8">
      <h1>The Complete Responsive CMS Blog</h1>
      <h1 class='lead'>The Complete blog by using php by Eshita</h1>
<?php
      if(isset($_GET['searchbutton'])){
        $search=$_GET['Search'];
        $sql='SELECT * FROM post
        WHERE datetime LIKE :search OR title LIKE :search OR category LIKE :search OR post LIKE :search';
        $stmt=$ConnectingDB->prepare($sql);
        $stmt->bindValue(':search','%'.$search.'%');
        $stmt->execute();
      }
      else
      {

        $postidurl=$_GET['id'];
        if(!isset($postidurl)){
          $_SESSION['ErrorMessage']='Bad Request';
          Redirect_to('Blog.php');
        }
        else {
          $_SESSION['ErrorMessage']='';
        }

        $sql="SELECT * from post WHERE id='$postidurl'";
        $stmt=$ConnectingDB->query($sql);
      }

      while($DataRows=$stmt->fetch()){
        $postid=$DataRows['id'];
        $datetime=$DataRows['datetime'];
        $title=$DataRows['title'];
        $category=$DataRows['category'];
        $author=$DataRows['author'];
        $image=$DataRows['image'];
        $post=$DataRows['post'];

       ?>
       <div class="card ">
         <img src="uploads/<?php echo htmlentities($image) ?>" style='max-height:500px' class='img-fluid card-imf-top' alt="">
         <div class="card-body">
           <h4 class=card-title><?php echo htmlentities($title);  ?></h4>
           <small class='text-muted'>Witten By <?php echo htmlentities($author) ?> on <?php echo $datetime ?></small>
           <span style='float:right' class='badge badge-dark text-dark'>Comments</span>
           <hr>
           <p class=card-text><?php
            echo htmlentities($post); ?></p>

         </div>
        </div>
        <?php } ?>

    </div>
    <div class="col-sm-4">

    </div>

  </div>

</div>
<br>

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
