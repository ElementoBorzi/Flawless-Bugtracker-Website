<?php
Common::protect("acp-rank-verify");
Application::loadController("home");
Application::loadView("header-inc");
?>

<link rel="stylesheet" href="../theme/default/css/acp-login.css">

<main class="form-signin">

    <?= Application::userMessage($_SESSION['message']) ?>

    <form method="post" action="">
        <h1 class="text-center h3 mb-3 fw-normal" style="margin-bottom: 50px;">Administration Panel</h1>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" login="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <input type="submit" class="w-100 btn btn-lg btn-primary" value="Sign in" name="login">
        <p class="mt-5 mb-3 text-muted text-center">&copy; <?= date("Y") ?></p>
    </form>
</main>