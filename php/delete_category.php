<?php
include "../Header.php";
include "../Db_conn.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
// chech if category id is set
   if (isset($_GET['id'])) 
{



    
    // get data From get and GET and store it in var
    $id = $_GET['id'];

    
    
    
        // simple Form validation   
        if (empty($id)) {
        $em = "Un-known Error Occured";
        header("Location: ../Admin.php?error=$em");
        exit();
       }else {
        //   Get Book from database
         

            // Delete THE category from DATABASE
        $sql = "DELETE FROM categories WHERE id= ? ";
        $stmt = $conn -> prepare($sql);
        $res = $stmt ->execute([$id]);
        
        // if there is no error while deleting data
        if ($res) {
                 // Success msg

                 $sm = "Successfully Deleted..!";
                 header("Location: ../Admin.php?success=$sm");
                 exit();
            
       
        }else {
            $em = "Un-known Error Occured";
            header("Location: ../Admin.php?error=$em");
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
