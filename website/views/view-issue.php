<?php
//Load Controller
Application::loadController("view-issue");

// Load Include files
Application::loadView("header-inc");
Application::loadView("menu-inc");
?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
    <h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=known-issues">Known bugs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bug ID #<?= bugDetails['id'] ?></li>
        </ol>
    </nav>
    <hr />


    <div class="card" style="margin-bottom: 30px;">
        <div class="card-body">
            <h5 class="card-title">Can't find the bug you want to report?</h5>
            <p class="card-text">
                If you wish to submit a bug report that you can't find on the list, please click on the button bellow. Else, you can go back 
                to the list and search for the bug you're looking for.
            </p>
            <a href="?page=new-issue" class="btn btn-primary">Report a new bug</a>
            <a href="?page=known-issues" class="btn btn-success">View known bugs</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?= Common::getPriorityName(bugDetails['tags']) ." - <b>Bug status: </b>". Common::getStatusName(bugDetails['status']) ?>
            <h5 class="card-title" style="margin-top: 40px;"><?= bugDetails['title'] ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Bug ID #<?= bugDetails['id'] ?></h6>
            <p class="card-text">
                <hr>
                <b>Bug Description</b>
                <br />
                <?= nl2br(bugDetails['description']) ?>
            </p>

            <p class="card-text">
                <b>Resources</b><br />
                <?php echo (!empty(bugDetails['resources'])) ? nl2br(bugDetails['resources']) : "There are no resources to show."; ?>
            </p>
            <hr>
            <p>Posted by: <i><?= bugDetails['author'] ?></i></p>
        </div>
    </div>
</div>

<?php

// Load Include files
Application::loadView("footer-inc");

?>