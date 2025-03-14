<?php

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/dashboard.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to your Dashboard, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <nav>
                <ul>
                    <li><button>
                        <a href="<?= BASE_URL ?>/profile" >Profile</a>
                        </button>
                    </li>
                    <li><button>
                        <a href="<?= BASE_URL ?>/budget" >budgets</a>
                        </button>
                    </li>
                    <li>
                        <form action ="<?= BASE_URL ?>/logout" method="POST">
                            <button type="submit" name="logout">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Dashboard Content -->
        <section>
            <h2>Your Budget Overview</h2>
            <!-- Add any budget-related content here -->
            <p>Here's a summary of your budget...</p>
        </section>
    </div>
</body>
</html>

