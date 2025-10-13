<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Third-party CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <!-- Base styles -->
    <link rel="stylesheet" href="<?= base_url('assets/style.css');?>" id="base-css">
    <link rel="stylesheet" href="<?= base_url('assets/media.css');?>" id="media-css">
    
    <!-- Page specific styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/booking.css');?>" id="booking-css">
    <link rel="stylesheet" href="<?= base_url('assets/css/room-booking.css');?>" id="room-booking-css">
    <link rel="stylesheet" href="<?= base_url('assets/css/order.css');?>" id="order-css">
    
    <!-- Additional icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Debug CSS to verify styles are loading -->
    <style>
        .css-debug { display: none; }
        body::after {
            content: 'CSS Loaded';
            position: fixed;
            bottom: 10px;
            right: 10px;
            background: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            z-index: 9999;
        }
    </style>
    <title>Wide Ways</title>
</head>

<body>

<header>
        <nav>
            <h4>Wide ways</h4>
            <ul id="menu_bx">
                <li><a href="<?= base_url('/');?>">Home</a></li>
                <li><a href="<?= base_url('Welcome/destinations');?>">Destinations</a></li>
                <li><a href="<?= base_url('Welcome/order');?>">Bookings</a></li>

                <?php 
                if (empty($this->session->userdata('userdata'))) {
                    echo '
                    <li class="li_btn"><a href="#" id="loginBtn">Login</a></li>
                    <li class="li_btn"><a href="#" id="signupBtn">Register</a></li>
                    ';
                } else {
                   $userdata = $this->session->userdata('userdata');
                   $isAdmin = isset($userdata['is_admin']) && $userdata['is_admin'] === true;
                   
                   // Show Dashboard link only for admin
                   if ($isAdmin) {
                       echo '<li><a href="'. base_url("/dashboard").'">Dashboard</a></li>';
                   }
                   
                   echo '
                   <li><a href="#" id="userStatus">
                   <i class="bi bi-person-fill" style="margin-right:5px;"></i>  Hello, '
                    . $this->session->userdata('userdata')['name']  .

                   '
                   </a></li><li class="li_btn"><a href="#" id="logoutBtn">Logout</a></li>
                   ';
                }
                
                ?>
            </ul>
            <i class="bi bi-three-dots"></i>
        </nav>