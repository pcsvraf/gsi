<?php
$conn = mysqli_connect("localhost", "pcspucv_wp", "0BHpaAlRIenq", "pcspucv_wp");
$json=array();
mysqli_set_charset($conn, "utf8");
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$sql = "SELECT id FROM peticion WHERE estado='7'";
$query = mysqli_query($conn, $sql);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}else{
    while ($row = mysqli_fetch_array($query)) {
        $data=array();
        $data[]=$row['id'];
        $json[]=$data;
    }
}

echo json_encode($json);
?>