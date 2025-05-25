<?php
include 'db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$response = ['status' => 'error', 'message' => 'Something went wrong'];

if ($data && isset($data['action']) && $data['action'] == 'register') {
    $name = trim($data['name']);
    $email = trim($data['email']);
    $password = trim($data['password']);
    $dob = trim($data['dob']);
    $gender = $data['gender'] ?? '';

    if (strlen($name) < 3) {
        $response['message'] = "Name must be at least 3 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email.";
    } elseif (strlen($password) < 6) {
        $response['message'] = "Password must be at least 6 characters.";
    } elseif (empty($dob)) {
        $response['message'] = "DOB is required.";
    } elseif ($gender != 'male' && $gender != 'female') {
        $response['message'] = "Select gender.";
    } else {
        $sql = "INSERT INTO users (name, email, password, dob, gender)
                VALUES ('$name', '$email', '$password', '$dob', '$gender')";
        if ($conn->query($sql) === TRUE) {
            $response = ['status' => 'success', 'message' => 'Registration successful'];
        } else {
            $response['message'] = "Insert error: " . $conn->error;
        }
    }
}

echo json_encode($response);
