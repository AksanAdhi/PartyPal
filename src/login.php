<?php
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "partypal."; // Ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);


if (isset($_GET['submit'])){

    var_dump($_GET);
}
die();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validasi password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validasi kredensial
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, email, username, password, role FROM users WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $email, $username, $hashed_password, $role);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password benar, mulai sesi baru
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["username"] = $username;
                            $_SESSION["role"] = $role;

                            // Redirect ke halaman utama
                            header("location: welcome.php");
                        } else {
                            $login_err = "Invalid password.";
                        }
                    }
                } else {
                    $login_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>Login</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="bg-primary">
    <section class="container mx-auto flex">
        <div class="w-1/2">
            <div class="max-w-sm mx-auto pt-24">
                <img class="mx-auto" src="./asset/logo pp 1.png" alt="">
                <form class="mt-10 z-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="max-w-sm">
                        <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                        ?>
                        <label class="text-lg font-semibold text-white" for="">Email</label>
                        <input class="w-full mt-2 mb-2 py-2 px-3 outline outline-pink-400 rounded-lg" type="email" name="email" placeholder="akucantik@gmail.com" value="<?php echo $email; ?>">
                        <span class="text-red-500"><?php echo $email_err; ?></span>

                        <label class="text-lg font-semibold text-white" for="">Password</label>
                        <input class="w-full py-2 px-3 rounded-lg outline outline-pink-400" type="password" name="password" placeholder="*******">
                        <span class="text-red-500"><?php echo $password_err; ?></span>

                        <div class="flex justify-center mt-5">
                            <button class="text-white mt-4 px-12 py-2 text-2xl font-lg font-bold rounded-xl outline outline-4 outline-white">Log In</button>
                        </div>
                    </div>
                </form>
                <p class="text-white text-center mt-10 text-lg underline underline-offset-[12px]">
                    Dont’t have an account? <span class="font-bold">Sign Up</span>
                </p>
                <p class="text-center text-white font-bold text-lg mt-2">Pengguna</p>
            </div>
        </div>
    </section>
</body>
</html>



?>
