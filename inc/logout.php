<?php include('../config.php');
try {
    session_start();
    session_destroy();

    header("Location: ". BASEURL . "index.php");
} catch (Exception $e) {
    $_SESSION['message'] = "Ocorreu um erro: " . $e->GetMessage();
    $_SESSION['type'] = "danger";
}


?>