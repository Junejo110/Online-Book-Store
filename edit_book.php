<?php
include "./Header.php";
include "./Db_conn.php";

session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {


      // if Book id is not set
      if (!isset($_GET['id'])) {
     // Redirect to admin.php page
      header("Location: Admin.php");
      exit;
     }
 
      $id = $_GET['id'];


    // Book Helper function
    include "func-book.php";
    $book = get_book($conn,$id);

    // if the id is invalid
    if ($book == 0) {
    // Redirect to admin.php page
    header("Location: Admin.php");
    exit;
    }

    // Categories Helper function
    include "func_category.php";
    $categories = get_all_categories($conn);

    // Author Helper function
    include "func_auth.php";
    $authors = get_all_authors($conn);

        
    



?>

    <img src="./images/Najaf.jpg" alt="bgimage" class="bg-img">
    <nav class="navbar   navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./images/Moula-Ali.png" height="80px">The Wisdom of Moula Ali</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="Add_category.php">Add Category</a>
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

    <div class="container mt-4">
        <form action="./php/edit_book.php" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded" >
            <h2 class="text-center display-4 fs-2">Edit Book</h2>
            <!-- Error MSg -->
           <!-- NO MSG -->
            <!-- success msg -->
            <?php
            if (isset($_GET['success'])) {  ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="book" class="form-label">Book title</label>
                <input type="text" hidden name="book_id" value="<?=$book['id'] ?>">
                <input type="text" class="form-control" name="book_title" value="<?=$book['title'] ?>" placeholder="Add-Book" required>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book Description</label>
                <input type="text" class="form-control" name="book_Description" value="<?=$book['description'] ?>"placeholder="Add-Description" required>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book Author</label>
                <select name="book_author" class="form-control" required>
                    <option value="0">Select Author</option>
                    <?php
                    if ($authors == 0) {
                        // Do Nothing
                    } else {
                        foreach ($authors as $author) { 
                          if ($book['author_id'] == $author['id']) {
                        
                      ?>
                            <option 
                            selected 
                            value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                    <?php }else { ?>
                      <option 
                            value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                   <?php } }}
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book Category</label>
                <select name="book_category" class="form-control" required>
                    <option value="0">Select category</option>
                    <?php
                    if ($categories == 0) {
                        // Do Nothing
                    } else {
                      foreach ($categories as $category) { 
                        if ($book['category_id'] == $category['id']) {
                      
                    ?>
                          <option 
                          selected 
                          value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                  <?php }else { ?>
                    <option 
                          value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                 <?php } }}
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book Cover</label>
                <input type="file" class="form-control" name="book_cover" placeholder="Add-cover">
                <input type="text" hidden name="current_cover" value="<?=$book['cover'] ?>">
                <a href="uploads/cover/<?=$book['cover']?>" class="link-dark" >Current Cover</a>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">File</label>
                <input type="file" class="form-control" name="file" placeholder="Add-file">
                <input type="text" hidden name="current_file" value="<?=$book['file'] ?>">
                <a href="uploads/files/<?=$book['file']?>" class="link-dark" >Current file</a>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Book</button>
            </div>
        </form>
    </div>

<?php
} else {
    header("Location:../Login.php");
    exit();
}

include "./footer.php";
?>
