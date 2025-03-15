<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Creation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }



        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<section>
    <?php if (!empty($users) && is_array($users)): ?>
    <table>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Name</th> 
                <th>Email</th>
                <th>Created at</th>
            </tr>
            <?php foreach ($users as $usr): ?>
            <tr>
                <th>
                    <?php echo htmlspecialchars($usr['id']); ?>
                </th>
                <th>
                    <?php echo htmlspecialchars($usr['role']); ?>
                </th> 
                <th>
                    <?php echo htmlspecialchars($usr['name']); ?>
                </th> 
                <th>
                    <?php echo htmlspecialchars($usr['email']); ?>
                </th>
                <th>
                    <?php echo  date('Y-m-d H:i:s', strtotime($usr['created_at'])) ; ?>
                </th>
                                                                                    
            </tr>
            <?php endforeach; ?>
    </table>
    <?php else: ?>
                <li>User managment</li>
    <?php endif; ?>
</section>
<div class="container">
    <h2>Create User</h2>
    <form action="<?= BASE_URL ?>/create-user" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="Email">
        </div>
        <div class="form-group">
            <label for="adminKey">Admin Key:</label>
            <input id="adminKey" name="adminKey" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User </option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <input type="submit" value="Create User">
    </form>
</div>

</body>
</html>