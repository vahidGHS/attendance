<?php

include "db.php";

if (isset($_POST['submit'])) {

    $teacher_id = $_POST['teacher_id'];
    $Course_name = $_POST['Course_name'];

    $query = "INSERT INTO courses(course_name, teacher_code)
          VALUES('$Course_name', '$teacher_id')";
    mysqli_query($conn, $query);

    echo "درس با موفقیت اضافه شد";
}
$teachers = mysqli_query($conn, "SELECT id, full_name FROM teachers");
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>افزودن درس</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            font-family: "Vazirmatn", sans-serif;
        }

        .student-card {
            border: none;
            border-radius: 20px;
        }

        .save-btn {
            background-color: #4f8555;
            color: white;
            border: none;
        }

        .save-btn:hover {
            background-color: #3f6e45;
            color: white;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row vh-100 justify-content-center align-items-center">

            <div class="col-11 col-md-8 col-lg-5">

                <div class="card shadow student-card">

                    <div class="card-body p-4">

                        <h2 class="text-center mb-4">
                            افزودن درس
                        </h2>

                        <form method="POST">

                            <div class="mb-3">

                                <label class="form-label">
                                    نام درس
                                </label>

                                <input
                                    type="text"
                                    name="Course_name"
                                    class="form-control">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                 استاد
                                </label>
                                <select name="teacher_id" class="form-select">

                                    <?php while ($teacher = mysqli_fetch_assoc($teachers)) { ?>

                                        <option value="<?php echo $teacher['id']; ?>">

                                            <?php echo $teacher['full_name']; ?>

                                        </option>

                                    <?php } ?>

                                </select>

                            </div>

                            <button
                                type="submit"
                                name="submit"
                                class="btn save-btn w-100 py-2">
                                ذخیره درس
                            </button>

                        </form>

                        <hr>

                        <a
                            href="index.php"
                            class="btn btn-outline-secondary w-100">

                            بازگشت به داشبورد

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>