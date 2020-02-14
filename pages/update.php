<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=society', 'root', '');

if(isset($_POST["id"]))
{

    $query = " SELECT mem_id from booking where booking_id=:id";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':id' => $_POST['id']
        )
    );
    $result=$statement->fetch();
    $var = "";
    if(strcmp($result[0],$_POST['mem_id']))
    {
        $var="Updated Successfully";


    $query = "
                UPDATE booking 
                SET fun_details=:title, start_time=:start_event, end_time=:end_event 
                WHERE booking_id=:id
             ";
    $statement = $connect->prepare($query);
    $statement->execute(
                        array(
                            ':title'  => $_POST['title'],
                            ':start_event' => $_POST['start'],
                            ':end_event' => $_POST['end'],
                            ':id'   => $_POST['id']
                        )
                    );


    }
    else
    {
            $var="You have no Access to this event";
    }
    echo $var;

}

?>