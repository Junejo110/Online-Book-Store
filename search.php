<?php
include "Header.php";
include "Db_Conn.php";
session_start();
// if search key is not set or empty

if (!isset($_GET['key']) || empty($_GET['key'])) {
    header("Location:index.php");
    exit;
}

$key=$_GET['key'];

 // Books Helper function
 include "func-book.php";
 $books = search_books($conn,$key);

 // Author Helper function
 include "func_auth.php";
 $authors = get_all_authors($conn);

 // Categories Helper function
 include "func_category.php";
 $categories = get_all_categories($conn);


?>
  <img src="./images/Najaf.jpg" alt="bgimage" class="bg-img">
  <nav class="navbar   navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./images/Moula-Ali.png" class="logo">The Wisdom of Moula Ali</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Me</a>
          </li>
          <li class="nav-item">
            <?php if (isset($_SESSION['user_id'])){
                ?>
                <a class="nav-link" href="Admin.php">Admin</a>
          <?php  }else{
                
          ?>
            <a class="nav-link" href="Login.php">Login</a>
            <?php  
                
            } ?>
          </li>
      </div>
    </nav>
    <br>
    <h6 class="center-container">Search Results For <b><i><?=$key?></i></b>
    </h6>  
     <div class="center-container d-flex pt-3">
     <?php
     if ($books == 0) {?>
     <div class='alert alert-danger alert-dismissible fade show text-center pdf-list' role='alert'>
            <img src="./uploads/img/empty_box.png" width="150"><br>
                <strong>Sorry!</strong> The result for <b>"<?=$key?>"</b> didn't match to any record in the database
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
 <?php } else {
    
 
 ?>

<div class="pdf-list d-flex flex-wrap">
    <?php foreach ($books as $book) { ?>
      <a  href="book_details.php?id=<?= $book['id'] ?>"style="text-decoration: none;" class="card-link">
    <div class="card m-1">
        <img src="uploads/cover/<?= $book['cover'] ?>" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title"><?=$book['title']?></h5>
            <p class="card-text">
                <br><i><b>By:<?php foreach ($authors as $author) { 
                    if ($author['id'] == $book ['author_id']) {
                       echo  $author['name'];
                    }
                    ?>
               <?php } ?>
                <br>
            </b></i>
            <?= $book['description']?>
            <br>
            <i><b>Category:<?php foreach ($categories as $category) { 
                    if ($category['id'] == $book ['category_id']) {
                       echo  $category['name'];
                    }
                    ?>
               <?php } ?>
                <br>
            </b></i>
            </p>
            <a href="uploads/files/<?=$book['file']?>" class="btn btn-primary">Open</a>
            <a href="uploads/files/<?=$book['file']?>" class="btn btn-success" download="<?=$book['title']?>">Download</a>
        </div>
    </div>
    <?php } ?>
</div>
<?php
}?>
    </div>
  </div>


<?php
include "footer.php";
?>
