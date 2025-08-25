<?php
ob_start();
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">School Management</a>
        <div class="d-flex align-items-center ms-auto">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-light me-4"><i class="bi bi-search"></i></button>
            <div class="text-white d-flex gap-4 me-4">
                <span><i class="bi bi-people-fill"></i> Students <span class="badge bg-light text-dark">1738</span></span>
                <span><i class="bi bi-person-video2"></i> Teachers <span class="badge bg-light text-dark">0</span></span>
                <span><i class="bi bi-briefcase-fill"></i> Staff <span class="badge bg-light text-dark">165</span></span>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form method="post" action="logout.php" class="d-inline">
                    <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                <a href="register.php" class="btn btn-warning">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

