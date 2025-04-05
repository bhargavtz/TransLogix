<?php
session_start();
require_once 'config.php';

// Debugging: Check if the connection is established
if (!isset($conn)) {
    die("Database connection (\$conn) is not set. Check your config.php file.");
}

// Initialize error variable
$login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_identifier = $_POST['login_identifier'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    // Determine if input is email or username
    $is_email = filter_var($login_identifier, FILTER_VALIDATE_EMAIL);

    if ($userType === 'admin') {
        $sql = "SELECT id, username, password FROM admin_users WHERE username = ?";
    } else {
        if ($is_email) {
            $sql = "SELECT id, username, password FROM users WHERE email = ?";
        } else {
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
        }
    }
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $login_identifier);

    if ($stmt) {
        $stmt->bind_param("s", $login_identifier);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                if ($userType === 'admin') {
                    $_SESSION['admin_loggedin'] = true;
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['admin_id'] = $row['id'];
                    header("location: admin/dashboard.php");
                } else {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                    header("location: userdashboard.php");
                }
                exit;
            } else {
                $login_err = "Invalid password.";
            }
        } else {
            $login_err = "Invalid username or email.";
        }
    } else {
        die("Prepare failed: " . $conn->error);
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TransLogix</title>
    <!-- filepath: c:\xampp\htdocs\TransLogix\login.php -->
<link rel="stylesheet" href="/TransLogix/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            color: #333;
            background: linear-gradient(135deg, #f9e7bb, #e97cbb, #3d47d9);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        .wrapper {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 30px;
            margin: 20px;
            border: 1px solid #ddd;
            animation: fadeIn 1s ease-in;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(118, 75, 162, 0.5);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(118, 75, 162, 0.3);
        }
        .form-check-label {
            color: #666;
        }
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="wrapper animate__animated animate__fadeIn">
        <h2 class="text-center mb-4">Login</h2>
        
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>User Type</label>
                <select name="user_type" class="form-control" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email or Username</label>
                <input type="text" name="login_identifier" class="form-control" placeholder="Enter email or username" required>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="login-options">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <p class="text-center">Don't have an account? <a href="signup.php">Sign up now</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const html = document.documentElement;

    darkModeToggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        localStorage.setItem('darkMode', html.classList.contains('dark'));
    });

    if (localStorage.getItem('darkMode') === 'true') {
        html.classList.add('dark');
    }
</script>
</body>
</html>
