<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="?page=acp-home">Bugtracker</a>  
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="?page=logout">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Bugs Viewer</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=acp-home">
                            <span data-feather="users"></span>
                            New
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=acp-known-issues">
                            <span data-feather="home"></span>
                            All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=acp-fixed-issues">
                            <span data-feather="file"></span>
                            Fixed
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=acp-valid-issues">
                            <span data-feather="shopping-cart"></span>
                            Pending
                        </a>
                    </li>
                </ul>
            </div>
        </nav>