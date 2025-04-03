<?php
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
    <title>Admin Profile & Budget Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/profile.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <!-- Profile Section -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="Profile Picture">
                    <h4 class="card-title">Admin Profile</h4>
                    <button class="btn btn-primary" onclick="window.location.href='<?= BASE_URL ?>/dashboard'">
                        DashBoard
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                    <button class="btn btn-primary" onclick="window.location.href='<?= BASE_URL ?>/logout'">
                        LogOut
                    </button>
                              
                
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> <span id="adminID"><?php echo htmlspecialchars($user['id']); ?></span></p>
                            <p><strong>Name:</strong> <span id="adminName"><?php echo htmlspecialchars($user['name']); ?></span></p>
                            <p><strong>Email:</strong> <span id="adminEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                            <p><strong>Created at:</strong> <span id="lastLogin"><?php echo htmlspecialchars($user['created_at']); ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget Management Section -->
    <div class="row">
        <div class="col-12 mb-4">
            <h3>Budget Management</h3>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createBudgetModal">
                <i class="fas fa-plus"></i> Create New Log
            </button>
        </div>

        <!-- Budget List -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <tr>
                                    <td>Emily Trey</td>
                                    <td>Microsoft</td>
                                    <td>$28,781</td>
                                    <td>07-07-2021</td>
                                    <td>payed</td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm" action="<?= BASE_URL ?>/profile/update" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>" >
                    <div class="mb-3">
                        <label for="name" class="form-label" >Name</label>
                        <input type="text" class="form-control" id="name"  name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label" >Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label" placeholder="new password">New Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div> 
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('profileForm').submit();">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Create Budget Modal -->
<div class="modal fade" id="createBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createBudgetForm">
                    <div class="mb-3">
                        <label for="budgetName" class="form-label">Budget Name</label>
                        <input type="text" class="form-control" id="budgetName" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-control" id="category" required>
                            <option value="">Select Category</option>
                            <option value="marketing">Marketing</option>
                            <option value="operations">Operations</option>
                            <option value="development">Development</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="createBudget()">Create Budget</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Budget Modal -->
<div class="modal fade" id="updateBudgetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Budget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="updateBudgetForm">
                    <input type="hidden" id="updateBudgetId">
                    <div class="mb-3">
                        <label for="updateBudgetName" class="form-label">Budget Name</label>
                        <input type="text" class="form-control" id="updateBudgetName" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="updateAmount" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateCategory" class="form-label">Category</label>
                        <select class="form-control" id="updateCategory" required>
                            <option value="marketing">Marketing</option>
                            <option value="operations">Operations</option>
                            <option value="development">Development</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="updateDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateBudget()">Update Budget</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Profile Management


// Budget Management
function createBudget() {
    // Add your budget creation logic here
    alert('Budget created successfully!');
    document.querySelector('#createBudgetModal').classList.remove('show');
}

function updateBudget() {
    // Add your budget update logic here
    alert('Budget updated successfully!');
    document.querySelector('#updateBudgetModal').classList.remove('show');
}

function deleteBudget(id) {
    if(confirm('Are you sure you want to delete this budget?')) {
        // Add your budget deletion logic here
        alert('Budget deleted successfully!');
    }
}
</script>

</body>
</html>
