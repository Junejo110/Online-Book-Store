<?php
// get all author function
function get_all_authors($conn){
    $sql = "SELECT * FROM authors";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $authors = $stmt->fetchAll();
    } else {
        $authors = 0;
    }
    return $authors;
}
// Get Author by id
function get_author($conn, $id){
    $sql = "SELECT * FROM authors WHERE id =?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $author= $stmt->fetch();
    } else {
        $author= 0;
    }
    return $author;
}
function get_author_by_id($conn, $authorId) {
    $sql = "SELECT * FROM authors WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $authorId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
