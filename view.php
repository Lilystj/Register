<?php
include 'db.php';

$users = [];
$sql = "SELECT * FROM users WHERE flag = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f8ff;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 0 10px #ddd;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }
    th {
      background: #e8f1ff;
    }
    .btn {
      padding: 6px 12px;
      margin: 2px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      color: white;
      font-size: 14px;
    }
    .btn-update {
      background-color: #4CAF50;
    }
    .btn-delete {
      background-color: #f44336;
    }
    .btn-back {
      background-color: #007BFF;
      margin-top: 20px;
    }
    .btn:hover {
      opacity: 0.9;
    }
    </style>
</head>
<body>
<h2>Registered Users</h2>
<table>
    <tr>
        <th>Name</th><th>Email</th><th>DOB</th><th>Gender</th><th>Actions</th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo htmlspecialchars($u['name']); ?></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['dob']); ?></td>
            <td><?php echo htmlspecialchars($u['gender']); ?></td>
            <td>
                <a class="btn btn-update" href="update.php?id=<?php echo $u['id']; ?>">Update</a>
                <a class="btn btn-delete" href="delete.php?id=<?php echo $u['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No users found.</td></tr>
    <?php endif; ?>
</table>

<button class="btn btn-back" onclick="window.location.href='index.php'">Back to Register</button>
</body>
</html>
