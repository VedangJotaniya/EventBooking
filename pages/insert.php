<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');

if(isset($_POST["fun_details"]))
{
 
    $query = "
 INSERT INTO booking 
        ( mem_id,  date_of_booking,  start_time,  end_time,  fun_details,  charges)
 VALUES (:mem_id, :date_of_booking, :start_time, :end_time, :fun_details, :charges)
 ";

 $statement = $connect->prepare($query);

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
}

?>