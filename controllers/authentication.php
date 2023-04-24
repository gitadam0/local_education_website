<?php 

    $heading = "Login";
    $emailErr = $password = $passwordErr = $loginErr = "";
    $email = $password = "";
    if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){
        header("location: /");
    }else{
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["submit"])){
                if(empty($_POST["email"]) || empty($_POST["password"])){
                    $emailErr = "Name mustn't be empty";
                    $passwordErr = "Password mustn't be empty";
                }else{
                    $email = strtolower(trim(htmlspecialchars($_POST["email"])));
                    $password = strtolower(trim(htmlspecialchars($_POST["password"])));
                    $db = new Database($config["database"]);
                    $db->conn();
                    $result = $db->query("select * from users where email = :email and password = :password",[":email"=>$email,":password"=>$password])->fetch();
                    if($result){
                        $_SESSION["userId"] = $result["id"];
                        $_SESSION["userName"] = $result["name"];
                        if($result["admin"] == true){
                            $_SESSION["admin"] = true;
                        }
                        header("location:/");
                        exit;
                    }else{
                        $loginErr = "Email or password incorrect";
                    }
                }
            }
        }
    }
    include_once "views/partials/head.view.php";
    include_once "views/login.view.php";
    include_once "views/partials/footer.view.php";