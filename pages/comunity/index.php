<?php
require "../../handlers/security/checkUser.php";

// Dynamically set login page path
$user = checkAuth('../auth/login.php');

// Access user data

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/css/sharp-light.css" />
    <link rel="stylesheet" href="../../assets/css/all.css" />
    <link rel="stylesheet" href="../../assets/css/sharp-regular.css" />
    <link rel="stylesheet" href="../../assets/css/sharp-solid.css" />
    <link rel="stylesheet" href="../../assets/css/sharp-thin.css" />
    <link rel="stylesheet" href="../../assets/css/root.css" />
    <link rel="stylesheet" href="../../assets/css/aos.css" />
    <link rel="stylesheet" href="../../assets/css/sweetalert2.css" />
    <link rel="stylesheet" href="../../assets/css/bootstrap.css" />

    <link rel="stylesheet" href="../../assets/css/pages/comunity/index.css" />
</head>

<body>
    <header class="header">
        <nav class="mt-3">
            <div class="nav__bar d-flex align-items-center gap-2">
                <div class="logo">
                    <a href="#">خطوة هِمَّة</a>
                </div>
            </div>

            <div class="button__grouop d-flex align-items-center">

                <button class="btn nav__btn px-2">
                    <a href="../../dashboard.html" class="nav-link"><i class="fa-solid fa-home ps-2"></i></a>
                </button>
            </div>
        </nav>
    </header>
    <section class="posts col-11 col-md-9 col-lg-7 col-xl-5">
        <div class="post col-12">
            <div class="user-info col-12 d-flex justify-content-between align-items-center">
                <div class="info col-12 d-flex align-items-center gap-2 flex-wrap">
                    <div class="profile-pic"><img src="../../assets/media/imgs/219983.png" alt=""></div>
                    <div class="profile-inf">
                        <div class="profile-name">omar wafeek</div>
                        <div class="post-date">11/11/2024</div>
                    </div>
                </div>
                <div class="options">
                    <button style="transform:rotate(90deg);">...</button>
                </div>
            </div>
            <div class="post-content col-12">
                <div class="text col-12">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat beatae iusto
                    quos voluptas iste mollitia deleniti tempore sit expedita? Corrupti perferendis fuga ipsa earum cum
                    nisi, repellat eum ut eaque!</div>
                <div class="img col-12">
                    <img src="../../assets/media/imgs/garden.jpg" alt="">
                </div>
            </div>
            <div class="line-options"></div>
        </div>
    </section>
</body>

</html>