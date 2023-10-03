<?php
include "../Header.php";
include "../Db_conn.php";
require_once "func_file_upload.php";

session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_Email'])) {
    // Check if all the input fields are filled
    if (
        isset($_POST['book_id']) &&
        isset($_POST['book_title']) &&
        isset($_POST['book_Description']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['file']) &&
        isset($_POST['current_cover']) &&
        isset($_POST['current_file'])
    ) {
        // Get data from POST and store them in variables
        $id = $_POST['book_id'];
        $title = $_POST['book_title'];
        $description = $_POST['book_Description'];
        $author = $_POST['book_author'];
        $category = $_POST['book_category'];

        // Get current cover and file names and store them in variables
        $current_cover = $_POST['current_cover'];
        $current_file = $_POST['current_file'];

        // If admin tries to update book cover
        if (!empty($_FILES['book_cover']['name'])) {
            // If admin also tries to update both cover and file
            if (!empty($_FILES['file']['name'])) {
                // Delete the current cover and file
                $c_p_book_cover = "../uploads/cover/" . $current_cover;
                $c_p_file = "../uploads/files/" . $current_file;
                if (file_exists($c_p_book_cover)) {
                    unlink($c_p_book_cover);
                }
                if (file_exists($c_p_file)) {
                    unlink($c_p_file);
                }

                // Book Cover Uploading
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                // Book File Uploading
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $path = "files";
                $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

                // If an error occurs while uploading
                if ($book_cover['status'] == 'error' || $file['status'] == 'error') {
                    $em = $book_cover['data'];
                    // Redirect to edit-book.php and pass error message & id
                    $user_input = 'title=' . $title . '&category=' . $category . '&desc=' . $description;
                    header("Location:../edit_book.php?error=$em&id=$id");
                    exit;
                } else {
                    // Getting the new file name and the new book cover name
                    $file_URL = $file['data'];
                    $book_cover_URL = $book_cover['data'];
                    // Update both data and file paths
                    $sql = "UPDATE books SET 
                            title=?, 
                            author_id=?,
                            description=?,
                            category_id=?,
                            cover=?,
                            file=? 
                            WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $category, $book_cover_URL, $file_URL, $id]);
                    // If there is no error while updating data
                    if ($res) {
                        $sm = "Successfully Updated..!";
                        header("Location: ../edit_book.php?success=$sm&id=$id");
                        exit();
                    } else {
                        $em = "Unknown Error Occurred..!";
                        header("Location: ../edit_book.php?error=$em&id=$id");
                        exit();
                    }
                }
            } else {
                // Update just the book cover
                // Book Cover Uploading
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                // If an error occurs while uploading
                if ($book_cover['status'] == 'error') {
                    $em = $book_cover['data'];
                    // Redirect to edit-book.php and pass error message & id
                    $user_input = 'title=' . $title . '&category=' . $category . '&desc=' . $description;
                    header("Location:../edit_book.php?error=$em&id=$id");
                    exit;
                } else {
                    // Delete the current cover
                    $c_p_book_cover = "../uploads/cover/" . $current_cover;
                    if (file_exists($c_p_book_cover)) {
                        unlink($c_p_book_cover);
                    }

                    // Getting the new book cover name
                    $book_cover_URL = $book_cover['data'];
                    // Update the data and book cover path
                    $sql = "UPDATE books SET 
                            title=?, 
                            author_id=?,
                            description=?,
                            category_id=?,
                            cover=? 
                            WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $author, $description, $category, $book_cover_URL, $id]);
                    // If there is no error while updating data
                    if ($res) {
                        $sm = "Successfully Updated..!";
                        header("Location: ../edit_book.php?success=$sm&id=$id");
                        exit();
                    } else {
                        $em = "Unknown Error Occurred..!";
                        header("Location: ../edit_book.php?error=$em&id=$id");
                        exit();
                    }
                }
            }
        } elseif (!empty($_FILES['file']['name'])) {
            // Update just the file
            // Book File Uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

            // If an error occurs while uploading
            if ($file['status'] == 'error') {
                $em = $file['data'];
                // Redirect to edit-book.php and pass error message & id
                $user_input = 'title=' . $title . '&category=' . $category . '&desc=' . $description;
                header("Location:../edit_book.php?error=$em&id=$id");
                exit;
            } else {
                // Delete the current file
                $c_p_file = "../uploads/files/$current_file";
                if (file_exists($c_p_file)) {
                    unlink($c_p_file);
                }

                // Getting the new file name
                $file_URL = $file['data'];
                // Update just the file path
                $sql = "UPDATE books SET 
                        title=?, 
                        author_id=?,
                        description=?,
                        category_id=?,
                        file=? 
                        WHERE id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$title, $author, $description, $category, $file_URL, $id]);
                // If there is no error while updating data
                if ($res) {
                    $sm = "Successfully Updated..!";
                    header("Location: ../edit_book.php?success=$sm&id=$id");
                    exit();
                } else {
                    $em = "Unknown Error Occurred..!";
                    header("Location: ../edit_book.php?error=$em&id=$id");
                    exit();
                }
            }
        } else {
            // Update just the data
            $sql = "UPDATE books SET title=?, author_id=?, description=?, category_id=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $author, $description, $category, $id]);
            // If there is no error while updating data
            if ($res) {
                $sm = "Successfully Updated..!";
                header("Location: ../edit_book.php?success=$sm&id=$id");
                exit();
            } else {
                $em = "Unknown Error Occurred..!";
                header("Location: ../edit_book.php?error=$em&id=$id");
                exit();
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
