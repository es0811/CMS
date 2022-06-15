<?php
require_once('includes/db.php');
require_once('includes/function.php');
require_once('includes/sessions.php')
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Post</title>
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
        <h1><i class="fa-solid fa-blog" style="color:yellow"></i>Blog Post</h1>
      </div>
      <div class="col-lg-3 mb-2">
          <a href="newpost.php"class='btn btn-primary btn-block'><i class="fa-solid fa-pen-to-square"></i>Add New Post</a>
      </div>
      <div class="col-lg-3 mb-2">
          <a href="categories.php"class='btn btn-info btn-block'><i class="fa-solid fa-folder-plus"></i> Add New Category</a>
      </div>
      <div class="col-lg-3 mb-2">
          <a href="categories.php"class='btn btn-warning btn-block'><i class="fa-solid fa-user-plus"></i> Add New Admin</a>
      </div>

      <div class="col-lg-3 mb-2">
          <a href="comments.php"class='btn btn-success btn-block'><i class="fa-solid fa-check"></i> Add New Admin</a>
      </div>


    </div>
  </div>
  </header>
<br>
<section class='container py-2 mb=4'>
  <div class="row">
    <div class="col-lg-12">
      <?php
      echo errormessage();
      echo successmessage();
       ?>
      <table class='table table-striped table-hover'>
        <thead class='bg-dark' style="color:white">
          <tr>
            <th>$</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date & Time</th>
            <th>Author</th>
            <th>Banner</th>
            <th>Comments</th>
            <th>Action</th>
            <th>Live Preview</th>
          </tr>
        </thead>

        <?php
        $sql='SELECT * FROM post';
        $stmt=$ConnectingDB->query($sql);
        $sr=0;
        while($DataRows=$stmt->fetch()){
          $id=$DataRows['id'];
          $datetime=$DataRows['datetime'];
          $title=$DataRows['title'];
          $category=$DataRows['category'];
          $author=$DataRows['author'];
          $image=$DataRows['image'];
          $post=$DataRows['post'];
          $sr++;

         ?>
         <tbody>
           <tr>
             <td><?php echo $sr; ?></td>
             <td>
               <?php
                  if(strlen($title)>20)
                  {$title=substr($title,0,15);
                  $title=$title.'...';}

               echo $title; ?></td>
             <td><?php
             if(strlen($category)>18){
               $category=substr($category,0,18).'..';
             }

             echo $category; ?></td>
             <td><?php echo $datetime; ?></td>
             <td><?php
              if(strlen($author)>18){
                $author=substr($author,0,18).'..';
              }

              echo $author; ?></td>
             <td><img src="uploads/<?php echo $image; ?>"width="100px">
               </td>
             <td>Comments</td>
            <td><a href="editpost.php?id=<?php echo $id; ?>"><span class='btn btn-warning'>Edit</span></a>

            <a href="deletepost.php?id=<?php echo $id; ?>"><span class='btn btn-danger'>Delete</span></a></td>

            <td><a href="fullpost.php?id=<?php echo $id; ?>"target="_blank"><span class='btn btn-primary'>Live Preview</span></a></td>
           </tr>

         </tbody>

      <?php
        }
       ?>
      </table>

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
