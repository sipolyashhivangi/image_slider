<?php

    include "dbConfig.php";
    //print_r($_POST);
    $db = getDB();
    $post_date = file_get_contents("php://input");
    $data1 = json_decode($post_date);
    $noImages = $data1->noImages;
    $fileImg = $data1->file;
    $path = $data1->path;
    print_r($path);
    $time = time();
    $dataFileVal = array();
    $file_path1 = '/mnt/backup/home/ssipolya/public_html/Angular Js/image_slider/js/image/';

    foreach($path as $key=>$val)
    {

        $data = $val;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        //echo $fileImg[$key];
        $file_path = $file_path1.$fileImg[$key];
        $dataImg = $fileImg[$key];
        $dataFileVal[] = $dataImg;
        //print_r($data);
        $uploadMul = file_put_contents($file_path, $data);

    }

    //print_r($dataFileVal);
    $ImgVal = implode(',',$dataFileVal);
    //print_r($ImgVal);
    $emptyTable = mysql_query("truncate table angular_gallery");
    $insertImage = mysql_query("insert into angular_gallery(noImages, images) values('".$noImages."', '".$ImgVal."')");
