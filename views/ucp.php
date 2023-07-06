<?php 
$Common->protect("user-is-logged");
include("includes/header.php");
include ("controllers/ucp.php");
?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
  <h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Account Panel</h5>
      <p class="card-text">
        <table class="table striped">
          <tr>
            <td>Username</td>
            <td>Email</td>
            <td>Join Date</td>
            <td>Bug's Reported</td>            
          </tr>
          <tr>
            <td><?= $getUser["username"] ?></td>
            <td><?= $getUser["email"] ?></td>
            <td><?= $getUser["join_date"] ?></td>
            <td><?= $totalBugs['allcount'] ?></td>           
          </tr>
        </table>
      </p>
      <h5 class="card-title" style="margin-top: 50px;">What do you want to do?</h5>
      <p class="card-text">
        <a href="?page=bug-report" class="btn btn-primary">Report a new bug</a>
        <a href="?page=bug-list" class="btn btn-success">View known bugs</a>
        <a href="?page=my-bugs" class="btn btn-warning">My bug reports</a>
      </p>
    </div>
  </div>
</div>

<?php include ("includes/footer.php") ?>