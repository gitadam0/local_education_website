<?php 
    $nextLevel = ($level * 100);
    $progress = ($xp != 0) ? ($xp / $nextLevel)*100:0;

?>
<div class="row ">
    <div class="col-12 col-sm-6 m-auto">
        <div class="mb-3">
            <img class="img-fluid m-auto d-block" width="200px" height="200px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1200px-Default_pfp.svg.png" alt=""/>
        </div>
        <div class="mb-3">
            <h3 class="text-center"><?= $username?></h3>
        </div>
        <div class="mb-3">
            <h4 class="text-center"><i>Level</i> <?= $level?></h4>
        </div>
        <div class="d-flex justify-content-center gap-2 ">
            <div class="progress mb-3 w-75" style="height:25px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;font-weight:bold;font-size:16px;"><?=$xp." xp"?></div>
            </div>
            <span class="w-25 text-center" style="top:0;"><b><?=$nextLevel?> xp</b></span>
        </div>

    </div>
</div>