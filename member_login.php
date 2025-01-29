<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label, input, button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        input {
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .redirect {
            text-align: center;
            margin-top: 10px;
        }
        .redirect a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
        .redirect a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">Blood For Life</div>
    <div class="container">
        <h1>Member Login</h1>
        <form action="login_process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <div class="redirect">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>
