<?php
include "Header.php";
include "Db_Conn.php";
session_start();

$key = isset($_GET['key']) ? $_GET['key'] : '';
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
  <div id="preloader">
   

</div>
<!-- <Just for delay content loading> -->
<iframe id="video-iframe" class="hidden-iframe" width="560" height="315" src="https://www.youtube.com/embed/Yf5d_Zx3AaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<iframe id="video-iframe" class="hidden-iframe" width="560" height="315" src="https://www.youtube.com/embed/Yf5d_Zx3AaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> 
<iframe id="video-iframe" class="hidden-iframe" width="560" height="315" src="https://www.youtube.com/embed/Yf5d_Zx3AaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<iframe id="video-iframe" class="hidden-iframe" width="560" height="315" src="https://www.youtube.com/embed/Yf5d_Zx3AaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<iframe id="video-iframe" class="hidden-iframe" width="560" height="315" src="https://www.youtube.com/embed/Yf5d_Zx3AaI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
            <a class="nav-link" href="about_us.php">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact_me.php">Contact Me</a>
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
    <form action="search.php" method="get"class="search-form">
  <div class="input-group my-2" style="width: 100%; max-width: 30rem;">
    <input type="text" class="form-control" name="key" placeholder="Search Book Here" aria-label="Search Book.." aria-describedby="basic-addon2">
    <button  class="input-group-text btn btn-primary" id="basic-addon2"><img src="./uploads/img/search.png" width="40"></button >
  </div>
    </form>
<br>
    <div class="center-container d-flex pt-3 card-container">
        <?php
        if ($books == 0) { ?>
          <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
            <img src="./uploads/img/empty_box.png" width="150"><br>
                <strong>Sorry!</strong> No Book Available.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php } else { ?>
            <div class="pdf-list d-flex flex-wrap">
                <?php
                $resultsPerPage = 4; 
                $totalResults = count($books);
                $totalPages = ceil($totalResults / $resultsPerPage);

                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $startIndex = ($currentPage - 1) * $resultsPerPage;

                $booksOnPage = array_slice($books, $startIndex, $resultsPerPage);

                foreach ($booksOnPage as $book) { ?>
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
                <br><br>
            </b></i>
            </p>
            <a href="uploads/files/<?=$book['file']?>" class="btn btn-primary">Open</a>
            <a href="uploads/files/<?=$book['file']?>" class="btn btn-success" download="<?=$book['title']?>">Download</a>
        </div>
    </div>
                </a>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="category"style="margin-left: 150px;">
        <!-- list of categories -->
        <div class="list-group">
          <?php
          if ($categories==0){
            //  do Nothing
          } else{

          }
          ?>
           <a href="#" class="list-group-item list-group-item-action active"><b>Category</b></a>
           <?php 
           foreach ($categories as $category) { ?>
                     
           <a href="category.php?id=<?= $category['id']?>"class="list-group-item list-group-item-action"><?= $category['name']?></a>
           <?php  }
           ?>
        </div>



      </div>
    </div>
    <!-- Pagination links at the end of displayed search results -->
    <div class="center-container mt-4">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
                    <li class="page-item <?php if ($currentPage == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <script>

  var loader = document.getElementById("preloader");
  window.addEventListener("load" ,function(){
   loader.style.display = "none";
  })
</script>
      
<?php
include "footer.php";
?>
