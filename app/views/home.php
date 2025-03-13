<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: #ddd;
            padding: 10px;
            text-align: center;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        footer {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to My Home Page</h1>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>
    <main>
        <p>press to start ......</p>
        <form action="/budget_managment/app/view/register.php" method="POST" >
            <button><a href="/budget_managment/app/view/register.php">register</a></button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 My Website</p>
    </footer>
</body>
</html>
