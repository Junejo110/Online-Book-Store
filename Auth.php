<?php 
session_start();


if (isset($_POST['Email']) && 
	isset($_POST['Password'])) {
    
    # Database Connection File
	include "Db_conn.php";
    
    # Validation helper function
	include "./php/Func-validation.php";
	
	/** 
	   Get data from POST request 
	   and store them in var
	**/

	$Email = $_POST['Email'];
	$Password = $_POST['Password'];

	# simple form validation

	$text = "Email";
	$location = "Login.php";
	$ms = "error";
    is_empty($Email, $text, $location, $ms, "");

    $text = "Password";
	$location = "Login.php";
	$ms = "error";
    is_empty($Password, $text, $location, $ms, "");

    # search for the Email
    $sql = "SELECT * FROM admin 
            WHERE Email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$Email]);

    # if the Email is exist
    if ($stmt->rowCount() === 1) {
    	$user = $stmt->fetch();

    	$user_id = $user['id'];
    	$user_Email = $user['Email'];
    	$user_password = $user['Password'];
        
    	if ($Email === $user_Email) {
    		if (password_verify($Password, $user_password)) {
    			$_SESSION['user_id'] = $user_id;
    			$_SESSION['user_Email'] = $user_Email;
    			header("Location:Admin.php");
    		}else {
    			# Error message
    	        $em = "Incorrect User name or Password";
    	        header("Location:Login.php?error=$em");
    		}
    	}else {
    		# Error message
    	    $em = "Incorrect User name or Password";
    	    header("Location:Login.php?error=$em");
    	}
    }else{
    	# Error message
    	$em = "Incorrect User name or Password";
    	header("Location:Login.php?error=$em");
    }

}else {
	# Redirect to "Login.php"
	header("Location:Login.php?error=$em");
}