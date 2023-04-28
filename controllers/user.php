<?php 

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }
    if(isset($_GET["user_id"])){
        $user_id = htmlspecialchars($_GET["user_id"]);
        $db = new Database($config["database"]);
        $db->conn();
        $result = $db->query("select id,xp,CONCAT(firstname,' ',lastname) as fullname,level,admin from users where id = :id",[":id"=>$user_id])->fetch();
        $username = $result["fullname"];
        $level = $result["level"];
        $xp = $result["xp"];
        include_once "views/partials/header.view.php";
        include_once "views/user/user.view.php";
        if($result["admin"]){
            $posts = $db->query("select * from posts where author = :id",[":id"=>$result["id"]])->fetchAll();
            if(count($posts) > 0){
                echo "<h2>Posts created by:</h2>";
                foreach($posts as $post){
                    echo "<a class='mb-3' style='font-size:1.2rem;' href='/post?post_id=".$post["id"]."'>".$post["title"]."</a>";
                    echo "<br>";
                }
            }
        }
    }else{
        header("location:/");
        exit;
    }
    include_once "views/partials/footer.view.php";
    