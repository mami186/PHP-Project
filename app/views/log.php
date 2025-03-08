<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            background-color: #f4f4f4;
        }
        input, button {
            width: 100%;
            margin: 5px 0;
            padding: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<<<<<<< HEAD
    <h4>Expense Log</h4>
    <form action="/logs" method ="POST">
=======
    <h2>Expense Log</h2>
>>>>>>> 21d527217a37441d914cc2885a88413799736158
    <input type="text" name="bg_catagory" >
    <input type="number" name="bg_amount" >
    <input type="text" name="bg_dep" >
    <input type="text" name="user_name" value="<?php echo htmlspecialchars($_SESSION['user_name ']); ?>" >
<<<<<<< HEAD
    <button onclick="addExpense()">Add Expense</button>
    </form>
=======
    
    <button onclick="addExpense()">Add Expense</button>
    
>>>>>>> 21d527217a37441d914cc2885a88413799736158
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="expenseTable">
        </tbody>
    </table>

    <script>
        function addExpense() {
            let desc = document.getElementById("desc").value;
            let amount = document.getElementById("amount").value;
            let date = document.getElementById("date").value;
            
            if (desc && amount && date) {
                let table = document.getElementById("expenseTable");
                let row = table.insertRow();
                row.insertCell(0).innerText = desc;
                row.insertCell(1).innerText = `$${amount}`;
                row.insertCell(2).innerText = date;
                
                document.getElementById("desc").value = "";
                document.getElementById("amount").value = "";
                document.getElementById("date").value = "";
            } else {
                alert("Please fill out all fields");
            }
        }
    </script>
</body>
</html>







