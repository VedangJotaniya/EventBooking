
<?php
$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');

$data = array();

$query = "SELECT booking_id,fun_details,start_time,end_time FROM booking ORDER BY booking_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["booking_id"],
  'title'   => $row["fun_details"],
  'start'   => $row["start_time"],
  'end'   => $row["end_time"]
 );
}

echo json_encode($data);



?>
