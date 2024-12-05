<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WS1-1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

//Get all blogs
$sql = "SELECT * FROM blogs";
$result = $conn->query($sql);


function check_user_logged_in()
{
    if (!isset($_SESSION['id'])) {
        header("Location: /WS101/pages/login/Login.php");
        exit();
    }
}
function check_user_logged_out()
{
    if ($_SESSION['loggedin'] === true) {
        header("Location: /WS101/pages/Welcome/Welcome.php");
        exit();
    }
}
function formatDateTime($dateTime)
    {
        $dateObj = new DateTime($dateTime);
        $formattedDate = $dateObj->format('F j, Y');
        $formattedTime = $dateObj->format('H:i');
        $now = new DateTime();
        $interval = $dateObj->diff($now);
        $hoursAgo = $interval->days * 24 + $interval->h;
        return [
            'formattedDate' => $formattedDate,
            'formattedTime' => $formattedTime,
            'hoursAgo' => $hoursAgo
        ];
    }
    function calculateTimeAgo($dateTime) {
        
        $dateObj = new DateTime($dateTime);
        $now = new DateTime();
    
        $interval = $dateObj->diff($now);
        
        $totalDays = $interval->days;
        
        if ($totalDays < 1) {
            
            $hours = $interval->h;
            if ($hours <= 1) {
                return "an hour ago";
            }
            return "$hours hours ago";
        } elseif ($totalDays < 7) {
            
            if ($totalDays == 1) {
                return "yesterday";
            }
            return "$totalDays days ago";
        } elseif ($totalDays < 30) {
            
            $weeks = floor($totalDays / 7);
            return "$weeks weeks ago";
        } elseif ($totalDays < 365) {
            
            $months = floor($totalDays / 30);
            return "$months months ago";
        } else {
            
            $years = floor($totalDays / 365);
            return "$years years ago";
        }
    }
    
?>


<!-- <script>
    // Wait for the DOM to fully load
    document.addEventListener("DOMContentLoaded", () => {
        const messageDiv = document.getElementById("session-message");
        if (messageDiv) {
            // Remove the message after 5 seconds (5000ms)
            setTimeout(() => {
                messageDiv.style.display = "none";
            }, 5000);
        }
    });
</script> -->