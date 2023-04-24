
<?php 

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }
    if(isset($_GET["post_id"])){
        $post_id = $_GET["post_id"];
        $db = new Database($config["database"]);
        $db->conn();
        $result = $db->query("select * from posts where id = :id",[":id"=> $post_id])->fetch();
        if($result){
            $post_title = $heading = $result["title"];
            $post_date = $result["date"];
            $post_img = $result["image"];
            $post_img_alt = $result["image_alt"];
            $author = $db->query("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM posts inner join users On posts.author = users.id where users.id = :id ;",[":id"=> $result["author"]])->fetch()["fullname"];
            $body = $result["body"];
            include_once "views/partials/header.view.php";
            include_once "views/user/postDetail.view.php";
            echo $body;
        }else{
            header("location:404.php");
        }
    }else{
        header("location:404.php");
        exit;
    }
    include_once "views/partials/footer.view.php";
