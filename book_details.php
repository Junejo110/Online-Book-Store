<?php
include "Header.php";
include "Db_Conn.php";
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Include helper functions
include "func-book.php";
include "func_auth.php";
include "func_category.php";

// Retrieve book details
$book = get_book_by_id($conn, $id);
$author = get_author_by_id($conn, $book['author_id']);
$category = get_category_by_id($conn, $book['category_id']);

?>
<!-- nav bar here -->
<img src="./images/Najaf.jpg" alt="bgimage" class="bg-img">
    <nav class="navbar navbar-dark bg-dark">
      
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
    <h1 class="dispaly-4 p-3 fs-3">
        <button class="btn btn-success"><a href="index.php" class="nd">

            <img src="uploads/img/back.png" width="30">
        </a></button>
      </h1>

<!-- Display book details -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img  style="width: 300px;" src="uploads/cover/<?= $book['cover'] ?>" class="img-fluid" alt="<?= $book['title'] ?>">
        </div>
    
        <div class="book-box mt-2">
            <h2><?= $book['title'] ?></h2>
            <p><strong>Author:</strong> <?= $author['name'] ?></p>
            <p><strong>Category:</strong> <?= $category['name'] ?></p>
            <p><?= $book['description'] ?></p>
            <a href="uploads/files/<?= $book['file'] ?>" class="btn btn-primary">Open</a>
            <a href="uploads/files/<?= $book['file'] ?>" class="btn btn-success" download="<?= $book['title'] ?>">Download</a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
