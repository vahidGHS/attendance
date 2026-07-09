<?php

require_once "db.php";

$course_id = $_GET['course'];

// ثبت دانشجوی انتخاب‌شده در درس
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_id = $_POST['student_id'];

    // جلوگیری از ثبت تکراری
    $check = mysqli_query($conn, "
        SELECT * FROM student_courses
        WHERE student_id = $student_id
        AND course_id = $course_id
    ");

    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "
            INSERT INTO student_courses (student_id, course_id)
            VALUES ($student_id, $course_id)
        ");
    }

    header("Location: course_students.php?id=" . $course_id);
    exit;
}

// اطلاعات درس
$course = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT course_name FROM courses WHERE id = $course_id
"));

// دانشجویانی که هنوز در این درس ثبت‌نام نکردن
$students = mysqli_query($conn, "
    SELECT id, student_code, full_name
    FROM students
    WHERE id NOT IN (
        SELECT student_id FROM student_courses WHERE course_id = $course_id
    )
    ORDER BY full_name
");

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>افزودن دانشجو</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .card {
            border: none;
            border-radius: 18px;
        }
    </style>

</head>

<body>

    <div class="container py-5">

        <div class="card shadow">

            <div class="card-body">

                <h3 class="mb-4">
                    افزودن دانشجو به درس: <?php echo $course['course_name']; ?>
                </h3>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">انتخاب دانشجو</label>
                        <select name="student_id" class="form-select" required>
                            <option value="" disabled selected>-- انتخاب کنید --</option>
                            <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['full_name']; ?> (<?php echo $row['student_code']; ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">ثبت</button>
                    <a href="course_students.php?id=<?php echo $course_id; ?>" class="btn btn-outline-secondary">انصراف</a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>