<?php 

    $heading = "Posts";

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }
    include_once "views/partials/header.view.php";
    include_once "views/user/posts.view.php";

    $db = new Database($config["database"]);
    $db->conn();
    $result = $db->query("select * from posts order by date desc",[])->fetchAll();
    
    foreach ($result as $post) {
        $image = (!empty($post["image"])?$post["image"]:"assets/images/default-image.png");
        echo ("
        <div class='card mb-4 flex-column flex-md-row w-100 position-relative' >
            <span class='position-absolute top-0 end-0 p-2 text-light bg-success'><b>".$post["category"]."</b></span>
            <div style='max-width:600px;width:100%;height:200px;min-width:150px;'>
                <img onerror='{this.src = `assets/images/default-image.png`} ' style='width:100%;height:100%;object-fit: cover;' src='$image' class='img-fluid' alt='...'>
            </div>
            <div class='card-body' style='min-width: 300px;'>
                <h5 class='card-title'>".$post["title"]."</h5>
                <p class='card-text'>".$post["title"]."</p>
                <a href='post?post_id=".$post["id"]."' class='btn btn-primary'>Read</a>
            </div>
            <span class='position-absolute bottom-0 end-0 m-3 fst-italic text-muted'>--By ".$db->query("SELECT CONCAT(firstname, ' ', lastname) as fullname FROM posts inner join users On posts.author = users.id where users.id = :id ;",[":id"=> $post["author"]])->fetch()["fullname"]."</span>
        </div>
        ");
    }
    include_once "views/partials/footer.view.php";

