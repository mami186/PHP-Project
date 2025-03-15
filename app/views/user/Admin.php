<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Management Panel</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 10px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Admin Management Panel</h1>

<!-- Create Department -->
<h2>Create Department</h2>
<form method="POST">
    <input type="text" name="department_name" placeholder="Department Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <button type="submit" name="create_department">Create Department</button>
</form>

<!-- Allocate Budget -->
<h2>Allocate Budget</h2>
<form method="POST">
    <select name="department_id" required>
        <option value="">Select Department</option>
        <?php while ($row = $departments->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['department_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="number" name="allocated_budget" placeholder="Amount" required>
    <input type="date" name="start_date" required>
    <input type="date" name="end_date" required>
    <button type="submit" name="allocate_budget">Allocate Budget</button>
</form>

<!-- Assign User -->
<h2>Assign User</h2>
<form method="POST">
    <input type="text" name="user_name" placeholder="User Name" required>
    <input type="email" name="user_email" placeholder="User Email" required>
    <input type="password" name="user_password" placeholder="User Password" required>
    <select name="department_id" required>
        <?php
        $departments->data_seek(0);
        while ($row = $departments->fetch_assoc()): ?>
            <option value="<?= $row['id'] ?>"><?= $row['department_name'] ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit" name="assign_user">Assign User</button>
</form>

<!-- Display Departments -->
<h2>Departments and Budgets</h2>
<table>
    <thead>
        <tr><th>ID</th><th>Department</th><th>Description</th><th>Allocated Budget</th></tr>
    </thead>
    <tbody>
        <?php while ($row = $departments->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['department_name'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['allocated_budget'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
