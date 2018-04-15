<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <?php if (!session()->isLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fa fa-home"></i> Home
                </a>
            </li>
            <?php endif; ?>
            <?php if (session()->isLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/tasks">
                    <i class="fa fa-tasks"></i> Tasks
                </a>
            </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (!session()->isLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/login">
                    <i class="fa fa-sign-in"></i> Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">
                    <i class="fa fa-user-plus"></i> Register
                </a>
            </li>
            <?php endif; ?>
            <?php if (session()->isLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>