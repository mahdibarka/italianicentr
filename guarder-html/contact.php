<?php
$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "centro_assistenza_italiani";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// // Initialize variables from POST data
// $full_name = $_POST['full_name'];
// $email = $_POST['email'];
// $phone_number = $_POST['phone_number'];
// $message = $_POST['message'];

// Validate input data
if (!empty($full_name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
    // Prepare SQL statement
    $sql = $conn->prepare("INSERT INTO contacts (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $full_name, $email, $phone_number, $message);

    // Execute SQL statement
    if ($sql->execute()) {
        // Close MySQL connection
        $sql->close();
        $conn->close();

        // Show success alert and refresh the page
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<style>";
        echo ".alert-success {";
        echo "    padding: 20px;";
        echo "    background-color: #4CAF50;"; /* Green background */
        echo "    color: white;";
        echo "    margin-bottom: 15px;";
        echo "    border-radius: 5px;";
        echo "    text-align: center;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='alert-success'>Your message has been sent successfully!</div>";
        echo "<script>";
        echo "setTimeout(function() {";
        echo "    window.location.href = 'contact.php';"; // Redirect to the same page
        echo "}, 2000);"; // Delay before refresh to show alert
        echo "</script>";
        echo "</body>";
        echo "</html>";
    } else {
        // Show error message if SQL execution fails
        echo "Error: " . $sql->error;
    }
} else {
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<style>";
    echo ".alert-error {";
    echo "    padding: 20px;";
    echo "    background-color: #f44336;"; /* Red background */
    echo "    color: white;";
    echo "    margin-bottom: 15px;";
    echo "    border-radius: 5px;";
    echo "    text-align: center;";
    echo "}";
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='alert-error'>Please fill out all required fields correctly.</div>";
    echo "<script>";
    echo "setTimeout(function() {";
    echo "    window.location.href = 'contact.php';"; // Redirect to the same page
    echo "}, 2000);"; // Delay before refresh to show alert
    echo "</script>";
    echo "</body>";
    echo "</html>";
}

// Close MySQL connection
$conn->close();
?>
