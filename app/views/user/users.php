
<?php
    if ($_SESSION['user_role'] !== 'admin') {
        die("Access denied! You are not an admin.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="/assets/css/users.css">
</head>
<body>
    <div class="container">
        <h1>User Management</h1>
        <table id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                    <tr>
                        <th>
                            <?php echo htmlspecialchars($user['id']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($user['name']); ?>
                        </th> 
                        <th>
                            <?php echo htmlspecialchars($user['email']); ?>
                        </th>
                        <th>
                            <?php echo htmlspecialchars($user['role']); ?>
                        </th>
                                                                                          
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
        <form class="add-user" action="/addusr" method="POST">
            <h2>Add New User</h2>
            <input type="text"  name="addName" placeholder="Name"  required="">
            <input type="email"  name = "addEmail" placeholder="Email">
            <input type="password" name="addPassword" placeholder="Password">
            <input type="password"  name="adminkey" placeholder="adminpass" required="">
            <select id="newRole" name='role' required="">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <button id="addUserBtn">Add User</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>