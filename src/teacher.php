<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Teacher Management Dashboard</title>
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
            <h3 id="teacherTable">Teacher Management</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Teacher ID</th>
                        <th>Subject</th>
                        <th>NRC</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teachers as $index => $teacher): ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= htmlspecialchars($teacher['teacher_id']) ?></td>
                        <td><?= htmlspecialchars($teacher['subject']) ?></td>
                        <td><?= htmlspecialchars($teacher['nrc']) ?></td>
                        <td><?= htmlspecialchars($teacher['date_of_birth']) ?></td>
                        <td><?= htmlspecialchars($teacher['gender']) ?></td>
                        <td><?= htmlspecialchars($teacher['phone_number']) ?></td>
                        <td><?= htmlspecialchars($teacher['address']) ?></td>
                        <td>
                            <a href="?edit=<?= $teacher['id'] ?>#teacherForm" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-wrench fa-sm"></i>Update
                            </a>
                            <a href="?delete=<?= $teacher['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">
                                <i class="far fa-trash-alt"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4" id="teacherForm">
                <h4><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Teacher</h4>
                <?php
                $editTeacher = null;
                if(isset($_GET['edit'])){
                    $stmt = $pdo->prepare("SELECT * FROM teachers WHERE id=?");
                    $stmt->execute([$_GET['edit']]);
                    $editTeacher = $stmt->fetch();
                }
                ?>
                <form method="post">
                    <input type="hidden" name="teacherId" value="<?= $editTeacher['id'] ?? '' ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Teacher ID</label>
                            <input type="text" name="teacher_id" class="form-control" value="<?= $editTeacher['teacher_id'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?= $editTeacher['subject'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NRC</label>
                            <input type="text" name="nrc" class="form-control" value="<?= $editTeacher['nrc'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control" value="<?= $editTeacher['date_of_birth'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option <?= ($editTeacher['gender']??'')=='Male'?'selected':'' ?>>Male</option>
                                <option <?= ($editTeacher['gender']??'')=='Female'?'selected':'' ?>>Female</option>
                                <option <?= ($editTeacher['gender']??'')=='Other'?'selected':'' ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="<?= $editTeacher['phone_number'] ?? '' ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="<?= $editTeacher['address'] ?? '' ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="far fa-save"></i> Save Teacher
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
