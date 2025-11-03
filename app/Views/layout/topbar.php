<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?= session()->get('nama') ?? 'User' ?>
                        </span>
                        <i class="fas fa-user-circle"></i>
                    </a>
                </li>
            </ul>
        </nav>