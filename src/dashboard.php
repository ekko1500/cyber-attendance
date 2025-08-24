<?php

// $host = 'localhost';
// $db = 'cyber';
// $user = 'root';
// $pass = '';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $options = [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// ];

// try {
//     $pdo = new PDO($dsn, $user, $pass, $options);
// } catch (PDOException $e) {
//     die("Database connection failed: " . $e->getMessage());
// }
require_once('./db/connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['teacherId'] ?? '';
    $teacher_id = $_POST['teacher_id'];
    $subject = $_POST['subject'];
    $nrc = $_POST['nrc'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    if ($id) {
        // Update existing teacher
        $stmt = $pdo->prepare("UPDATE teachers SET teacher_id=?, subject=?, nrc=?, date_of_birth=?, gender=?, address=?, phone_number=? WHERE id=?");
        $stmt->execute([$teacher_id, $subject, $nrc, $dob, $gender, $address, $phone_number, $id]);
    } else {
        // Add new teacher
        $stmt = $pdo->prepare("INSERT INTO teachers (teacher_id, subject, nrc, date_of_birth, gender, address, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$teacher_id, $subject, $nrc, $dob, $gender, $address, $phone_number]);
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}


if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM teachers WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all teachers
$stmt = $pdo->query("SELECT * FROM teachers ORDER BY id ASC");
$teachers = $stmt->fetchAll();

// Add chart for student attendance by year
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>School Management Dashboard</title>
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
        overflow-y: auto;
        height: 100vh;
    }
</style>

<body class="bg-light">

<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php'; ?>
        <div class="col-md-10 offset-md-2 p-4 main-content">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card bg-white shadow-sm rounded">
                        <div class="card-body">
                            <h5 class="card-title">Student Attendance by Year</h5>
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year'],
            datasets: [{
                label: 'Attendance',
                data: [120, 110, 130, 115, 105],
                backgroundColor: 'rgba(78, 115, 223, 0.5)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
