    <?php
    $fileName = $_FILES['p_img']['name'];
    $fileTempLocation = $_FILES['p_img']['tmp_name'];
    $fileSize = $_FILES['p_img']['size'];
    $fileError = $_FILES['p_img']['error'];
    $filetype = $_FILES['p_img']['type'];

    $filetypeget = explode('.',$fileName);
    $fileEXT = strtolower(end($filetypeget));

    $File_Name = uniqid('',true).".".'webp';

    $FileGOTO_img = 'assets/podcasts/Images/'.$File_Name;  
    move_uploaded_file($fileTempLocation,$FileGOTO_img);  
?>