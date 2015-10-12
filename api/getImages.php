<?php
    include "dbConfig.php";

    //print_r($_POST);
    $db=getDB();

    function fetchRecordsArr($queryString,$oprType='mul') {
        $exCustquery = @mysql_query($queryString);
        $numReords   = @mysql_num_rows($exCustquery);

        if(mysql_error()){
            echo mysql_error();die;
            }


        if($oprType=='numRows')
        {
            return $numReords;
        }
        $recordArr = array();
        //checking the number of rows
        if($numReords>0)
        {
            while($custRow= @mysql_fetch_assoc($exCustquery))
            {
                $recordArr[] = $custRow ;
            }
        }
        //if num rows ends here.

        return $recordArr ;

    }

    $queryString="select images from angular_gallery ";
    $listArray=fetchRecordsArr($queryString);

    //print_r($listArray[0]);
    $listArray=explode(',',$listArray[0]['images']);

    //print_r($listArray);
    echo json_encode($listArray);
?>