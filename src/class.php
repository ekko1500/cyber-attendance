<!DOCTYPE html>
<html lang="my">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
    .navbar {
        padding: 1rem 2rem;
    }
    .navbar-brand {
        font-size: 1.5rem;
    }
    .form-control {
        width: auto;
    }
    .btn {
        margin-left: 0.5rem;
    }
    .text-white {
        display: flex;
        align-items: center;
    }
    .badge {
        margin-left: 0.5rem;
    }
    .nav-link { padding-top: 0.4rem; padding-bottom: 0.4rem; color: white; }
    .nav-link:hover { background-color: #f1f1f1; border-radius: 5px; color: black; }
    .btn i { margin-right: 5px; }
    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1;
        border-radius: 0.2rem;
    }
    .bg-primary { background-color: #4e73df !important; }
    .bg-light { background-color: #f8f9fa !important; }
    .bg-white { background-color: white !important; }
    .shadow-sm { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; }
    .rounded { border-radius: .25rem !important; }
    .table-striped > tbody > tr:nth-of-type(odd) {
        --bs-table-accent-bg: #f2f2f2;
    }
    .table thead th {
        background-color: #cdd8f6;
        color: #495057;
        border-top: 1px solid #e3e6f0;
        border-color: #a3b6ee;
    }
    .main-content {
        margin-left: 260px;
        overflow-y: auto;
        height: 100vh;
        padding: 20px;
    }
    .card-layout {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-image {
        height: 150px;
    }
    .card-content {
        padding: 15px;
    }
    .card-content p {
        margin: 0;
        padding-top: 5px;
        color: #4a5568;
    }
    .card-link {
        font-size: 18px;
        font-weight: bold;
        color: #2b80c5;
        text-decoration: none;
        display: block;
        margin-bottom: 5px;
    }
    .card-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>

    <main class="main-content" id="mainContent">
        <section class="card-layout" id="cardContainer">
            <div class="card" data-year="year1">
                <div class="card-image" style="background-color: #e53e3e;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">First Year</a>
                </div>
            </div>
            <div class="card" data-year="year2">
                <div class="card-image" style="background-color: #38b2ac;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Second Year</a>
                </div>
            </div>
            <div class="card" data-year="year3">
                <div class="card-image" style="background-color: #6b46c1;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Third Year</a>
                </div>
            </div>
            <div class="card" data-year="year4">
                <div class="card-image" style="background-color: #f6e05e;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Fourth Year</a>
                </div>
            </div>
            <div class="card" data-year="final">
                <div class="card-image" style="background-color: #9f7aea;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Final Year</a>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>