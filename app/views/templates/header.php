<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <link rel="stylesheet" href="/public/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
</head>
<body>
    <nav>
            <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center;">
              <div class="nav-left">
                <a class="nav-brand" href="/">COSC 4806 - Assignment 4 - Muhammad Abdullah Adil</a>
              </div>
              <div class="nav-right" style="display: flex; align-items: center; gap: 20px;">
                <a href="/home">Home</a>
                <a href="/about">About Me</a>
                <a href="/reminders">Reminders</a>
                <a href="/blog">Blog</a>
                <a href="/logout">Logout</a>
                <label class="switch" style="margin-bottom: 0;">
                  <input type="checkbox" id="themeToggle">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>

        </div>
    </nav>

    <script>
      const toggle = document.getElementById('themeToggle');

      if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        toggle.checked = true;
      }

      toggle.addEventListener('change', function () {
        if (this.checked) {
          document.body.classList.add('dark-mode');
          localStorage.setItem('theme', 'dark');
        } else {
          document.body.classList.remove('dark-mode');
          localStorage.setItem('theme', 'light');
        }
      });
    </script>
