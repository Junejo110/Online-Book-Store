<?php
include "Header.php";
include "Db_Conn.php";
session_start();

$key = isset($_GET['key']) ? $_GET['key'] : '';


?>
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
            <a class="nav-link active" href="about_us.php">About us</a>
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

    
    <img class="center-image" src="./uploads/img/bismillah.png" width="20%">
    <!-- About Us Content -->
    <div class="about-us-container">
        <h2>About Us</h2>
        <p>Welcome to "The Wisdom of Moula Ali" website!</p>

        <h3>History and Inspiration</h3>
        <p>Our journey began with a deep reverence for Nahjul Balagha. Inspired by its profound wisdom and teachings, we embarked on a mission to create a platform that brings this treasure closer to those seeking knowledge.</p>

        <h3>Vision and Mission</h3>
        <p>Our vision is to provide a digital hub where individuals can explore, learn, and immerse themselves in the teachings of Nahjul Balagha. Through this platform, we aim to contribute to the wider dissemination of knowledge and foster a deeper understanding of its significance.</p>

        <h3>Founder/Team Information</h3>
        <p>Our dedicated team consists of individuals who share a common passion for preserving and sharing the wisdom of Nahjul Balagha. With backgrounds in [mention relevant backgrounds], we are driven by a collective motivation to make this timeless knowledge accessible to all.</p>

        <h3>Website Features</h3>
        <p>Our website offers a unique collection of Nahjul Balagha books, meticulously categorized to facilitate easy navigation. We take pride in providing a user-friendly experience that allows readers to explore these treasures with convenience.</p>

        <h3>Contributions and Collaboration</h3>
        <p>We express our heartfelt gratitude to the authors, scholars, and contributors who have enriched our collection. We welcome collaborations and contributions from visitors who share our passion for promoting knowledge.</p>

        <h3>Community Engagement</h3>
        <p>Our platform encourages community engagement through forums and discussions. We invite users to actively participate, exchange ideas, and collectively deepen their understanding of Nahjul Balagha.</p>

        <h3>Educational Value</h3>
        <p>The materials available on our website hold immense educational value. They offer insights into the teachings of Nahjul Balagha, enabling users to broaden their knowledge and gain a deeper perspective on related topics.</p>

        <h3>Contact Information</h3>
        <p>If you have any questions, suggestions, or contributions, feel free to reach out to us at [your contact email]. We value your feedback and look forward to connecting with you!</p>

        <h3>Call to Action</h3>
        <p>We invite you to explore our website, discover the wisdom of Nahjul Balagha, and join us on this journey of knowledge and enlightenment. Follow us on social media to stay updated!</p>
    </div>









<?php
include "footer.php";
?>
