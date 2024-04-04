<?php
    include "mysql_connector.php";

    if($_POST['cardType'] == 0){
        echo("Please select a card type");
    }
    else if($_POST['cardType'] < 0 || $_POST['cardType'] > 2){
        echo("Invalid card type");
    }
    else if($_POST['cardNetwork'] == 0){
        echo("Please select a card network");
    }
    else if($_POST['cardNetwork'] < 0 || $_POST['cardNetwork'] > 2){
        echo("Invalid card network");
    }
    else if(empty($_POST['hName'])){
        echo("Please enter your name with initials");
    }
    else if(strlen($_POST['hName']) < 6){
        echo("Holder's name is too short");
    }
    else if($_POST["cvv"] > 999 || $_POST["cvv"] < 100 || strlen($_POST["cvv"]) < 3){
        echo("Invalid CVV number");
    }
    else if(!isset($_POST['exDate'])){
        echo("Something went wrong in expire date");
    }
    else if(empty($_POST['exDate'])){
        echo("plase select an expire date");
    }
    else if(empty($_POST["password"])){
        echo("Please enter a password for your card");
    }
    else if(strlen($_POST["password"]) < 4){
        echo("Your password is too short");
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
            echo("Somthing went wrong! please try again");
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