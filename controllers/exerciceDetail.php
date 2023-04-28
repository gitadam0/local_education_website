<?php 

    if(!isset($_SESSION["userId"]) || empty($_SESSION["userId"])){
        header("location: /");
        exit;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["submit"])){
            $db = new Database($config["database"]);
            $db->conn();
            $userDetail = $db->query("select * from users where id = :id",[":id" => $_SESSION["userId"]])->fetch();
            
            $exercice_id = $_POST["ex_id"];
            $result = $db->query("select * from exercices where id = :id",[":id"=> $exercice_id])->fetch();
            
            
            $numOfQuestions = count(json_decode($result["questions"],true)["question"]);
            $xpWin = 0;
            $xpAdded = $result["xp"];
            
            $questionIndex = 0;
            $numOfCorrectAnswers = 0;
            $answersStatus = [];
            foreach ((json_decode($result["questions"],true)["question"]) as $key ) {
                $answersStatus[$questionIndex] = 0;
                if(isset($_POST["question".$questionIndex]) && $_POST["question".$questionIndex] == $key["index"]){
                    $xpWin += $xpAdded;
                    $numOfCorrectAnswers++;
                    $answersStatus[$questionIndex] = 1;
                }
                $questionIndex++;
            } 
            $currentLevel = $userDetail["level"];
            $oldXp = $userDetail["xp"];
            if(($oldXp + $xpWin) >= ($currentLevel * 100)){
                $db->query("update users set level = :level,xp =:xp where id = :id",[":id" =>$_SESSION["userId"],":level"=>++$currentLevel,":xp" => 0]);
                $oldXp = 0;
                $xpWin = 0;
                $_SESSION["cong_msg"] = true;
            }else if($xpWin > 0){
                $db->query("update users set xp =:xp where id = :id",[":id" =>$_SESSION["userId"],":xp" => $oldXp+$xpWin]);
                $oldXp = 0;
                $xpWin = 0;
            }
        }
    }
    if(isset($_GET["exercice_id"])){
            $exercice_id = $_GET["exercice_id"];
            $db = new Database($config["database"]);
            $db->conn();
            $result = $db->query("select * from exercices where id = :id",[":id"=> $exercice_id])->fetch();
            if($result){
                $title = $heading = $result["title"];
                $xp = $result["xp"];
                $category = $result["category"];
                $level = $db->query("select level from users where id = :id",[":id" => $_SESSION["userId"]])->fetch()["level"];
                include_once "views/partials/header.view.php";
                include_once "views/user/exerciceDetail.view.php";
                
                if(isset($_SESSION["cong_msg"])){
                    
                    echo '<div class="mymodal show">
                    <div class="mymodal-content w-75">
                        <div class="mymodal-content-header d-flex justify-content-between">
                            <div class="mymodal-content-title">
                                <h2>Bravo!! <h2>
                            </div>
                            <div class="" >
                                <button onclick="this.parentNode.parentNode.parentNode.parentNode.remove()" class="btn border-primary text-primary ">X</button>
                            </div>
                        </div>
                        <div class="mymodal-content-desc">
                            <p>You have reached the next level.</p>
                        </div>
                        <div class="mymodal-content-levels d-flex justify-content-evenly align-items-center pb-2">
                            <div class="oldlevel text-light" >
                                <b>'.($level - 1 ).'</b>
                            </div>
                            <span style="font-size:30px;font-family:sans-serif;" class="text-primary">&gt&gt</span>
                            <div class="currentLevel text-light">
                                <b>'.$level.'</b>
                            </div>
                        </div>
                    </div>
                </div>';
                    unset($_SESSION["cong_msg"]);
                }
                $num = 0;
                echo '<input type="hidden" name="ex_id" value="'.$result["id"].'"/>';
                foreach (json_decode($result["questions"],true)["question"] as $key) {
                    $index = 0;
                    $color = "success";
                    if(isset($answersStatus)){
                        $color = ($answersStatus[$num] == 1)?"success":"danger";
                    }
                    echo '
                        <fieldset class="border border-'.$color.' p-3 mb-3">
                        <legend class="mb-3">'."$num) ".$key["title"].'</legend>
                        <div class="row mb-3">
                    ';
                    foreach ($key["answers"] as $answer ) {
                        echo '<div class="col-10 col-sm-6 col-md-3 mb-2">
                                <label>'.$answer.'</label>
                                <input value="'.$index.'" class="form-check-input ms-2 me-4" type="radio" name="question'.$num.'"/>
                            </div>';
                        $index++;
                    }
                    echo '</div></fieldset>';
                    
                    $num++;
                }
                echo (isset($numOfCorrectAnswers))?"<b class='bg-warning mb-2 p-1 d-inline-block'>You have done $numOfCorrectAnswers/$numOfQuestions</b><br>":"";
                echo '<button class="btn btn-success" name="submit">Submit</button></form>';
                include_once "views/partials/footer.view.php";
            }else{
                header("location:404.php");
            }
        }else{
            header("location:404.php");
        }
