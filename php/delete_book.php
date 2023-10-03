<?php
include "../Header.php";
include "../Db_conn.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
// chech if book id is set
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
        $sql2 = "SELECT * FROM books WHERE id= ? ";
        $stmt2 = $conn -> prepare($sql2);
        $stmt2 ->execute([$id]);
        $the_book = $stmt2 ->fetch();

        if ($stmt2->rowCount()>0) {
            // Delete THE book from DATABASE
        $sql = "DELETE FROM books WHERE id= ? ";
        $stmt = $conn -> prepare($sql);
        $res = $stmt ->execute([$id]);
        
        // if there is no error while deleting data
        if ($res) {
            //   delete the current book cover and file
                 $cover = $the_book['cover'];
                 $file = $the_book['file'];
                 $c_b_c="../uploads/cover/$cover";
                 $c_f="../uploads/files/$file";

                 unlink($c_b_c);
                 unlink($c_f);
 

                 // Success msg

                 $sm = "Successfully Deleted..!";
                 header("Location: ../Admin.php?success=$sm");
                 exit();
            
        }else {
                // Error msg

            $em = "Unknown Error Occured..!";
            header("Location: ../Admin.php?error=$em");
            exit();
        }
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
