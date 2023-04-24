<?php 

    $heading = "Home";

    if(isset($_SESSION["userId"])){
        include_once "views/partials/header.view.php";
        $db = new Database($config["database"]);
        $db->conn();
        $result = $db->query("select * from users;",[])->fetchAll();
        include_once "views/user/index.view.php";
        foreach($result as $user){ 
            echo '<tr><td>'.$user["firstname"].'</td>
                <td>'.$user["lastname"].'</td>
                <td>'.$user["level"].' xp</td>
            </tr>';
        }
        echo "</tbody></table>";
    }else{
        include_once "views/partials/head.view.php";
        include_once "views/index.view.php";
    }
    
    include_once "views/partials/footer.view.php";
