<?php
include "../Header.php";
include "../Db_conn.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
// chech if author name is submitted
   if (isset($_POST['author_name'])&& 
       isset($_POST['author_id'])) 
{



    
    // get data From get and post and store them in var
    $name = $_POST['author_name'];
    $id = $_POST['author_id'];

    
    
    
        // simple Form validation   
        if (empty($name)) {
        $em = "The Author name is required";
        header("Location: ../edit_author.php?error=$em&id=$id");
        exit();
       }else {
        // UPDATE THE DATABASE
        $sql = "UPDATE authors SET name =? WHERE id= ? ";
        $stmt = $conn -> prepare($sql);
        $res = $stmt ->execute([$name,$id]);
        
        // if there is no error while inserting data
        if ($res) {
                 // Error msg

                 $sm = "Successfully Updated..!";
                 header("Location: ../edit_author.php?success=$sm&id=$id");
                 exit();
            
        }else {
                // Error msg

            $em = "Unknown Error Occured..!";
            header("Location: ../edit_author.php?error=$em&id=$id");
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
