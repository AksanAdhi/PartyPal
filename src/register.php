<?php
$servername =  "localhost";
$username = "root";
$password = "";
$dbname = "partypal."; // Ganti dengan nama database Anda
$test;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $username = $password = $confirm_password = $role = "";
$email_err = $username_err = $password_err = $confirm_password_err = $role_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validasi username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validasi password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validasi konfirmasi password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validasi role
    if (empty($_POST["role"])) {
        $role_err = "Please select a role.";
    } else {
        $role = trim($_POST["role"]);
    }

    // Cek input error sebelum memasukkan ke database
    if (empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($role_err)) {
        $sql = "INSERT INTO users (email, username, password, role) VALUES (?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $param_email, $param_username, $param_password, $param_role);
            
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
            $param_role = $role;

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <div>
        <h2>Register</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>    
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <label>Daftar Sebagai</label>
                <select name="role">
                    <option value="">Choose role</option>
                    <option value="Penyedia" <?php if($role == "Penyedia") echo 'selected'; ?>>Penyedia</option>
                    <option value="Penyewa" <?php if($role == "Penyewa") echo 'selected'; ?>>Penyewa</option>
                </select>
                <span><?php echo $role_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>    
</body>
</html>