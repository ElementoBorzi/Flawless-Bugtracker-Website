<?php
$bugDetails = $Bugs->getBugDetails($_GET['id']);

foreach ($bugDetails as $bug)
{
    
?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
    <h1 style="margin-bottom: 50px;">WoWEmu 5.4.8 Repack Bug Reporter</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item"><a href="?page=list-bugs">Known bugs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bug ID #<?= $bug['id'] ?></li>
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
            <a href="?page=bugreport" class="btn btn-primary">Report a new bug</a>
            <a href="?page=list-bugs" class="btn btn-success">View known bugs</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?= $Common->getPriorityName($bug['tags']) ." - <b>Bug status: </b>". $Common->getStatusName($bug['status']) ?>
            <h5 class="card-title" style="margin-top: 40px;"><?= $bug['title'] ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Bug ID #<?= $bug['id'] ?></h6>
            <p class="card-text">
                <hr>
                <b>Bug Description</b>
                <br />
                <?= nl2br($bug['description']) ?>
            </p>

            <p class="card-text">
                <b>Resources</b><br />
                <?php
                if( empty($bug['resources']))
                {
                    echo "There are no resources to show.";
                } 
                else 
                {
                    echo nl2br($bug['resources']);
                }
                ?>
            </p>
            <hr>
            <p>Posted by: <i><?= $bug['author'] ?></i></p>
        </div>
    </div>
</div>

<?php } ?>