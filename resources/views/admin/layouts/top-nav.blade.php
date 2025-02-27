<style>
    .admin {
        margin: 20px 0px;
        text-align: center;
    }

    .admin img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
        margin-bottom: 10px;

    }

</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if(session()->has('user'))
                <div class="admin">
                    <img src="{{asset(session('user')->image)}}" alt="">
                    <h4>{{ session('user')->name }}</h4>
                    <h6>{{ session('user')->email }}</h6>
                </div>
                @else
                <p>User Not Found</p>
                @endif
                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('logout') }}" class="btn btn-danger w-50 mb-4">Log Out</a>
                </div>
            </div>
        </li>


    </ul>
</nav>
