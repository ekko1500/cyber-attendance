<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
/* Card Layout Styles */
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
.main-content {
            margin-left: 260px;
            overflow-y: auto;
            height: 100vh;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include 'sidebar.php'; ?>

   

    <main class="main-content" id="mainContent">
        <section class="card-layout" id="cardContainer">
            <div class="card" data-subject="cyber">
                <div class="card-image" style="background-color: #3ea046;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Cyber Security</a>
                    <p>Fourth Year</p>
                </div>
            </div>
            <div class="card" data-subject="embedded">
                <div class="card-image" style="background-color: #319795;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Embedded Systems</a>
                    <p>Final Year</p>
                </div>
            </div>
            <div class="card" data-subject="digital">
                <div class="card-image" style="background-color: #9f7aea;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Digital Design</a>
                    <p>Third Year</p>
                </div>
            </div>
            <div class="card" data-subject="cryptography">
                <div class="card-image" style="background-color: #f6e05e;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Cryptography</a>
                    <p>Fourth Year</p>
                </div>
            </div>
            <div class="card" data-subject="myanmar">
                <div class="card-image" style="background-color: #4299e1;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Myanmar</a>
                    <p>First Year</p>
                </div>
            </div>
            <div class="card" data-subject="english">
                <div class="card-image" style="background-color: #ed8936;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">English</a>
                    <p>Second Year</p>
                </div>
            </div>
            <div class="card" data-subject="math">
                <div class="card-image" style="background-color: #a0aec0;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Mathematics</a>
                    <p>First Year</p>
                </div>
            </div>
            <div class="card" data-subject="physics">
                <div class="card-image" style="background-color: #6b46c1;"></div>
                <div class="card-content">
                    <a href="#" class="card-link">Physics</a>
                    <p>Second Year</p>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>