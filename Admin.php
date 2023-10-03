<?php
include "Header.php";
include "Db_conn.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {

    // Check if there is a success message in the URL parameter
    if (isset($_GET['success'])) {
        $success_message = $_GET['success'];
    }

    // Check if there is an error message in the URL parameter
    if (isset($_GET['error'])) {
        $error_message = $_GET['error'];
    }

    // Books Helper function
    include "func-book.php";
    $books = get_all_books($conn);

    // Author Helper function
    include "func_auth.php";
    $authors = get_all_authors($conn);

    // Categories Helper function
    include "func_category.php";
    $categories = get_all_categories($conn);

?>

<!-- <img src="./images/Najaf.jpg" alt="bgimage" class="bg-img">-->
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
                    <a class="nav-link active" href="Admin.php">Admin</a>
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
<form action="search.php" method="get">
<div class="center-container">
  <div class="input-group my-5" style="width: 100%; max-width: 30rem;">
    <input type="text" class="form-control" name="key" placeholder="Search Book Here" aria-label="Search Book.." aria-describedby="basic-addon2">
    <button  class="input-group-text btn btn-primary" id="basic-addon2"><img src="./uploads/img/search.png" width="40"></button >
  </div>
</div>
<div class="container mt-4">
    <!-- Add this part to display the success message -->
    <?php if (isset($success_message)): ?>
        
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Your Record has Been Deleted Successfully.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
    <?php endif; ?>

    <!-- Add this part to display the error message -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger mt-4">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <!-- Display the session message for no books available -->
    <form>
    <div class="container mt-4">
        <!-- <List of All Books> -->
            
        <h1 class="text-center">All Books</h1>
        <?php if (empty($books)): ?>
            <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <img src="./uploads/img/empty_box.png" width="150"><br>
                <strong>Sorry!</strong> No Book Available.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php else: ?>
            <table class="table table-bordered shadow">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($books as $book) {
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td>
                                <img width="150" src="uploads/cover/<?= $book['cover'] ?>" alt="cover">
                                <a class="d-block text-center" href="uploads/files/<?= $book['file'] ?>">
                                    <?= $book['title'] ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                if (empty($authors)) {
                                    echo "undefined";
                                } else {
                                    foreach ($authors as $author) {
                                        if ($author['id'] == $book['author_id']) {
                                            echo $author['name'];
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $book['description'] ?></td>
                            <td>
                                <?php
                                if (empty($categories)) {
                                    echo "undefined";
                                } else {
                                    foreach ($categories as $category) {
                                        if ($category['id'] == $book['category_id']) {
                                            echo $category['name'];
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit_book.php?id=<?= $book['id'] ?>" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <a href="php/delete_book.php?id=<?= $book['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="container mt-5">
        <h1 class="text-center">All Categories</h1>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Categories</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
                    <img src="uploads/img/sad.png" width="100"><br>
                        <strong>Sorry!</strong> No Category Available.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                <?php else: ?>
                    <?php
                    $j=0;
                    foreach ($categories as $category) {
                        $j++;
                    ?>
                    <tr>
                        <td><?=$j?></td>
                        <td><?=$category['name']?></td>
                        <td>
                            <a href="edit_category.php?id=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                        <a href="./php/delete_category.php?id=<?=$category['id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h1 class="text-center ">All Authors</h1>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Authors</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($authors)): ?>
                    <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
                    <img src="uploads/img/book.png" width="100"><br>
                        <strong>Sorry!</strong> No Author Available.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                <?php else: ?>
                    <?php
                    $k=0;
                    foreach ($authors as $author) {
                        $k++;
                    ?>
                    <tr>
                        <td><?=$k?></td>
                        <td><?=$author['name']?></td>
                        <td>
                            <a href="edit_author.php?id=<?=$author['id']?>" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                        <a href="./php/delete_author.php?id=<?=$author['id']?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
                </form>
<?php
// Rest of your Admin page code
} else {
    header("Location: Login.php");
    exit();
}
include "footer.php";
?>
