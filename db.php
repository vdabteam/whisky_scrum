<?php



$conn = new mysqli('172.22.145.155', 'whisky', 'whisky');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";