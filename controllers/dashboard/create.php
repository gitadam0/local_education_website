<?php
    $heading = "Create post";

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }

    $postTitle = $postSecondTitle = $postImageLink = $postImageLink = $postImageAlt = $postBody = $postCategory= "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["submit"])){
            
            $postTitle = $_POST["post_title"];
            $postSecondTitle = $_POST["post_description_title"];
            $postImageLink = $_POST["post_image_link"];
            $postImageAlt = $_POST["post_image_alt"];
            $postBody ="<div>".$_POST["post_body"]."</div>";
            $postCategory = $_POST["post_category"];
            $author = $_SESSION["userId"];
            $db = new Database($config["database"]);
            $db->conn();
            $db->query("INSERT INTO posts(title,body,author,image,image_alt,category) 
            values(:postTitle,:postBody,:author,:postImageLink,:postImageAlt,:postCategory);",
            [":postTitle" => $postTitle,
            ":postBody" => $postBody,
            ":author" => $author,
            ":postImageLink" => $postImageLink,
            ":postImageAlt" => $postImageAlt,
            ":postCategory" => $postCategory
        ]);
        header("location:/posts");
        exit;
        }
    }
    include_once "views/partials/header.view.php";
    include_once "views/user/dashboard/create.view.php";