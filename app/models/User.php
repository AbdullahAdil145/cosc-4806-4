<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
    }

    public function test () {
        $db = db_connect();
        $statement = $db->prepare("select * from users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if (isset($_SESSION['lockout'])) {
            if (time() < $_SESSION['lockout']) {
                $remaining = $_SESSION['lockout'] - time();
                echo "<div id='lockoutMsg'>You have made 3 wrong attempts. Please wait <span id='countdown'>$remaining</span> seconds.</div>";
                echo "<script>
                    var remaining = $remaining;
                    var countdownEl = document.getElementById('countdown');
                    var interval = setInterval(function() {
                        remaining--;
                        if (remaining <= 0) {
                            clearInterval(interval);
                            window.location.href = '/login';
                        } else {
                            countdownEl.textContent = remaining;
                        }
                    }, 1000);
                </script>";
                die;
            } else {
                unset($_SESSION['lockout']);
                unset($_SESSION['failedAuth']);
            }
        }

        if (password_verify($password, $rows['password'])) {
            $log = $db->prepare("INSERT INTO logins (username, attempt, time) VALUES (:username, 'good', NOW())");
            $log->bindValue(':username', $username);
            $log->execute();

            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            unset($_SESSION['failedAuth']);
            unset($_SESSION['lockout']);
            header('Location: /home');
            die;
        } else {
            $log = $db->prepare("INSERT INTO logins (username, attempt, time) VALUES (:username, 'bad', NOW())");
            $log->bindValue(':username', $username);
            $log->execute();

            if (isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']++;
                if ($_SESSION['failedAuth'] >= 3) {
                    $_SESSION['lockout'] = time() + 60;
                    $remaining = 60;
                    echo "<div id='lockoutMsg'>You have made 3 wrong attempts. Please wait <span id='countdown'>$remaining</span> seconds.</div>";
                    echo "<script>
                        var remaining = $remaining;
                        var countdownEl = document.getElementById('countdown');
                        var interval = setInterval(function() {
                            remaining--;
                            if (remaining <= 0) {
                                clearInterval(interval);
                                window.location.href = '/login';
                            } else {
                                countdownEl.textContent = remaining;
                            }
                        }, 1000);
                    </script>";
                    die;
                }
            } else {
                $_SESSION['failedAuth'] = 1;
            }

            $_SESSION['loginError'] = "Wrong username or password entered.";
            header('Location: /login');
            die;
        }
    }

    public function create($username, $password) {
        $username = strtolower($username);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashedPassword);
        $statement->execute();
    }
}
