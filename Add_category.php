<?php
include "./Header.php";
include "./Db_conn.php";

session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
?>
<img src="./images/Najaf.jpg" alt="bgimage" class="bg-img">
<nav class="navbar   navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="./images/Moula-Ali.png" height="80px">The Wisdom of Moula Ali</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="Admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Add-book.php">Add-book</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="add-category.php">Add Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Add_author.php">Add-Author</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Logout.php">Log-out</a>
          </li>
      </div>
    </div>
  </nav>
</div>


<div class="container mt-5">
<form action="./php/Add_category.php" method="POST" class="shadow p-4 rounded " style="max-width:60rem;">
<h2 class="text-center display-4 fs-2">Add New Category</h2>
    <!-- Error MSg -->
    <?php
if (isset($_GET['error'])) {  ?>
<div class="alert alert-danger" role="alert">
    <?= htmlspecialchars($_GET['error']);
    ?>
</div>
<?php
}
?>
<!-- success msg -->
<?php
if (isset($_GET['success'])) {  ?>
<div class="alert alert-success" role="alert">
    <?= htmlspecialchars($_GET['success']);
    ?>
</div>
<?php
}
?>

<label for="category" class="form-label">Category Name</label>
    <input type="text" class="form-control" id="category" name="category_name"><br>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>

</div>






<?php
} else {
  header("Location:../Login.php");
  exit();
}
?>





  


  <?php 
  
  include "./footer.php"
  
  ?>
