# Smart Attendance System

A web-based Smart Attendance System developed with PHP and MySQL.  
The system uses QR Codes to record student attendance and supports three user roles: **Admin**, **Teacher**, and **Student**.

---

## Features

- User Authentication
- Admin Panel
- Teacher Panel
- Student Panel
- QR Code Generation
- QR Code Attendance Scanning
- Course Management
- Student Enrollment
- Attendance Reports
- Unit Testing (PHPUnit)
- End-to-End Testing (Playwright)

---


## Database

Import the SQL database into MySQL and update the database configuration in:

```
db.php
```

Default database name:

```
attendancedb
```

---

## Running the Project

Place the project inside your web server directory.

Example (WAMP):

```
C:\wamp64\www\smart-attendance
```

Open the project in your browser:

```
http://localhost/smart-attendance/login.php
```

---

## Installing Composer Dependencies

If Composer dependencies are missing:

```bash
composer install
```

---

## Installing Node Dependencies

```bash
npm install
```

---

# Unit Tests

This project uses PHPUnit.

Run all unit tests:

```bash
vendor\bin\phpunit.bat tests
```

Example output:

```
OK (4 tests, 4 assertions)
```

---

# End-to-End Tests

This project uses Playwright.

Install dependencies:

```bash
npm install
```

Run all E2E tests:

```bash
npx playwright test
```

Run a specific test:

```bash
npx playwright test e2e.spec.js
```
---

## User Roles

### Admin

- Manage Teachers
- Manage Students
- Manage Courses
- Enroll Students
- View Attendance Reports

### Teacher

- Select Course
- Scan QR Codes
- View Course Students
- View Attendance Reports

### Student

- Login
- View Personal QR Code

---

## Author

Developed by Vahid Ghasemi.



----------------------------------------------------------------------------------------------
