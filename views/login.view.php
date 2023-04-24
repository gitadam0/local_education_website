<div class="row justify-content-center">
    <h1 style="text-align:center">Login page</h1>
    <form class="col-6 " action="/login" method="post">
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        <?= (!empty($emailErr))?"<span class='text-danger'>".$emailErr."</span>":""?>
    </div>
    <div class="mb-3">
        <label for="pwd" class="form-label">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        <?= (!empty($passwordErr))?"<span class='text-danger'>".$passwordErr."</span>":""?>
    </div>
    <div class="form-check mb-3">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
    </div>
    <?= (!empty($loginErr))?"<span class='text-danger'>".$loginErr."</span>":""?>
    <div class="my-3">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </div>
    
</form>
</div>