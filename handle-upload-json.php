<?php
session_start();
if(isset($_POST['submit'])){
    $data = $_FILES['json'];
   // print_r($data);

    $dataName = $data['name'];
    $dataType = $data['type'];
    $dataTmpName = $data['tmp_name'];
    $dataError = $data['error'];
    $dataSize = $data['size'];
    $dataSizeMB = $dataSize / (1024 ** 2);
    $ext = pathinfo($dataName,PATHINFO_EXTENSION);
    echo $ext;


    $errors = [];
    //validate json file
    //1-check that no errors
    if($dataError != 0){
        $errors[] = "E(rror while uploading json file";
    }elseif($ext != "json"){
        $errors[] = "File extension must be json";
    };



    //rename & move from server to app

    if(empty($errors)){
        $randomStr = uniqid();
        $dataNewName = $randomStr.$ext;
        move_uploaded_file($dataTmpName, "uploads/$dataNewName");
   
        $jsonFile = json_decode(file_get_contents("uploads/604cd4f08a618json"),true);
        var_dump($jsonFile);
        $_SESSION ['jsonFile'] = $jsonFile ;
}
}