<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Signin Template · Bootstrap v5.0</title>




    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">

    <?php
    // Connect to mysql
    require('function.php');
    // check input
    if (isset($_POST["login"])) {
        $maNguoiDung = $_POST["maNguoiDung"];
        $matKhau = $_POST["matKhau"];


        $accountGiaoVien = $account->getAccountGiaoVien($maNguoiDung, $matKhau);
        $accountNhanVien = $account->getAccountNhanVien($maNguoiDung, $matKhau);


        if ($accountGiaoVien != null) { // có giáo viên
            $accountInfo = $accountGiaoVien;
            $userID = $accountInfo[0]['MaGiaoVien'];
            $userRole = $account->getUserRoleGiaoVien($userID, 'giaovien', 'MaGiaoVien');
        } else if ($accountNhanVien != null) { // có nhân viên
            // mysql does not care about upper or lower case in sreach
            // so use this to check if it's exacly the same
            if ($accountNhanVien[0]['MaNhanVien'] == $maNguoiDung) {
                $accountInfo = $accountNhanVien;
                $userID = $accountInfo[0]['MaNhanVien'];
                $userRole = $account->getUserRoleGiaoVien($userID, 'nhanvien', 'MaNhanVien');
            } else {
                $accountInfo = null;
            }
        } else {
            $accountInfo = null;
        }



        if ($accountInfo != null) { // có account
            $_SESSION['MaDangNhap'] = $maNguoiDung;
            header("location: index.php?TenChucVu=" . $userRole);
        }

        /*foreach ($accountInfomation as $acc) {
            if ($userName == $acc['UserName']) {
                if ($password == $acc['Password']) {
                    echo "Yeah you did it";
                } else {
                    echo "Wrong password";
                }
            } else {
                echo "Account not found";
            }
        }*/
    }
    ?>
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" name="maNguoiDung" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="matKhau" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>


            <?php if (isset($_POST["login"])) {
                if ($accountInfo == null) {
                    echo '<div class="form-floating">
                    <h6 class="text-danger">Check your input again.</h6>
                </div>';
                }
            } ?>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>



</body>

</html>