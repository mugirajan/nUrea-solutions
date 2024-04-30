<?php

require_once("./mailTrigger.php");

$sm = new sndMail();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["type"])) {
    
    $res = array("success" => false, "message" => "");

    switch ($_POST["type"]) {
        
        case "contact":
            $res = $sm->contactEnquiry($_POST);
            break;

        default:
            $res["success"] = false;
            $res["message"] = "Invalid request";
            break;
    }
    
    echo json_encode($res);
}

?>