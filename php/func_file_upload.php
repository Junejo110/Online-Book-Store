<?php
// file upload helper function

function upload_file($files , $allowed_exs , $path){
// get data and store them in var
 $file_name = $files['name'];
 $tmp_name = $files['tmp_name'];
 $error = $files['error'];


// if there is no error while uploading

if ($error === 0) {
    // get file extension stored in var
    $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
   
    // convert the file extension into lower case and store it in var 
    $file_ex_lc = strtolower ($file_ex);

    // check if the file extension in to lower case and store it in var
    if (in_array($file_ex_lc, $allowed_exs)) {
        // Renaming the files wit random strings
        $new_file_name = uniqid(" " , true). '.'.$file_ex_lc;
        // assigning upload path;
        $file_upload_path = '../uploads/'.$path.'/'.$new_file_name;

        // moving uploaded file to root directory upload/$path folder
        move_uploaded_file($tmp_name,$file_upload_path);

        // creating success msg assoc array with named keys status and data
        $sm['status'] = 'success';
        $sm['data'] = $new_file_name;
    
        // Return the Error msg
        return $sm;

    } else {
         // creating error msg assoc array with named keys status and data
    $em['status'] = 'error';
    $em['data'] ='you cant upload files of this type';

    // Return the Error msg
    return $em;
    }
      

}else {
    // creating error msg assoc array with named keys status and data
    $em['status'] = 'error';
    $em['data'] ='error occured while uploading';

    // Return the Error msg
    return $em;
}
}





?>