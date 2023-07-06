<?php include("includes/header.php"); ?>

<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
    <h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>
    <?php
    if (!empty($_POST['submit']))
    {
        if (!empty($_POST['title']) && !empty($_POST['description'])) {
            $confirmCaptcha = $Common->verifyCaptcha($_POST['captcha']);

            if ($confirmCaptcha) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $resources = $_POST['proof'];
                $author = $_POST['author'];
                $category = $_POST['category'];
                $tags = $_POST['tags'];

                $Bugs->insertBugs($title, $description, $resources, $author, $category, $tags);
            } else {
                echo "<div class='alert alert-danger' role='alert'>Incorrect captcha. Please try again.</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            In order to submit the report you need to fill in all fields.
            </div>";
        }
    }
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report a bug</li>
        </ol>
    </nav>
    <hr />

    <div class="card" style="margin-bottom: 30px;">
        <div class="card-body">
            <h5 class="card-title">Before you report a bug..</h5>
            <p class="card-text">
                Please, before reporting a bug make sure that it isn't already reported.
                You can view a list of already reported bugs and their status by
                clicking on the button below.<br /><br />
                <b>Also, make sure to use the following bug report:</b> <br /><br />
                <code>
                    [Location, Faction, Race] Map name, Area name if possible, Player faction and race.
                    If applicable include the gender as well <br/>
                    [Name, Type] Robes of the Tendered Heart, Item<br/>
                    [Problem Description] Describe the problem here and give us as much information as possible<br/>
                    [How it should work] Tell us how it should work<br/><br/>
                </code>
                Introduce as much information as you can, and, if possible, add a screenshot or a video as proof. <br/>
                Thank you!
            </p>
            <a href="?page=bug-list" target="_blank" class="btn btn-success">View known bugs</a>
        </div>
    </div>

    <form class="row g-3" method="POST" action="" onsubmit="return validate();">
        <div class="col-12">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" id="Title" maxlength="50"
            placeholder="Enter bug title." required>
            <div id="TitleHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-12">
            <label for="Description">Description</label>
            <textarea class="form-control" name="description" id="Description" maxlength="5000"
            rows="10" required></textarea>
            <div id="DescriptionHelp" class="form-text```php">Required field.</div>
        </div>

        <div class="col-12">
            <label for="Proof">Resources</label>
            <textarea class="form-control" name="proof" id="Proof" maxlength="500" rows="6"></textarea>
        </div>

        <div class="col-md-4">
            <label for="Category">Category</label>
            <select class="form-control" id="Category" name="category">
                <?php foreach ($Bugs->getCategories() as $categories) { ?>
                    <option value="<?= $categories['id']; ?>"><?= $categories['name']; ?></option>
                <?php } ?>
            </select>
            <div id="CategoryHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-md-4">
            <label for="Priority">Priority</label>
            <select class="form-control" id="Priority" name="tags">
                <?php foreach ($Bugs->getTags() as $tags) { ?>
                    <option value="<?= $tags['id']; ?>"><?= $tags['name']; ?></option>
                <?php } ?>
            </select>
            <div id="PriorityHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-md-4">
            <label for="Author">Author</label>
            <?php
            if (isset($_SESSION['email'])) {
                echo "<input type='text' class='form-control' id='Author' name='author'
                placeholder='" . $_SESSION['username'] . "' readonly>";
            } else {
                echo "<input type='text' class='form-control' id='Author' name='author' placeholder='Anonymous' readonly>";
            }
            ?>
        </div>
        <div class="col-md-12">
            <!-- Don't want users to be able to highlight the captcha -->
            <label for="Captcha" class="input-group-text w-100 rounded-0 rounded-top text-center d-block"
            style="-webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE 10+ */
            user-select: none;">
                <?= $Common->generateCaptcha(CAPTCHA); ?>
            </label>

            <input type="hidden" value="<?= $_SESSION['captcha'] ?>" id="captchaValue">

            <input type="text" class="form-control rounded-0 rounded-bottom" placeholder="Captcha"
                name="captcha" id="Captcha" maxlength="<?= CAPTCHA ?>" required>

            <div id="PriorityHelp" class="form-text">Required field.</div>
        </div>

        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit this bug!" />
        </div>

        <script src="pages/js/new-bug.js"></script>
    </form>
</div>