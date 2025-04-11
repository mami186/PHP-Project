<?php
    $userModel = new UserModel();
    $user = $userModel->getUserById($_SESSION['user_id']);

    if(!isset($_SESSION['user_id'])) {
        header('Location: '. BASE_URL . '/register');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Budgets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="<?=BASE_URL?>/assets/css/profile.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="card-title">Budget List</h2>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                <i class="fas fa-plus"></i> Create Budget
            </button>
                </div>
                <div class="table-responsive">
            <?php if (!empty($budgets) && is_array($budgets)): ?>
            <table class="table tablehover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>user_id</th>
                        <th>Budget Name</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Time created</th>
                    </tr>
                    </thead>    
                    <?php foreach ($budgets as $budget): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($budget['id']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($budget['user_id']); ?>
                        </td> 
                        <td>
                            <?php echo htmlspecialchars($budget['name']); ?>
                        </td> 
                        <td>
                            <?php echo htmlspecialchars($budget['amount']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($budget['category']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($budget['start_date']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($budget['end_date']); ?>
                        </td>
                        <td>
                            <?php echo  date('Y-m-d H:i:s', strtotime($budget['created_at'])) ; ?>
                        </td>
                        <td>
                            <a id="<?php echo $budget['id']; ?>"  class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateBudgetModal" onclick="setBudgetId(this.id)">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                        <form action="<?= BASE_URL ?>/budget/delete" method="POST" style="display: inline;">
                            <button type="submit" class="btn btn-sm btn-danger" value="<?= $budget['id'] ?>" name="id" onclick="deleteBudget()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
            <?php else: ?>
                        <li>No budgets found.</li>
            <?php endif; ?>
                </div>
                <div class="mt-3">
                    <a href="<?=BASE_URL?>/dashboard" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>


<!-- create budget modal -->
    <div class="modal fade" id="createBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createBudgetForm" action="<?= BASE_URL ?>/budget/create" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

                    <div class="mb-3">
                        <label for="budgetName" class="form-label">Budget Name</label>
                        <input type="text" class="form-control" id="budgetName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input  type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input  type="text" class="form-control" id="category" name="category" required>
                            
                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="start-date" class="form-label">Start Date</label>
                        <input  type="text" class="form-control" id="start-date" name="start_date" required>
                            
                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="end-date" class="form-label">End Date</label>
                        <input  type="text" class="form-control" id="end-date" name="end_date" required>
                
                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success"  onclick="document.getElementById('createBudgetForm').submit();">Create Budget</button>
            </div>
        </div>
    </div>
</div>

<!-- update budget modal -->

<div class="modal fade" id="updateBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="updateBudgetForm" action="<?=BASE_URL?>/budget/update" method="POST">

                    <input type="hidden" id="updateBudgetId" value="" name="id">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                    <div class="mb-3">
                        <label for="updateBudgetName" class="form-label">Budget Name</label>
                        <input type="text" class="form-control" id="updateBudgetName" name="name" value="">

                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="updateAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="updateBudgetAmount" name="amount" value="">

                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="updateCategory" class="form-label">Category</label>
                        <input class="form-control" id="updateBudgetcategory" name="category" value="">

                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="start-date" class="form-label">Start Date</label>
                        <input  type="text" class="form-control" id="updateBudgetStartdate" name="start_date" value="">
                            
                        </input> 
                    </div>
                    <div class="mb-3">
                        <label for="end-date" class="form-label">End Date</label>
                        <input  type="text" class="form-control" id="updateBudgetEnddate" name="end_date" value="">
                
                        </input>
                    </div>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="updateDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('updateBudgetForm').submit();">Update Budget</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteBudget() {
            if(confirm('Are you sure you want to delete this budget?')) {
                alert('Budget deleted successfully!');
                // Reload the page or remove the row
                location.reload();
            }
        }
    function setBudgetId(id) {
        const budget = budgets.find(b => b.id == id);
        document.getElementById('updateBudgetId').setAttribute('value', id);
        document.getElementById('updateBudgetName').setAttribute('value', budget.name);
        document.getElementById('updateBudgetAmount').setAttribute('value', budget.amount);
        document.getElementById('updateBudgetcategory').setAttribute('value', budget.category);
        document.getElementById('updateBudgetStartdate').setAttribute('value', budget.start_date);
        document.getElementById('updateBudgetEnddate').setAttribute('value', budget.end_date);
    }

    const budgets = <?php echo json_encode($budgets); ?>;
    </script>
</body>
</html> 