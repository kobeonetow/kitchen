<?php


$dbconn = pg_connect("host=localhost port=5432 dbname=kitchen user=postgres password=root");
if(!$dbconn){
    header( 'Location: error.php?msg='."Error in connection: " . pg_last_error() ) ;
}
$date = date("Y-m-d");
$query  = "SELECT * FROM kitchen";
if(array_key_exists("check_submit", $_POST)){
    $date = $_POST['date'];
    if(strlen($date)<10)
        $date = date("Y-m-d");
    $query  = "SELECT * FROM kitchen WHERE createtime >= '".$date."'";
}

$dbresult = pg_query($dbconn, $query);
if (!$dbresult) {
    header( 'Location: error.php?msg='."Error in SQL query: " . pg_last_error() ) ;
}

?>

<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head><title>数据查看</title></head>
    
    <script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           
        });
    </script>
    <style type="text/css">
        #result{
            border-collapse:collapse;
            text-align: center;
            width:100%;
        }
        #result tr td{
            border: 1px solid black;
            padding: 5px;
        }
        #result tr.header td{
            color:red;
            font-size: 20pt;
        }
        .title{
            color:black;
            font-size: 40pt;
        }
    </style>
    <body style="text-align: center;background-color: #66ffff;">
        <div class="title">
            饭堂满意度调查数据
        </div>
        <form action="" method="post">
            <input type="hidden" name="check_submit" value="1"/>
            日期:<input type="text" name="date" value="<?php echo $date;?>">(格式:yyyy-mm-dd)
            <input type="submit" value="提交"/>
        </form>
        <div>满意度:(1:很差-->5:非常满意)</div>
        <table id="result">
            <tr class="header">
                <td>序号</td>
                <td>地方</td>
                <td>录入日期</td>
                <td>录入时间</td>
                <td>满意度</td>
                <td>附加意见</td>
            </tr>
            <?php 
                $count = 1;
                while ($row = pg_fetch_array($dbresult)) {
                    echo "<tr>";
                        echo "<td>$count</td>";
                        if($row['kitchen'] == 1)
                            echo "<td>饭堂A</td>";
                        else
                            echo "<td>饭堂B</td>";
                        
                        $format = 'Y-m-d';
                        $format_time = "H:i:s";
                        $plusSign = strrpos($row['createtime'],"+") ;
                        $time = substr($row['createtime'], 0,$plusSign);
                        $formatted_timestamp_date = date($format, strtotime($time));
                        $formatted_timestamp_time = date($format_time, strtotime($time));
                        echo "<td>".$formatted_timestamp_date."</td>";
                        echo "<td>".$formatted_timestamp_time."</td>";
                        echo "<td>".($row['vote']+1)."</td>";
//                        switch($row['vote']){
//                        case 0:
//                            echo "<td>很差</td>";
//                            break;
//                        case 1:
//                            echo "<td>不满意</td>";
//                            break;
//                        case 2:
//                            echo "<td>一般</td>";
//                            break;
//                        case 3:
//                            echo "<td>满意</td>";
//                            break;
//                        case 4:
//                            echo "<td>非常满意</td>";
//                            break;
//                        }
                        echo "<td>".$row['remark']."</td>";
                    echo "</tr>";
                    $count++;
                }
            ?>
        </table>
       
    </body>
</html>

<?php
pg_free_result($dbresult);


// close connection


pg_close($dbconn);
?>