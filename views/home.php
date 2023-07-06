<?php include("includes/header.php") ?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
  <h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Welcome!</h5>
      <p class="card-text">
          This website is specifically designed for reporting bugs related to the 
          <a href="https://wowemu.org/threads/wowemu-mists-of-pandaria-5-4-8-repack.8525/">5.4.8 repack</a>. <br />
          We appreciate your dedication to improving the repack and ensuring a smooth user experience. 
          Please use this platform to submit detailed bug reports, including steps to reproduce the issue, expected behavior, and any additional relevant information.
      </p>
      <p class="card-text">What do you want to do?</p>
      <a href="?page=bug-report" class="btn btn-primary">Report a new bug</a>
      <a href="?page=bug-list" class="btn btn-success">View known bugs</a>
    </div>
  </div>
</div>

<?php include ("includes/footer.php") ?>