<?php
    include "mysql_connector.php";

    if($_POST['cardType'] == 0){
        echo("1");
    }
    else if($_POST['cardType'] < 0 || $_POST['cardType'] > 2){
        echo("2");
    }
    else if($_POST['cardNetwork'] == 0){
        echo("3");
    }
    else if($_POST['cardNetwork'] < 0 || $_POST['cardNetwork'] > 2){
        echo("4");
    }
    else if(empty($_POST['hName'])){
        echo("5");
    }
    else if(strlen($_POST['hName']) < 6){
        echo("6");
    }
    else if($_POST["cvv"] > 999 || $_POST["cvv"] < 100 || strlen($_POST["cvv"]) < 3){
        echo("7");
    }
    else if(!isset($_POST['exDate'])){
        echo("8");
    }
    else if(empty($_POST['exDate'])){
        echo("9");
    }
    else if(empty($_POST["password"])){
        echo("10");
    }
    else if(strlen($_POST["password"]) < 4){
        echo("11");
    }
    else{
        
        $cardType = $_POST["cardType"];
        $cardNetwork = $_POST["cardNetwork"];
        $hName = $_POST["hName"];
        $cvv = $_POST["cvv"];
        $exDate = $_POST["exDate"];
        $password = $_POST["password"];

        $card_no = rand(0000000000000000,9999999999999999);

        if(strlen($card_no) < 16){
            $zeros = 16 - strlen($card_no);

            $card_no = $zeros.$card_no;
        }

        $cn_rs = Database::search("SELECT * FROM `card` WHERE `card_no` = '".$card_no."'");
        $cn_num = $cn_rs->num_rows;

        if($cn_num > 0){
            echo("12");
        }
        else{

            Database::iud("INSERT INTO `card` (`card_no`,`exipre_date`,`holder_name`,`cvv`,`password`,`card_type_id`,`card_network_id`) VALUES ('".$card_no."', '".$exDate."', '".$hName."', '".$cvv."', '".$password."', '".$cardType."','".$cardNetwork."')");

            $response_rs = Database::search("SELECT * FROM `card` INNER JOIN `card_type` ON `card`.`card_type_id` = `card_type`.`id` INNER JOIN `card_network` ON `card`.`card_network_id` = `card_network`.`id` WHERE `holder_name` = '".$hName."' AND `password` = '".$password."'");

            $response_data = $response_rs->fetch_assoc();

            $json_obj = new stdClass();

            $json_obj->card_no = $response_data['card_no'];
            $json_obj->exipre_date = $response_data['exipre_date'];
            $json_obj->holder_name = $response_data['holder_name'];
            $json_obj->cvv = $response_data['cvv'];
            $json_obj->type_name = $response_data['type_name'];
            $json_obj->network_name = $response_data['network_name'];

            $response = json_encode($json_obj);

            echo($response);
        }

        

    }
    
    
?>