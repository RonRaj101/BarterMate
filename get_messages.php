<?php
include('DBCONNECT.php');

$msg_to = $_GET['to'];
$u_id = $_GET['from'];

$getchatsql = "SELECT M_ID,M_CONTENT,M_FROM FROM messages WHERE (M_TO = '$msg_to' OR M_TO = '$u_id') AND (M_FROM = '$msg_to' OR M_FROM = '$u_id')";
$getchat = mysqli_query($connectionString,$getchatsql);

$num_messages = mysqli_num_rows($getchat);


while($m_row = mysqli_fetch_assoc($getchat)){

    $m_content = $m_row['M_CONTENT'];

    if($m_row['M_FROM'] == $u_id){
        $float = "right";
        $color = "primary";
        $curve_direction = "right";
    }
    else{
        $float = "left";
        $color = "secondary";
        $curve_direction = "left";
    }

    $msg = '<div class="mb-3" style="max-height: 2rem; line-height: 1rem;">';

    $msg .=  '<span class="text-light bg-' . $color .'" style="float: ' . $float .' ; padding: 0.75rem; border-radius:1rem 1rem 1rem 1rem; border-bottom-'.$curve_direction.'-radius:0rem; ">' . $m_content .'</span>
    </div>';

    echo $msg;
}


if($num_messages == 0){
    echo "200";
}



?>