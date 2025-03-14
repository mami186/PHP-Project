<?php
// Fetching budgets from the database
    require_once __DIR__ . '/../../models/BudgetModel.php';
    require_once __DIR__ . '/../../controllers/BudgetController.php';
    require_once __DIR__ . '/../../../core/Database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Budgets</title>
    <link rel="stylesheet" href="../assets/css/budget.css">
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
                    <option value="">  Select a Budget  </option>
                    <?php foreach ($budgets as $budget) : ?>
                        <option value="<?php echo $budget['id']; ?>">
                            <?php echo $budget['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <label for="update_amount">Updated Amount</label>
                <input type="number" id="update_amount" name="amount" step="0.01" required>

                <label for="update_category">Updated Category</label>
                <input type="text" id="update_category" name="category" required>

                <button type="submit">Update Budget</button>
            </form>
        </section>

        <!-- Delete Budget Form (Dropdown) -->
        <section>
            <h2>Delete Budget</h2>
            <form action="/budget/delete" method="POST">
                <label for="delete_budget_id">Select Budget to Delete</label>
                <select name="id" id="delete_budget_id" required>
                    <option value="">  Select a Budget  </option>
                    <?php foreach ($budgets as $budget) : ?>
                        <option value="<?php echo $budget['id']; ?>">
                            <?php echo $budget['id'] . "--" .$budget['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" onclick="return confirm('Are you sure you want to delete this budget?')">Delete Budget</button>
            </form>
        </section>

        <!-- View Budget Form (Table) -->
        <section>
            <h2>View Budget</h2>
            <?php if (!empty($budgets) && is_array($budgets)): ?>
            <table>
                    <tr>
                        <th>ID</th>
                        <th>Budget Name</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Time created</th>
                        <th>who created</th>
                    </tr>
                    <?php foreach ($budgets as $budget): ?>
                    <tr>
                        <th>
                            <?php echo htmlspecialchars($budget['id']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($budget['name']); ?>
                        </th> 
                        <th>
                            <?php echo htmlspecialchars($budget['amount']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($budget['category']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($budget['start_date']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($budget['end_date']); ?>
                        </th>
                        <th>
                            <?php echo  date('Y-m-d H:i:s', strtotime($budget['created_at'])) ; ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($budget['user_id']); ?>
                        </th>
                                                                                          
                    </tr>
                    <?php endforeach; ?>
            </table>
            <?php else: ?>
                        <li>No budgets found.</li>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
