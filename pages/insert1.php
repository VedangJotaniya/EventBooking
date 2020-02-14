<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');
$var = "";
if(isset($_POST["fun_details"]))
{
    $var="1 ";
 
    $query = "
 INSERT INTO booking 
        ( mem_id,  date_of_booking,  start_time,  end_time,  fun_details,  charges)
 VALUES (:mem_id, :date_of_booking, :start_time, :end_time, :fun_details, :charges)
 ";
 $var=$var." 2 ";
 $statement = $connect->prepare($query);
 $var=$var." 3 ";
 $statement->execute(
  array(
   ':mem_id'  => $_POST['mem_id'],
   ':date_of_booking'  => $_POST['date_of_booking'],
   ':start_time'  => $_POST['start_time'],
   ':end_time'  => $_POST['end_time'],
   ':fun_details'  => $_POST['fun_details'],
   ':charges'  => $_POST['charges'],
   )
 );
 $val = $_POST['mem_id']." ".$_POST['date_of_booking']." ".$_POST['start_time']." ".$_POST['end_time']." ".$_POST['fun_details']." ".$_POST['charges'];
 $var=$var." 4 ";
}
$var=$var." 5 ";

echo $val;

?>