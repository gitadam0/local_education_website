<?php
    $heading = "Profile";

        if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
            header("location: /");
            exit;
        }
        $db = new Database($config["database"]);
        $db->conn();
        $result = $db->query("select * from users where id = :id",[":id"=>$_SESSION["userId"]])->fetch();
        $firstname = $result["firstname"];
        $lastname = $result["lastname"];
        $email = $result["email"];
        $password = $result["password"];
        
        include_once "views/partials/header.view.php";
        include_once "views/user/profile.view.php";
        include_once "views/partials/footer.view.php";