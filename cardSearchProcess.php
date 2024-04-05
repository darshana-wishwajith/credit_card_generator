<?php
include "mysql_connector.php";

if (empty($_POST['hName2'])) {
    echo ("1");
} else if (empty($_POST["password2"])) {
    echo ("2");
} else {

    $hName2 = $_POST["hName2"];
    $password2 = $_POST["password2"];

    $response_rs2 = Database::search("SELECT * FROM `card` INNER JOIN `card_type` ON `card`.`card_type_id` = `card_type`.`id` INNER JOIN `card_network` ON `card`.`card_network_id` = `card_network`.`id` WHERE `holder_name` = '" . $hName2 . "' AND `password` = '" . $password2 . "'");

    $response_num2 = $response_rs2->num_rows;

    if ($response_num2 == 1) {
        $response_data2 = $response_rs2->fetch_assoc();

        $json_obj2 = new stdClass();

        $json_obj2->card_no = $response_data2['card_no'];
        $json_obj2->exipre_date = $response_data2['exipre_date'];
        $json_obj2->holder_name = $response_data2['holder_name'];
        $json_obj2->cvv = $response_data2['cvv'];
        $json_obj2->type_name = $response_data2['type_name'];
        $json_obj2->network_name = $response_data2['network_name'];

        $response2 = json_encode($json_obj2);

        echo ($response2);
    } else {
        echo ("3");
    }
}
