<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./"><?= getenv('WEB_TITLE') ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="?page=new-issue">Report a bug</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=known-issues">View known bugs</a>
                </li>  
            </ul>
            <ul class="navbar-nav w-100 justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Member's Centre
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        if (isset($_SESSION['username']))
                        {
                        ?>
                        <li><a class="dropdown-item" href="?page=ucp">Account Panel</a></li>
                        <?php if ($_SESSION['rank'] >= 1){ echo "<li><a class='dropdown-item' href='admin'>Admin Panel</a></li>"; } ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="?page=logout">Logout</a></li>
                        <?php } else { ?>
                        <li><a class="dropdown-item" href="?page=register">Register</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="?page=login">Login</a></li>
                        <?php } ?>
                    </ul>
                </li>     
            </ul>              
        </div>
    </div>
</nav>