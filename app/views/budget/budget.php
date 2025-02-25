<?php
// Fetching budgets from the database
    require_once __DIR__ . '/../../models/BudgetModel.php';
    require_once __DIR__ . '/../../../core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Budgets</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Your Budgets</h1>
        </header>

        <!-- Create Budget Form -->
        <section>
            <h2>Create a New Budget</h2>
            <form action="/budget/create" method="POST">
                <label for="budget_name">Budget Name</label>
                <input type="text" id="budget_name" name="name" required>
                
                <label for="budget_amount">Amount</label>
                <input type="number" id="budget_amount" name="amount" step="0.01" required>
                
                <label for="budget_category">Category</label>
                <input type="text" id="budget_category" name="category" required>

                <label for="user_id">User_ID</label>
                <input type="text" id="user_id" name="user_id" required>

                <label for="budget_start">budget start date</label>
                <input type="text" id="budget_start" name="start_date" required>

                <label for="budget_end">budget end date</label>
                <input type="text" id="budget_end" name="end_date" required>
                
                <button type="submit">Create Budget</button>
            </form>
        </section>

        <!-- Update Budget Form (Dropdown) -->
        <section>
            <h2>Update Budget</h2>
            <form action="/budget/update" method="POST">
                <label for="budget_id">Select Budget</label>
                <select name="id" id="budget_id" required>
                    <option value="">--Select a Budget--</option>
                    <?php foreach ($budget->getBudgetsByUserId as $budget) : ?>
                        <option value="<?php echo $budget['id']; ?>">
                            <?php echo $budget['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="update_amount">Updated Amount</label>
                <input type="number" id="update_amount" name="update_amount" step="0.01" required>

                <label for="update_category">Updated Category</label>
                <input type="text" id="update_category" name="update_category" required>

                <button type="submit">Update Budget</button>
            </form>
        </section>

        <!-- Delete Budget Form (Dropdown) -->
        <section>
            <h2>Delete Budget</h2>
            <form action="/budget/delete" method="POST">
                <label for="delete_budget_id">Select Budget to Delete</label>
                <select name="delete_budget_id" id="delete_budget_id" required>
                    <option value="">--Select a Budget--</option>
                    <?php foreach ($budget as $budget) : ?>
                        <option value="<?php echo $budget['id']; ?>">
                            <?php echo $budget['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" onclick="return confirm('Are you sure you want to delete this budget?')">Delete Budget</button>
            </form>
        </section>

        <!-- View Budget Form (Dropdown) -->
        <section>
            <h2>View Budget</h2>
            <form action="/budget/view" method="POST">
                <label for="view_budget_id">Select Budget to View</label>
                
                <input type="text" id="view_budget_id" name="name" required>
                
                
                <button type="submit">View Budget</button>
            </form>
        </section>
    </div>
</body>
</html>
