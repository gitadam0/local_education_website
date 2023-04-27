<?php 
    $currentPage = strtolower(parse_url($_SERVER["REQUEST_URI"])["path"]);
    $myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']),array('off','no'))) ? 'https' : 'http';
    // Get domain portion
    $myUrl .= '://'.$_SERVER['HTTP_HOST'];
    // Get path to script
    $myUrl .= $_SERVER['REQUEST_URI'];
    // Add path info, if any
    if (!empty($_SERVER['PATH_INFO'])) $myUrl .= $_SERVER['PATH_INFO'];
    // Add query string, if any (some servers include a ?, some don't)
    if (!empty($_SERVER['QUERY_STRING'])) $myUrl .= '?'.ltrim($_SERVER['REQUEST_URI'],'?');
    $d = " hg ";
    $c = trim($d);
    echo strlen($c);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$heading?></title>
    <link rel="canonical" href="<?= $myUrl?>">
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
                <a class="nav-link <?= $currentPage == "/exercices"? "active":"" ?>" href="/exercices">Exercices</a>
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
