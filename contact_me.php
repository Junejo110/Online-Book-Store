<?php
include "Header.php";
?>
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
            <a class="nav-link active" href="contact_me.php">Contact Me</a>
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
  
        <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row mb-5">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-map-marker"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Address:</span> A-1719 Gulshan-e-hadeed phase 2 bin qasim town karachi</p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-phone"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Phone:</span> <a href="tel://1234567920">+92-314-2044014</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-paper-plane"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Email:</span> <a href="mailto:info@yoursite.com">aa7205378@gmail.com</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-globe"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Website</span> <a href="#">www.Adnan_ali.com</a></p>
				          </div>
			          </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5">
				      		<div id="form-message-success">
				      		</div>
<section class="contact-me">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Me</h2>
                <p>Hello! I'm Adnan Ali, a skilled and experienced web and app developer. Whether you're looking to create a stunning website, a user-friendly mobile app, or need technical expertise on your digital projects, I'm here to help.</p>
                <p>With a strong background in coding, design, and problem-solving, I'm passionate about bringing innovative ideas to life through clean, efficient, and user-focused solutions.</p>
                <p>Let's work together to turn your vision into reality. Feel free to reach out to me using the contact details below:</p>
            </div>
            <div class="col-md-6">
                <div class="contact-details">
                    <div class="contact-item">
                        
                        <p>Email: <a href="mailto:aa7205378@gmail.com">aa7205378@gmail.com</a></p>
                    </div>
                    <div class="contact-item">
                        
                        <p>Phone: <a href="tel:+1234567890">0314-2044014</a></p>
                    </div>
                    <div class="contact-item">
                        
                        <p>Website: <a href="http://www.yourwebsite.com">www.Adnan_ali.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

								</div>
							</div>
							<div class="col-md-5 d-flex">
								<div class=" w-100 img" style="background-image: url(./uploads/img/IMG-20220114-WA0041.jpg);">
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



<?php
include "footer.php";
?>