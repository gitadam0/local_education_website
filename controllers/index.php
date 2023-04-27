<?php 

    $heading = "Home";

    if(isset($_SESSION["userId"])){
        include_once "views/partials/header.view.php";
        $db = new Database($config["database"]);
        $db->conn();
        $result = $db->query("select * from users;",[])->fetchAll();
        include_once "views/user/index.view.php";
        foreach($result as $user){ 
            echo ($user["admin"] == 1)?"<tr><td ><a class='text-success' href='/user?user_id=".$user['id']."'><b>admin</b></a></td>":"<tr><td ><a class='text-warning' href='/user?user_id=".$user['id']."'><b>user</b></a></td>";
            echo '<td>'.$user["firstname"].'</td>
                <td>'.$user["lastname"].'</td>
                <td>'.$user["level"].'</td>
            </tr>';
        }
        echo "</tbody></table></div>";
    }else{
        include_once "views/partials/head.view.php";
        include_once "views/index.view.php";
    }
    
    include_once "views/partials/footer.view.php";
