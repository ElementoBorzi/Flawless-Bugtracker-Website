<style>
    html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>

<?php

if(isset($_POST['login']))
{
    if (!empty($_POST["email"]) && !empty($_POST["password"]))
    {
        $hash = $Admin->login($_POST["email"], $_POST["password"]); 
    }
    else
    {
        echo "<div class='alert alert-danger' role='alert'>In order to login you need to fill in all fields.</div>";
    }
}

?>

<main class="form-signin">
    <form method="post" action="">
        <h1 class="text-center h3 mb-3 fw-normal" style="margin-bottom: 50px;">Administration Panel</h1>
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" login="password" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <input type="submit" class="w-100 btn btn-lg btn-primary" value="Sign in" name="login">
        <p class="mt-5 mb-3 text-muted text-center">&copy; <?= date("Y") ?></p>
    </form>
</main>




<?php
  

  // The hash of the password can be saved in the database


?>
