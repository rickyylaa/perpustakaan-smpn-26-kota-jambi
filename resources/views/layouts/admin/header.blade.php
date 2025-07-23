<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="nav-link" data-widget="pushmenu" role="button">
                <i class="fa-sharp fa-solid fa-bars"></i>
            </a>
        </li>
        <li class="nav-item align-content-center">
            <div class="font-weight-bold" style="font-size: 23px;letter-spacing: 3px;">
                <a href="{{ route('admin.dashboard') }}" class="text-dark">SMPN 26 KOTA JAMBI</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                Halo, {{ AuthAdmin()->getNama() }} <i class="fa-sharp fa-solid fa-user ml-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <span class="dropdown-item dropdown-header text-dark">
                    {{ AuthAdmin()->nama }}
                </span>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
                <a href="javascript:;" class="dropdown-item" onclick="document.getElementById('logout-form').submit();">
                    <i class="nav-icon fa-sharp fa-solid fa-arrow-right-from-bracket mr-2" style="font-size: 0.9rem;"></i>Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
