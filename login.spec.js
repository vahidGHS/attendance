/* const { test, expect } = require('@playwright/test');

test('Full Smart Attendance Flow', async ({ page }) => {

    // =========================
    // Login Admin
    // =========================

    await page.goto('http://localhost:8080/smart-attendance/login.php');

    await page.fill('input[name="username"]', 'admin');

    await page.fill('input[name="password"]', '12');

    await page.click('button[type="submit"]');

    await expect(page).toHaveURL(/index.php/);


    // =========================
    // Add Student
    // =========================

    await page.goto('http://localhost:8080/smart-attendance/add_student.php');

    const studentCode = 'PW' + Date.now();

    await page.fill('input[name="student_code"]', studentCode);

    await page.fill('input[name="full_name"]', 'Playwright Student');

    await page.click('button[type="submit"]');


    // =========================
    // Add Teacher
    // =========================

    await page.goto('http://localhost:8080/smart-attendance/add_teacher.php');

    const teacherCode = 'T' + Date.now();

    await page.fill('input[name="teacher_code"]', teacherCode);

    await page.fill('input[name="full_name"]', 'Playwright Teacher');

    await page.fill('input[name="password"]', '123456');

    await page.click('button[type="submit"]');


    // =========================
    // Add Course
    // =========================

    await page.goto('http://localhost:8080/smart-attendance/add_course.php');

    const courseName = 'Playwright Course';

    await page.fill('input[name="Course_name"]', courseName);

    await page.fill('input[name="teacher_code"]', teacherCode);

    await page.click('button[type="submit"]');


    // =========================
    // Open Courses Page
    // =========================

    await page.goto('http://localhost:8080/smart-attendance/courses.php');

    await expect(page.locator('body'))
        .toContainText(courseName);


    // =========================
    // Screenshot
    // =========================

    await page.screenshot({
        path: 'screenshots/full-system.png',
        fullPage: true
    });

}); */