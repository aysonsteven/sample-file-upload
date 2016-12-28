<?php
if( isset($_FILES['file'])){
    $file = $_FILES['file'];
    
    //getting file properties.
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    //preparing file extension
    $file_ext = explode('.', $file_name);
    $file_ext = strtolower(end($file_ext));

    $allowed = array('jpg', 'png');
    
    if(in_array($file_ext, $allowed)){
        if($file_error === 0){
            if($file_size <= 2087152){

                $file_name_new = uniqid('', true) . '.' . $file_ext;


                ////creating new directory based from the original name of the file.
                $folder = str_replace('.jpg','',$file_name);
                
                $structure = './uploads/' . $folder;

                if (!file_exists($structure)) {
                    if (!mkdir($structure, 0777, true)) {
                        echo('folder is already created before');
                    }
                    
                }
                
                $file_destination = 'uploads/' . $folder . '/' . $file_name_new;

                if(move_uploaded_file($file_tmp, $file_destination)){
                    echo $file_destination;
                }
            }
        }
    }
}