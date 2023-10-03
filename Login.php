<?php
include "Header.php";
session_start();

$logoutMessage = isset($_SESSION['logout_message']) ? $_SESSION['logout_message'] : '';
unset($_SESSION['logout_message']);

if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_Email'])) {

?>
<img src="./images/Najaf.jpg" alt="Image" class="bg"> 

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">

<form action="Auth.php" method="POST"
class="p-5 rounded shadow" style="max-width: 30rem; width:100%">

<h2 class="text-center display-5 pb-5">Login With Your Email And Pass</h2>

<?php
if (isset($_GET['error'])) {  ?>
<div class="alert alert-danger" role="alert">
    <?= htmlspecialchars($_GET['error']);
    ?>
</div>
<?php
}
?>
<?php if (!empty($logoutMessage)) { ?>
        <div class="logout-message">
            <?php echo $logoutMessage; ?>
        </div>
    <?php } ?>

  <div class="mb-3 mt-5">
    <label for="Email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp">
      <div class="mb-3">
    <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control" id="Password" name="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <a href="index.php">Browse More</a>
</form>
</div>
<?php
} else {
    header("Location: Admin.php");
    exit();
}
?>