<?php
header('Content-Type: application/json');

require_once '../database.php';

$db = new Database();

date_default_timezone_set('America/Asuncion');
$date_time = date('Y-m-d H:i:s');

$sql = "SELECT ruta FROM videos_publicidad WHERE :date_time BETWEEN inicio AND fin AND delet = 0 ORDER BY id DESC";
$query = $db->prepare($sql);
$query->bindValue(':date_time', $date_time, PDO::PARAM_STR);
$query->execute();

$videos = $query->fetchAll(PDO::FETCH_ASSOC);

// Utiliza json_encode con la opción JSON_HEX_TAG para prevenir ataques XSS
echo json_encode($videos, JSON_HEX_TAG);
?>