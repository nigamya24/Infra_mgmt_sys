<?php
include('inc/header.php');
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-family: sans-serif;
    }

    li {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #1ae5f7;
        padding: 1rem 1.5rem;
    }

    .nav-logo {
        font-size: 30px;
        font-weight: 500;
        color: white;
        margin-left: 35%;
        margin-top: 20px;
        color: black;
    }

    .nav-menu {
        padding-top: 30px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .nav-item {
        margin-left: 3rem;
    }

    .nav-link{
        font-size: 19px;

    }

    .nav-link:hover{
        color: #1ae5f7;
    }
</style>

<nav class="nav-bar">
    <p class="nav-logo">Infrastructre Management System</p>
    <br><ul class="nav-menu">
        <li class="nav-item">
        <a href="Department_1.php" class="nav-link">Department</a>
        </li>

        <li class="nav-item">
        <a href="homepage.php" class="nav-link">Ticket</a>
        </li>

        <li class="nav-item">
        <a href="people.php" class="nav-link">Users</a>
        </li>
    </ul>
</nav>