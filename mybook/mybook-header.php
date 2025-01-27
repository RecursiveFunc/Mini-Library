<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo BASE_URL . 'main/main.php'; ?>">
            <img src="../images/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            Mini Library
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . 'main/main.php'; ?>"><i class="bi bi-house"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo BASE_URL . 'mybook/book.php'; ?>"><i class="bi bi-book"></i> Buku Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . 'addbook/addbook.php'; ?>"><i class="bi bi-plus-circle"></i> Tambah Buku</a>
                </li>
            </ul>
            <form class="d-flex" action="<?php echo BASE_URL . 'searchbook.php'; ?>" method="GET" onsubmit="return false;"> 
                <input class="form-control me-2" type="search" placeholder="Cari Buku atau Penulis..." name="query" id="searchBox" aria-label="Search" oninput="searchBooks(this.value)">
                <button class="btn btn-outline-success" type="button" onclick="searchBooks(document.getElementById('searchBox').value)">Cari</button>
                <div id="dropdownResult" class="dropdown-menu" style="display: none;"></div>
            </form>
            <a href="<?php echo BASE_URL . 'regis/logout.php'; ?>" class="btn btn-danger ms-3">Log Out</a>
        </div>
    </div>
</nav>