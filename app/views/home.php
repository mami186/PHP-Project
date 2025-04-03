<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Budget Management</title>
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/home_css.css"> 
    <link rel="stylesheet" href="css/sidebar_css.css">
    <style>
        .body {
            background-color: #f6f5f7;
            margin: 0;
            padding: 0;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('<?=BASE_URL?>/assets/img/finance_2.jpg') no-repeat center center fixed;
            background-size: cover;
            z-index: -1; /* Keeps it in the background */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 60px; /* Start with minimized width */
            height: 100%;
            background-color: #75787cf3;
            color: wheat;
            transition: all 0.3s; /* Smooth transition for expanding and minimizing */
            padding-top: 20px;
            z-index: 100;
            background-color: rgba(0, 0, 0, 0.5);
        }

    
        .sidebar:hover {
            width: 150px;
            opacity: 0.8; /* Expand the sidebar when hovered */
        }

        .sidebar ul {
            padding: 0;
            list-style: none;
            margin-top: 50px;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: center;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .sidebar .icon {
            font-size: 20px;
            margin-right: 10px;
        }
        
        .top-bar {
            width: 100%;
           
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            height: 45px;
            z-index: 200;
        }

        .top-bar button {
            background-color: #2a6b9a;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 50px;
        }

        .top-bar button:hover {
            background-color: #E0484D;
        }

        .profile-btn {
            width: 40px;
            height: 40px;
            border-radius: 70%;
            background-image: url('profile-placeholder.png'); /* Replace with actual profile image */
            background-size: cover;
            background-position: center;
            cursor: pointer;
            border: 2px solid white;
            margin-right: 90px;
        }
        /* Your navigation styling here */
    

        .main-content {
            margin-left: 60px; /* Adjust to sidebar's minimized state */
            padding: 20px;
        }

        .hero {
            text-align: center;
            padding: 80px 10px;
           
            color: white;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        button {
            background:linear-gradient(to right, #12f906, #95f702ac);
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #c5ac84;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .feature-box {
            background: linear-gradient(to right, #3a5047,#3c4843f3);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
           
        }

        footer {
            text-align: center;
            padding: 20px;
            color: black;
        
        }

    </style>
</head>
<body>
    <div class="top-bar"> 
        <div id="profileBtn" class="profile-btn"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
          </svg></div>
    </div>
    <!-- Sidebar -->
   
    <div class="background"></div>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Section -->
        <header class="hero">
            <h1>Welcome to Budget Management System</h1>
            <p>Track your spending, manage your finances, and gain financial freedom.</p>
            <div class="button-container" method="POST">
                <button><a href="<?= BASE_URL ?>/register">Get Started</a></button>
            </div>
        </header>

        <!-- Features Section -->
        <section class="features">
            <div class="feature-box">
                <h3>Budget Tracking</h3>
                <p>Monitor your income and expenses in one place.</p>
            </div>
            <div class="feature-box">
                <h3>Analytics</h3>
                <p>Gain insights into your financial habits with interactive charts.</p>
            </div>
            <div class="feature-box">
                <h3>Secure & Private</h3>
                <p>We ensure the highest level of security for your data.</p>
            </div>
        </section>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 Budget Management System. All rights reserved.</p>
    </footer>

</body>
</html>
