<?php
include "../Header.php";
include "../Db_conn.php";
require_once "func_file_upload.php";

session_start();
// if admin is logged in 
if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {

    // if all the input fields are filled 
    if (
        isset($_POST['book_title']) &&
        isset($_POST['book_Description']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['file'])
    ) {
        // get data From POST and store them in var
        $title = $_POST['book_title'];
        $description = $_POST['book_Description'];
        $author = $_POST['book_author'];
        $category = $_POST['book_category'];

        $user_input = 'title='.$title.'$category_id='.$category.'&desc'.$description.'&author_id='.$author;

        // Book Cover Uploading
        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

        // if error occurred while uploading book cover
        if ($book_cover['status'] == 'error') {
            $em = $book_cover['data'];
            // Redirect to add-book.php and passing error msg & user input 
            $user_input = 'title=' . $title . '&category=' . $category . '&desc=' . $description;
            header("Location:../Add_book.php?error=$em&$user_input");
            exit;
        } else {
            // file Uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

            // if error occurred while uploading the book file
            if ($file['status'] == 'error') {
                $em = $file['data'];
                // Redirect to add-book.php and passing error msg & user input 
                $user_input = 'title=' . $title . '&category=' . $category . '&desc=' . $description;
                header("Location:../Add_book.php?error=$em&$user_input");
                exit;
             } else {
               //Getting the new file name and book cover name
               $file_URL = $file['data'];
               $book_cover_URL = $book_cover['data'];

                // Insert the data into the database
                $sql = "INSERT INTO books (title, author_id, description, category_id, cover, file) VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL]);
            
                // if there is no error while inserting data
                if ($res) {
                    // Success message
                    $sm = "The book was successfully created!";
                    header("Location:../Add-book.php?success=$sm");
                    exit();
                } else {
                    // Error message
                    $em = "Unknown Error Occurred.";
                    header("Location:../Add-book.php?error=$em");
                    exit();
                }
            }           
        }
    } else {
        header("Location: ../Admin.php");
        exit();
    }
} else {
    header("Location: ../Login.php");
    exit(); // Exit to prevent further code execution
}

include "../footer.php";
?>
