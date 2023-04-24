<?php 
    $currentPage = strtolower(parse_url($_SERVER["REQUEST_URI"])["path"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$heading?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == "/posts"? "active":"" ?>" href="/posts">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == "/exercices"? "active":"" ?>" href="#">Exercices</a>
            </li>
            <?php

                if(isset($_SESSION["admin"])){
                    echo '<li class="nav-item">';
                    if($currentPage == "/dashboard"){
                        echo '<a class="nav-link active" href="/dashboard/create">Dashboard</a>';
                    }else{
                        echo '<a class="nav-link" href="/dashboard/create">Dashboard</a>';
                    }
                    echo '</li>';
                }
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == "/profile"? "active":"" ?>" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentPage == "/logout"? "active":"" ?>" href="/logout">Logout</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10">
