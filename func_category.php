<?php

// GET_ALL_CATEGORIES

    function get_all_categories($conn){

    $sql = "SELECT * FROM categories";

    $stmt = $conn -> prepare($sql);
    $stmt -> execute();

    if ($stmt ->rowCount()>0) {
        $categories =$stmt ->fetchAll();
    }else {
        $categories= 0;
    }
   return $categories;


}

// get category by id

function get_category($conn , $id){

    $sql = "SELECT * FROM categories WHERE id = ?";

    $stmt = $conn -> prepare($sql);
    $stmt -> execute([$id]);

    if ($stmt ->rowCount()>0) {
        $category =$stmt ->fetch();
    }else {
        $category= 0;
    }
   return $category;


}
function get_category_by_id($conn, $categoryId) {
    $sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}




?>