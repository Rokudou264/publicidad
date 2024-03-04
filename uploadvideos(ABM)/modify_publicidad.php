<?php
header('Content-Type: application/json');
require '../class/database.php';

$action = $_POST['action'];

switch ($action) {

    case 'insert_curriculum':

        if ((isset($_POST['titulo']) && !empty($_POST['titulo'])) &&
            (isset($_POST['inicio']) && !empty($_POST['inicio'])) &&
            (isset($_POST['fin']) && !empty($_POST['fin']))) {
                
            date_default_timezone_set('America/Asuncion');
            $currentDateTime = date('Y-m-d H:i:s');
            $titulo = $_POST['titulo'];
            $inicio = $_POST['inicio'];
            $fin = $_POST['fin'];
            $idUser = $_POST['idUser'];
            $creador = $_POST['creador'];
            $userF = $_POST['userF'];

            //clase file
            require '../class/taller_video.php';
            $objFile = new Files();

            //vamos a armar la ruta para cargar
            $path = $objFile->fix_path($name);

            //cambiar el nombre del archivo
            $file    = $name;

            $success = $objFile->upload_file($file, $path);

            $newPath = explode('..', $success);

            $size = count($newPath);

            $path = $newPath[$size - 1];

            $parts = explode("/publicidad/", $path);

            if (count($parts) > 1) {
                $pathreal = $parts[1];
            }

            if ($success) {
                try {
                    $db = new Database();
                    $db->beginTransaction();
                    $stmt = $db->prepare("INSERT videos_publicidad (titulo, inicio, fin, ruta, fecha, creador, idUser) 
                                                            VALUES (:titulo,:inicio,:fin,:ruta,:fecha,:creador,:idUser)");
                    $stmt->bindParam(':titulo', $titulo);
                    $stmt->bindParam(':inicio', $inicio);
                    $stmt->bindParam(':fin', $fin);
                    $stmt->bindParam(':creador', $creador);
                    $stmt->bindParam(':idUser', $idUser);
                    $stmt->bindParam(':ruta', $pathreal);
                    $stmt->bindParam(':fecha', $currentDateTime);
                    $stmt->execute();
                    $db->commit();

                    $response = array('status' => 'success', 'message' => 'El video se ha subido');
                    echo json_encode($response);
                    exit;
                } catch (Exception $ex) {
                    $db->rollBack();
                    $response = array('status' => 'error', 'message' => 'Error intente de nuevo, mensaje de error: ' . $ex->getMessage());
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Error al subir el archivo');
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No se proporcionaron todos los datos requeridos.');
            echo json_encode($response);
            exit;
        }
        break;

    case 'delete_video':

        if ((isset($_POST['id']) && !empty($_POST['id'])) && (isset($_POST['iduse_delet']) && !empty($_POST['iduse_delet'])) && $action = 'delete_video') {

            $id = $_POST['id'];
            $iduse_delet = $_POST['iduse_delet'];
            try {
                $db = new Database();
                $db->beginTransaction();

                $stmtpatient = $db->prepare("UPDATE videos_publicidad SET iduse_delet = :iduse_delet, delet = 1 where id = :id");
                $stmtpatient->bindParam(':id', $id);
                $stmtpatient->bindParam(':iduse_delet', $iduse_delet);
                $stmtpatient->execute();
                $db->commit();

                $response = array('status' => 'success', 'message' => 'Se ha eliminado el video');
                echo json_encode($response);
                exit;
            } catch (Exception $ex) {
                $db->rollBack();
                $response = array('status' => 'error', 'message' => 'Error intente de nuevo, mensaje de error: ' . $ex->getMessage());
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No se proporcionaron todos los datos requeridos.');
            echo json_encode($response);
            exit;
        }
        break;

    case 'update_fecha':

        if ((isset($_POST['id_video_edit']) && !empty($_POST['id_video_edit'])) && $action = 'update_fecha') {

            $id = $_POST['id_video_edit'];
            $inicio_edit = $_POST['inicio_edit'];
            $fin_edit = $_POST['fin_edit'];

            try {
                $db = new Database();
                $db->beginTransaction();

                $stmtpatient = $db->prepare("UPDATE videos_publicidad SET inicio = :inicio_edit, fin = :fin_edit where id = :id");
                $stmtpatient->bindParam(':id', $id);
                $stmtpatient->bindParam(':inicio_edit', $inicio_edit);
                $stmtpatient->bindParam(':fin_edit', $fin_edit);
                $stmtpatient->execute();
                $db->commit();

                $response = array('status' => 'success', 'message' => 'La fecha ha sido cambiada');
                echo json_encode($response);
                exit;
            } catch (Exception $ex) {
                $db->rollBack();
                $response = array('status' => 'error', 'message' => 'Error intente de nuevo, mensaje de error: ' . $ex->getMessage());
                echo json_encode($response);
                exit;
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No se proporcionaron todos los datos requeridos.');
            echo json_encode($response);
            exit;
        }
        break;
    default:
        $response = array('status' => 'error', 'message' => 'Error, comuniquese con el desarrollador.');
        echo json_encode($response);
        exit;
}