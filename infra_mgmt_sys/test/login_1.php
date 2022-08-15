<?php
include('inc/header.php');
include('inc/container.php');
?>
<title>IMS Login</title>
<style>
    .main_div{
        margin: 200px 50px 0px 50px;
        
    }

    .main_div h2{
        margin-left: 25px;
    }
    .main_div1{
        padding-top: 20px;
        padding-left: 20px;
        padding-right: 50px;
    }

    .form-control{
        margin-bottom: 25px;
    }

    .btn{
        margin-left: 200px;
    }

    .panel-title{
        margin-right: 20px;
        padding-right: 25px;
        margin-left: -10px;
    }
</style>
<body>
    <div class="main_div">
        <h2>Infrastructre Management System</h2>
        <div class="main_div1">
            <div class="panel-heading">
                <div class="panel-title">
                    User Login
                </div>
            </div>
            <form action="connect_1.php" method="POST">
                <div>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div>
                    <input type="submit" name="login" value="Login" class="btn">
                </div>
            </form>
        </div>
    </div>
</body>