<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
    button {
        padding: 8px;
        width: 100%;
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
    </style>
</head>
<body>

<h2>Registration Form</h2>

<form id="userForm">
    <label>Name:</label>
    <input type="text" name="name" id="name"><br><br>

    <label>Email:</label>
    <input type="text" name="email" id="email"><br><br>

    <label>Password:</label>
    <input type="password" name="password" id="password"><br><br>

    <label>Date of Birth:</label>
    <input type="date" name="dob" id="dob"><br><br>

    <label>Gender:</label><br>
    <input type="radio" name="gender" value="male"> Male
    <input type="radio" name="gender" value="female"> Female<br><br>

    <input type="checkbox" id="agree"> I agree to the terms<br><br>

    <button type="submit">Register</button>
</form>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#userForm').on('submit', function (e) {
    e.preventDefault();

    let name = $('#name').val().trim();
    let email = $('#email').val().trim();
    let password = $('#password').val().trim();
    let dob = $('#dob').val();
    let gender = $('input[name="gender"]:checked').val();
    let agree = $('#agree').is(':checked');

    if (name.length < 3) {
        alert("Name must be at least 3 characters.");
        return;
    }
    let emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (!emailPattern.test(email)) {
        alert("Enter valid email.");
        return;
    }
    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return;
    }
    if (!dob) {
        alert("Select date of birth.");
        return;
    }
    if (!gender) {
        alert("Select gender.");
        return;
    }
    if (!agree) {
        alert("You must agree to the terms.");
        return;
    }

    let userData = {
        action: 'register',
        name: name,
        email: email,
        password: password,
        dob: dob,
        gender: gender
    };

    console.log("User object:", userData);

    $.ajax({
        url: 'register.php',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(userData),
        success: function (res) {
            alert(res.message);
            if (res.status === 'success') {
                $('#userForm')[0].reset();
                window.location.href = 'view.php';
            }
        }
    });

});
</script>

</body>
</html>
