<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/assets/dashboard.css');?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Control</title>
</head>
<body>
    <header>
        <!-- Menu Start  -->
        <menu>
            <!-- logo  -->
            <div class="logo_list">
                <a href="/" class="logo">Control</a>
                <ul>
                    <li>
                        <a href="<?php echo base_url('/dashboard')?>" class="a_active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/hotels')?>"><i class="bi bi-buildings-fill"></i> Hotels </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/bookings')?>"><i class="bi bi-backpack2-fill"></i> Bookings</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/users')?>"><i class="bi bi-people-fill"></i> Users</a>
                    </li>
                </ul>
            </div>

            <!-- Logout Start  -->
            <button><i class="bi bi-power"></i> Logout</button>
            <!-- Logout End -->
        </menu>