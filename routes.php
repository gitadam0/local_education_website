<?php 

    $routes =  ["/" => "controllers/index.php",
                "/login" => "controllers/authentication.php",
                "/posts" => "controllers/posts.php",
                "/post" => "controllers/postDetail.php",
                "/logout" => "controllers/logout.php",
                "/dashboard/create" => "controllers/dashboard/create.php",
                "/exercices" => "controllers/exercices.php",
                "/exercice" => "controllers/exerciceDetail.php",
                "/profile" => "controllers/profile.php",
                "/user" => "controllers/user.php"
            ];
            
    $path = strtolower(parse_url($_SERVER["REQUEST_URI"])["path"]);
    $params = parse_url($_SERVER["REQUEST_URI"])["query"] ?? null;
    $path = ($path != "/")? rtrim($path,"/"): "/";
    
    if(key_exists($path,$routes)){
        include_once "$routes[$path]";
    }else{
        include_once "views/404.php";
    }
    //print_r($path);
