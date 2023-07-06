<?php
$Common->protect("admin-is-logged");

include ("includes/acp-header.php");
include ("controllers/acp-view-bug.php");
?>

<link rel="stylesheet" href="theme/default/css/acp-home.css">

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bug Report #<?= $bugDetails['id'] ?></h1>
    </div>

    <div class="card">
        <div class="card-body">
            <?= $Common->getPriorityName($bugDetails['tags']) ." - <b>Bug status: </b>". $Common->getStatusName($bugDetails['status']) ?>
            <h5 class="card-title" style="margin-top: 40px;"><?= $bugDetails['title'] ?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Bug ID #<?= $bugDetails['id'] ?></h6>
            <p class="card-text">
                <hr>
                <b>Bug Description</b>
                <br />
                <?= nl2br($bugDetails['description']) ?>
            </p>

            <p class="card-text">
                <b>Resources</b><br />
                <?php echo (!empty($bugDetails['resources'])) ? nl2br($bugDetails['resources']) : "There are no resources to show."; ?>
            </p>
            <hr>
            <p>Posted by: <i><?= $bugDetails['author'] ?></i></p>
        </div>
    </div>

    <div class="card" style="margin-top: 20px">
        <div class="card-body">
            <h4>Edit bug status</h4>

            <?= $Database->userMessage($_SESSION['message']) ?>

            <form class="row g-3" method="POST" action="">
                <input type="hidden" value="<?= $bugDetails['id']; ?>" name="bugId">
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
                            Are you sure you want to <b>update</b> this Bug Report?
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
                            Are you sure you want to <b>delete</b> this Bug Report?
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
?>