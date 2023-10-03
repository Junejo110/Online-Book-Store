<?php
include "../Header.php";
include "../Db_conn.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
// chech if author category is submitted
   if (isset($_POST['category_name'])) {
    // get data From get and post and store it in var
    $name = $_POST['category_name'];

    
    
    
        // simple Form validation   
        if (empty($name)) {
        $em = "The Category name is required";
        header("Location: ../Add_category.php?error=$em");
        exit();
       }else {
        // INSERT INTO DATABASE
        $sql = "INSERT INTO categories (name) VALUES (?) ";
        $stmt = $conn -> prepare($sql);
        $res = $stmt ->execute([$name]);
        
        // if there is no error while inserting data
        if ($res) {
                 // Error msg

                 $sm = "Successfully Created..!";
                 header("Location: ../Add_category.php?success=$sm");
                 exit();
            
        }else {
                // Error msg

            $em = "Unknown Error Occured..!";
            header("Location: ../Add_category.php?error=$em");
            exit();
        }
       }






   }else {
    header("Location: ../Admin.php");
    exit();
   }



?>






<?php
} else {
    header("Location: ../Login.php");
    exit(); // Exit to prevent further code execution
}

include "../footer.php";
?>
