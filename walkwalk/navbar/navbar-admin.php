<nav class="navbar bg-success bg-gradient navbar-expand-lg navbar-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="app?page=home">WalkWalk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "home" ? "active":""; ?> " aria-current="page" href="?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "kelola-wisata" ? "active":""; ?>" aria-current="page" href="?page=kelola-wisata&a1=data-wisata">Kelola Tempat Wisata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "kelola-penginapan" ? "active":""; ?>" aria-current="page" href="?page=kelola-penginapan&a1=data-penginapan">Kelola Penginapan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "kelola-kamar" ? "active":""; ?>" aria-current="page" href="?page=kelola-kamar&a1=data-kamar">Kelola Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "bukti-pembayaran" ? "active":""; ?> " aria-current="page" href="?page=bukti-pembayaran">Bukti Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $_GET["page"] == "kelola-metode-pembayaran" ? "active":""; ?> " aria-current="page" href="?page=kelola-metode-pembayaran&a1=data-metode">Metode Pembayaran</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> -->
            </ul>
            <form class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-success bg-gradient dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $admin->username;?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="?process=logout">Log Out</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</nav>