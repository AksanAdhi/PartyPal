<?

$servername = "localhost";
$username = "root";
$password = "";
$mydb = "partypal";

$conn = mysqli_connect($servername, $username, $password, $mydb);

if(!$conn) {
    die ("Connection Failed") . mysqli_connect_error();
}
?>