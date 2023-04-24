<?php

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }
    include_once "views/partials/header.view.php";
    include_once "views/user/exercices.view.php";
    $db = new Database($config["database"]);
    $db->conn();
    $result = $db->query("select * from exercices",[])->fetchAll();
    foreach ($result as $row) {
        echo ("
        <div class='card bg-light mb-4 flex-column flex-md-row w-100 position-relative' >
            <span class='position-absolute top-0 end-0 p-2 text-light bg-success'><b>".$row["category"]."</b></span>
            <div class='card-body' style='min-width: 300px;'>
                <h4 class='card-title display-4'>".$row["title"]."</h4>
                <a href='post?exercice_id=".$row["id"]."' class='btn btn-success'>start</a>
            </div>
            <span class='position-absolute bottom-0 end-0 m-3 fst-italic text-muted'>Level: ".$row['level']."</span>
        </div>
        ");
    }
    //print_r(json_decode($result[0]["questions"],true)["questions"][0]["answers"][0]);