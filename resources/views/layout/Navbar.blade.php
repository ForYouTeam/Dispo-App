<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto text-muted">
        <span>{{ config('app.name') }}</span>
    </form>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-16 fe-users"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#">
                <span class="fe fe-16 fe-power"></span>
            </a>
        </li>
    </ul>
</nav>
