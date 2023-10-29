<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        // SQL statement to retrieve data
        $sql = "SELECT email, password, role FROM users WHERE email=$1;";
        
        // Use prepared statement to prevent SQL injection
        $stmt = pg_prepare($conn, "auth_query", $sql);
        
        if (!$stmt) {
            echo "Query preparation failed.";
            exit();
        }

        $result = pg_execute($conn, "auth_query", array($email));

        if (!$result) {
            echo "Invalid email";
            exit();
        } else {
            // Fetching data from a row after querying database.
            $row = pg_fetch_assoc($result);

            if ($row != null) {
                $dbemail = $row['email'];
                $dbpassword = $row['password'];
                $dbrole = $row['role'];

                if (password_verify($password, $dbpassword) && strcmp($dbemail, $email) == 0) {
                    if ($dbrole == 'user') {
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header("Location: ../home.php");
                        exit();
                    } elseif ($dbrole == 'admin') {
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header("Location: ../addSite.php"); // Redirect to a page for adding new sites
                        exit();
                    } else {
                        // Not a valid user. Must deny the user access or redirect to the same login page.
                        header("Location: signin.php");
                        exit();
                    }
                } elseif (!(password_verify($password, $dbpassword))) {
                    echo "Failed to sign in. Password is invalid.";
                } else {
                    echo "Please check your credentials.";
                }
            } else {
                echo "Invalid email";
            }
        }
    }
}

pg_close($conn);
?>
