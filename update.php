<?php
include 'db.php';

$id = $_GET['id'];
$user = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];

    $sql = "UPDATE users SET name='$name', email='$email', dob='$dob', gender='$gender' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
        exit();
    } else {
        echo "Update error: " . $conn->error;
    }
} else {
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8ff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .field {
            margin-bottom: 12px;
        }
        label {
            display: block;
            margin-bottom: 4px;
        }
        input[type="text"], input[type="password"], input[type="date"] {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }
        .radio-group {
            display: flex;
            gap: 10px;
        }
        .btn-group {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 8px;
            flex: 1;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        button:hover {
            background: #0056b3;
        }
        .cancel-btn {
            background: #007BFF;
        }
        .cancel-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<h2>Update User</h2>

<form method="POST" onsubmit="return confirmUpdate();">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo $user['name']; ?>"><br><br>

    <label>Email:</label><br>
    <input type="text" name="email" value="<?php echo $user['email']; ?>"><br><br>

    <label>DOB:</label><br>
    <input type="date" name="dob" value="<?php echo $user['dob']; ?>"><br><br>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="male" <?php if ($user['gender'] == 'male') echo "checked"; ?>> Male
    <input type="radio" name="gender" value="female" <?php if ($user['gender'] == 'female') echo "checked"; ?>> Female<br><br>

    <div class="btn-group">
        <button type="submit">Update</button>
        <button type="button" class="cancel-btn" onclick="window.location.href='view.php'">Cancel</button>
    </div>
</form>

<script>
function confirmUpdate() {
    return confirm("Are you sure you want to update this user?");
}
</script>

</body>
</html>
