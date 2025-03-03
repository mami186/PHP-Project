


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="/assets/css/profile.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Your Profile</h1>
            <nav>
                <ul>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><form action="/logout" method="post">
                            <button type="submit" class="link-button">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>

        <section class="profile-section">
            <form action="update_profile.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter new password if you want to change">
                </div>
                
                <div class="form-group">
                    <button type="submit">Update Profile</button>
                </div>
            </form>
        </section>
    </div>
</body>
</html>
