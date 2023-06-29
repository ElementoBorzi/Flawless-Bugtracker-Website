<div class="container shadow col-xl-10 col-xxl-8 px-4 py-5" style="margin: 100px auto;">
<h1 style="margin-bottom: 50px;"><?= HEADER ?></h1>
<?php
if (!empty($_POST['submit'])) 
{
    if(!empty($_POST['title']) && !empty($_POST['description'])) 
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $resources = $_POST['proof'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $tags = $_POST['tags'];
        
        $Bugs->insertBugs($title, $description, $resources, $author, $category, $tags);
    } 
    else 
    {
        echo "<div class='alert alert-danger' role='alert'>In order to submit the report you need to fill in all fields.</div>";
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
        Please, before reporting a bug make sure that it isn't already reported. You can view a list of already reported bugs and their status by
        clicking on the button bellow.<br /><br />
        <b>Also, make sure to use the following bug report:</b> <br /><br />
        <code>
            [Location, Faction, Race] Map name, Area name if possible, Player faction and race. If applicable include the gender as well <br/>
            [Name, Type] Robes of the Tendered Heart, Item<br/>
            [Problem Description] Describe the problem here and give us as much information as possible<br/>
            [How it should work] Tell us how it should work<br/><br/>
        </code>
        Introduce as many information as you can, and, if possible, add a screenshot or a video as proof. <br/>
        Thank you!
    </p>
    <a href="?page=list-bugs" target="_blank" class="btn btn-success">View known bugs</a>
  </div>
</div>

<form class="row g-3" method="POST" action="" onsubmit="return validate();">
    <div class="col-12">
        <label for="Title">Title</label>
        <input type="text" class="form-control" name="title" id="Title" maxlength="50" placeholder="Enter bug title." required>
        <div id="TitleHelp" class="form-text">Required field.</div>
    </div>

    <div class="col-12">
        <label for="Description">Description</label>
        <textarea class="form-control" name="description" id="Description" maxlength="5000" rows="10" required></textarea>
        <div id="DescriptionHelp" class="form-text">Required field.</div>
    </div>

    <div class="col-12">
        <label for="Proof">Resources</label>
        <textarea class="form-control" name="proof" id="Proof" maxlength="500" rows="6"></textarea>
    </div>

    <div class="col-md-4">
        <label for="Category">Category</label>
        <select class="form-control" id="Category" name="category">
            <?php foreach ($Bugs->getCategories() as $categories) { ?>
                <option value="<?=$categories['id']; ?>"><?=$categories['name']; ?></option>
            <?php } ?>
        </select>
        <div id="CategoryHelp" class="form-text">Required field.</div>
    </div>

    <div class="col-md-4">
        <label for="Priority">Priority</label>
        <select class="form-control" id="Priority" name="tags">
            <?php foreach ($Bugs->getTags() as $tags) { ?>
                <option value="<?=$tags['id']; ?>"><?=$tags['name']; ?></option>
            <?php } ?>
        </select>
        <div id="PriorityHelp" class="form-text">Required field.</div>
    </div>

    <div class="col-md-4">
        <label for="Author">Author</label>
        <input type="text" class="form-control" name="author" id="Author" maxlength="50" placeholder="If anonymous, leave empty.">
    </div>

    <div class="col-md-12">
        <input type="submit" class="btn btn-primary" name="submit" value="Submit this bug!"/>
    </div>
</form>

<script>
function validate() 
{
    var title = document.getElementById('Title').value;
    var description = document.getElementById('Description').value;
    var proof = document.getElementById('Proof').value;
    var author = document.getElementById('Author').value;
                
    if (title.length > 50) 
    {
        alert("Title field contains more than 50 characters!");
        return false; // keep form from submitting
    }

    if (description.length > 5000) 
    {
        alert("Description field contains more than 5000 characters!");
        return false; // keep form from submitting
    }

    if (proof.length > 500) 
    {
        alert("Resources field contains more than 500 characters!");
        return false; // keep form from submitting
    }

    if (author.length > 50) 
    {
        alert("Author field contains more than 50 characters!");
        return false; // keep form from submitting
    }
    
    return true;
}
</script>
</div>