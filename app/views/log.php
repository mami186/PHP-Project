<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Editor</title>
    <style>
        table {
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .save-btn {
            background-color: #008CBA;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .edit-form {
            display: none;
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }
        .edit-form input, #specific-edit-form input {
            margin: 5px 0;
            padding: 5px;
            width: 200px;
        }
        #specific-edit-form {
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h2>Edit Specific Log</h2>
    <div id="specific-edit-form">
        <form method="post">
            <input type="number" name="log_id" placeholder="Enter Log ID" required><br>
            <input type="text" name="bg_dep" placeholder="Department"><br>
            <input type="text" name="bg_amount" placeholder="Amount"><br>
            <input type="text" name="description" placeholder="Category"><br>
            <button type="submit" class="save-btn">Update Log</button>
        </form>
    </div>

    <h2>Latest 10 Logs</h2>

    <?php

        // Handle form submission for updates (both from specific form and table forms)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['log_id'])) {
            $log_id = $_POST['log_id'];
            $params = [];
            
            // Only update fields that were provided
            $update_fields = [];
            if (!empty($_POST['bg_dep'])) $update_fields[] = "bg_dep = ?";
            if (!empty($_POST['bg_amount'])) $update_fields[] = "bg_amount = ?";
            if (!empty($_POST['description'])) $update_fields[] = "description = ?";
            
            if (!empty($update_fields)) {
                $sql = "UPDATE logs SET " . implode(", ", $update_fields) . " WHERE log_id = ?";
                $stmt = $conn->prepare($sql);
                
                // Build parameters array
                if (!empty($_POST['bg_dep'])) $params[] = $_POST['bg_dep'];
                if (!empty($_POST['bg_amount'])) $params[] = $_POST['bg_amount'];
                if (!empty($_POST['description'])) $params[] = $_POST['description'];
                $params[] = $log_id;
                
                $stmt->execute($params);
                echo "<p style='color: green;'>Log updated successfully!</p>";
            }
        }

        // Get latest 10 logs
        $stmt = $conn->prepare("SELECT * FROM logs ORDER BY log_id DESC LIMIT 10");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Start HTML table
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        
        // Create table header
        if (!empty($results)) {
            echo "<tr>";
            foreach (array_keys($results[0]) as $column) {
                echo "<th style='background-color: #f2f2f2;'>$column</th>";
            }
            echo "<th style='background-color: #f2f2f2;'>Actions</th>";
            echo "</tr>";

            // Create table rows with data
            foreach ($results as $row) {
                echo "<tr id='row-{$row['log_id']}'>";
                foreach ($row as $key => $cell) {
                    echo "<td>$cell</td>";
                }
                echo "<td><button class='edit-btn' onclick='showEditForm({$row['log_id']})'>Edit</button></td>";
                echo "</tr>";
                
                // Create hidden edit form for this row
                echo "<tr><td colspan='100'>";
                echo "<div id='edit-form-{$row['log_id']}' class='edit-form'>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='log_id' value='{$row['log_id']}'>";
                echo "Department: <input type='text' name='bg_dep' value='{$row['bg_dep']}'><br>";
                echo "Amount: <input type='text' name='bg_amount' value='{$row['bg_amount']}'><br>";
                echo "Category: <input type='text' name='description' value='{$row['description']}'><br>";
                echo "<button type='submit' class='save-btn'>Save</button>";
                echo "</form>";
                echo "</div>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='100'>No logs found</td></tr>";
        }
        
        echo "</table>";
    ?>

    <script>
    function showEditForm(id) {
        // Hide all forms first
        const allForms = document.getElementsByClassName('edit-form');
        for (let form of allForms) {
            form.style.display = 'none';
        }
        
        // Show the selected form
        const form = document.getElementById(`edit-form-${id}`);
        form.style.display = 'block';
    }
    </script>
</body>
</html>