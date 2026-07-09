const { test, expect } = require('@playwright/test');

test('Smart Attendance Full E2E', async ({ page }) => {

    // مقادیر یکتا برای جلوگیری از تداخل با اجراهای قبلی تست
    const uniqueSuffix = Date.now();
    const teacherName = `Playwright Teacher ${uniqueSuffix}`;
    const studentName = `Playwright Student ${uniqueSuffix}`;
    const courseName = `Playwright Course ${uniqueSuffix}`;

    // ---------- Login ----------
    await page.goto('http://localhost:8080/smart-attendance/login.php');

    await page.fill('input[name="username"]', 'admin');
    await page.fill('input[name="password"]', '12');
    await page.click('button[type="submit"]');

    await expect(page).toHaveURL(/index\.php/);

    // ---------- Add Teacher ----------
    await page.click('text=افزودن استاد');

    await page.fill('input[name="teacher_code"]', `900${uniqueSuffix.toString().slice(-4)}`);
    await page.fill('input[name="full_name"]', teacherName);
    await page.fill('input[name="password"]', 'Playwright');
    await page.click('button[type="submit"]');

    // Teacher List
    await page.goto('http://localhost:8080/smart-attendance/teachers.php');
    await expect(page.locator('body')).toContainText(teacherName);

    // ---------- Add Student ----------
    await page.goto('http://localhost:8080/smart-attendance/add_student.php');

    await page.fill('input[name="student_code"]', `99${uniqueSuffix.toString().slice(-4)}`);
    await page.fill('input[name="full_name"]', studentName);
    await page.click('button[type="submit"]');

    // Student List
    await page.goto('http://localhost:8080/smart-attendance/students.php');
    await expect(page.locator('body')).toContainText(studentName);

    // ---------- Add Course ----------
    await page.goto('http://localhost:8080/smart-attendance/add_courses.php');

    await page.fill('input[name="Course_name"]', courseName);

    // انتخاب استادی که همین الان ساختیم (به‌جای index ثابت که ممکنه اشتباه باشه)
    await page.selectOption('select[name="teacher_id"]', { label: teacherName });

    await page.click('button[type="submit"]');

    // ---------- Course List ----------
    await page.goto('http://localhost:8080/smart-attendance/courses.php');
    await expect(page.locator('body')).toContainText(courseName);

    // پیدا کردن ردیفی که همین درس یکتا داخلش هست
    const row = page.locator('tbody tr').filter({
        has: page.locator('td', { hasText: courseName })
    });

    // مطمئن می‌شیم دقیقاً یک ردیف پیدا شده (اگه بیشتر بود، همینجا تست fail می‌شه با پیام واضح)
    await expect(row).toHaveCount(1);

    // کلیک مستقیم روی لینک به‌جای goto دستی با href
    await row.locator('a[href*="course_students.php"]').click();

    await expect(page).toHaveURL(/course_students\.php/);

    // ---------- Add Student to Course ----------
    await page.click('text=افزودن دانشجو');

    // انتخاب دانشجویی که همین الان ساختیم
    // چون متن option شامل کد دانشجویی هم هست (مثلاً "Playwright Student 123 (99456)")
    // نمی‌شه با label دقیق match کرد، پس اول value رو با متن جزئی پیدا می‌کنیم
    const studentOptionValue = await page
        .locator('select[name="student_id"] option', { hasText: studentName })
        .getAttribute('value');

    await page.selectOption('select[name="student_id"]', studentOptionValue);

    await page.click('button[type="submit"]');

    // بررسی نهایی
    await expect(page.locator('body')).toContainText(studentName);
});