<?php

$dbconn = pg_connect("host=localhost port=5432 dbname=kitchen user=postgres password=root");
if(!$dbconn){
    header( 'Location: error.php?msg='."Error in connection: " . pg_last_error() ) ;
}
    
if(!array_key_exists("check_submit", $_POST)){
    pg_close($dbconn);
    header( 'Location: error.php?msg='."Nothing submitted" ) ;
}

$remark="";
$kitchen=1;
$result=2;
$address = "unkown";
if(isset($_POST['remark'])){
    $remark = $_POST['remark'];
}
if(isset($_POST['result'])){
    $result = $_POST['result'];
}
if(isset($_POST['kitchen'])){
    $kitchen = 1;
}
if(isset($_POST['address'])){
    $address = $_POST['address'];
}

$query  = "INSERT INTO kitchen (vote, kitchen, remark, address) VALUES ("
        ."$result,$kitchen,'$remark','$address'".")";

$dbresult = pg_query($dbconn, $query);

if (!$dbresult) {
    pg_close($dbconn);
    header( 'Location: error.php?msg='."Error in SQL query: " . pg_last_error() ) ;
}else{
    pg_close($dbconn);
    header( 'Location: thanks.php' ) ;
}
?>
