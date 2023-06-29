<?php
if(isset($_SESSION['email']))
{

$bugDetails = $Bugs->getBugDetails($_GET['id']);

foreach ($bugDetails as $bug)
{
    
?>

<link rel="stylesheet" href="theme/default/css/acp-home.css">

<?php include("includes/acp-header.php"); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bug Report #<?= $bug['id'] ?></h1>
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


    <div class="card" style="margin-top: 20px">
        <div class="card-body">
            <h4>Edit bug status</h4>

            <?php

            if(isset($_POST['submit']))
            {
                $Bugs->updateBug($_POST['bugId'], $_POST['category'], $_POST['tags'], $_POST['status']);
            }

            if(isset($_POST['delete']))
            {
                $Bugs->deleteBug($_POST['bugId']);
            }

            ?>

            <form class="row g-3" method="POST" action="">
                <input type="hidden" value="<?= $bug['id']; ?>" name="bugId">
                <div class="col-md-12">
                    <label for="Category">Category</label>
                    <select class="form-control" id="Category" name="category">
                        <?php foreach ($Bugs->getCategories() as $categories) { ?>
                            <option value="<?=$categories['id']; ?>"><?=$categories['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="Priority">Priority</label>
                    <select class="form-control" id="Priority" name="tags">
                        <?php foreach ($Bugs->getTags() as $tags) { ?>
                            <option value="<?=$tags['id']; ?>"><?=$tags['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="Status">Status</label>
                    <select class="form-control" id="Status" name="status">
                        <?php foreach ($Bugs->getStatus() as $status) { ?>
                            <option value="<?=$status['id']; ?>"><?=$status['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitChanges">
                        Update
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBug">
                        Delete
                    </button>
                </div>

                
                <div class="modal fade" id="submitChanges" tabindex="-1" aria-labelledby="submitChanges" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitChanges">Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to update Bug Report #<?= $bug['id'] ?>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary me-5" name="submit" value="Update"/>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteBug" tabindex="-1" aria-labelledby="deleteBug" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteBug">Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to <b>delete</b> Bug Report #<?= $bug['id'] ?>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                        </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
include("includes/acp-footer.php");
}
} 
else
{
    header("location: ?page=home");
}
?>