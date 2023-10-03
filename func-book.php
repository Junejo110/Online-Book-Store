<?php
function get_all_books($conn){

    $sql = "SELECT * FROM books ORDER BY id DESC";

    $stmt = $conn -> prepare($sql);
    $stmt -> execute();

    if ($stmt ->rowCount()>0) {
        $books =$stmt ->fetchAll();
    }else {
        $books= 0;
    }
   return $books;


}

// get books by ID function
function get_book($conn,$id){

    $sql = "SELECT * FROM books WHERE id=?";

    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$id]);

    if ($stmt ->rowCount()>0) {
        $book =$stmt ->fetch();
    }else {
        $book= 0;
    }
   return $book;


}

// search Books 
function search_books($conn, $key) {
    $keyWords = explode(" ", $key);
    $likeClauses = [];

    foreach ($keyWords as $word) {
        $likeClauses[] = "title LIKE :word OR description LIKE :word";
    }

    $sql = "SELECT * FROM books WHERE " . implode(" OR ", $likeClauses);

    $stmt = $conn->prepare($sql);

    foreach ($keyWords as $word) {
        $word = "%{$word}%";
        $stmt->bindValue(':word', $word, PDO::PARAM_STR);
    }

    $stmt->execute();
    $books = $stmt->fetchAll();

    return $books;
}


// get books by category
function get_book_by_category($conn,$id){

    $sql = "SELECT * FROM books WHERE category_id=?";

    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$id]);

    if ($stmt ->rowCount()>0) {
        $books =$stmt ->fetchAll();
    }else {
        $books= 0;
    }
   return $books;


}
function get_book_by_id($conn, $bookId) {
    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>