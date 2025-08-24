<?php
require_once('./db/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['studentId'] ?? '';
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $dob = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $nrc = $_POST['nrc'];

    if ($id) {
        // Update existing student
        $stmt = $pdo->prepare("UPDATE students SET student_id=?, name=?, class=?, date_of_birth=?, gender=?, address=?, phone_number=?, nrc=? WHERE id=?");
        $stmt->execute([$student_id, $name, $class, $dob, $gender, $address, $phone_number, $nrc, $id]);
    } else {
        // Add new student
        $stmt = $pdo->prepare("INSERT INTO students (student_id, name, class, date_of_birth, gender, address, phone_number, nrc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $name, $class, $dob, $gender, $address, $phone_number, $nrc]);
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all students
$stmt = $pdo->query("SELECT * FROM students ORDER BY id ASC");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Management Dashboard</title>
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
</head>
<body class="bg-light">

<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<div class="container-fluid">
    <div class="row">
        

        <div class="col-md-10 offset-md-2 p-4 main-content">
            <h3 id="studentTable">Student Management</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>NRC</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= htmlspecialchars($student['student_id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['class']) ?></td>
                        <td><?= htmlspecialchars($student['date_of_birth']) ?></td>
                        <td><?= htmlspecialchars($student['gender']) ?></td>
                        <td><?= htmlspecialchars($student['phone_number']) ?></td>
                        <td><?= htmlspecialchars($student['address']) ?></td>
                        <td><?= htmlspecialchars($student['nrc']) ?></td>
                        <td>
                            <a href="?edit=<?= $student['id'] ?>#studentForm" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-wrench fa-sm"></i>Update
                            </a>
                            <a href="?delete=<?= $student['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                <i class="far fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4" id="studentForm">
                <h4><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Student</h4>
                <?php
                $editStudent = null;
                if(isset($_GET['edit'])){
                    $stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
                    $stmt->execute([$_GET['edit']]);
                    $editStudent = $stmt->fetch();
                }
                ?>
                <form method="post">
                    <input type="hidden" name="studentId" value="<?= $editStudent['id'] ?? '' ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Student ID</label>
                            <input type="text" name="student_id" class="form-control" value="<?= $editStudent['student_id'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $editStudent['name'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Class</label>
                            <input type="text" name="class" class="form-control" value="<?= $editStudent['class'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="<?= $editStudent['date_of_birth'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option <?= ($editStudent['gender']??'')=='Male'?'selected':'' ?>>Male</option>
                                <option <?= ($editStudent['gender']??'')=='Female'?'selected':'' ?>>Female</option>
                                <option <?= ($editStudent['gender']??'')=='Other'?'selected':'' ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="<?= $editStudent['phone_number'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Section</label>
                            <input type="text" name="section" class="form-control" value="<?= $editStudent['section'] ?? '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Enrollment Date</label>
                            <input type="date" name="enrollment_date" class="form-control" value="<?= $editStudent['enrollment_date'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select Status</option>
                                <option <?= ($editStudent['status']??'')=='active'?'selected':'' ?>>active</option>
                                <option <?= ($editStudent['status']??'')=='inactive'?'selected':'' ?>>inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NRC</label>
                            <input type="text" name="nrc" class="form-control" value="<?= $editStudent['nrc'] ?? '' ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?= $editStudent['address'] ?? '' ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="far fa-save"></i> Save Student
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
