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
    <link rel="stylesheet" href="../../assets/css/pages/main/home.css" />
    <style>
        nav {
            padding: 15px 20px;
            position: static;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav__bar {
            padding: 0;
            background-color: transparent;
        }

        .nav__menu__btn {
            display: none;
        }

        .nav__links {
            padding: 0;
            width: unset;
            position: static;
            transform: none;
            flex-direction: row;
            background-color: transparent;
        }

        .nav__btn {
            display: block;
        }

        .nav__links a::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background-color: var(--primary-color);
            transition: 0.3s;
            transform-origin: left;
        }

        .nav__links a:hover::after {
            width: 100%;
        }

        .lines {
            width: 100%;
            padding: 10px 15px;
            border-radius: 10px;
            background-color: white;
        }
        .game-info{
            background-color: #f3f4f6;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <header class="header">
        <nav>
            <div class="nav__bar d-flex align-items-center ">
                <div class="logo">
                    <a href="#">ساند طفلك</a>
                </div>
            </div>

            <div class="button__grouop d-flex align-items-center">
                
                <button class="btn nav__btn px-2">
                    <a href="../../dashboard.html" class="nav-link"><i class="fa-solid fa-home ps-2"></i></a>
                </button>
            </div>
        </nav>
        <div class="header-title fs-2 col-12 mt-5 text-center mt-5 pt-5">
            <img src="../../assets/media/imgs/paper.png" class="rr d-none d-lg-block" alt="" style="transform: rotate(0);
    width: 20%;
    height: 71px;
    bottom: -11px;
    right: 41%;
    z-index: -2;" />
            <span class="text-black"></span>
        </div>
    </header>

    <section class="game-container col-12 d-flex justify-content-between align-items-stretch px-3 mt-5">
        <div class="game-info col-12 col-lg-4 p-4 rounded-2 mt-3">
            <div class="game-img col-12 ">
                <img src="" class="col-12" alt="">
            </div>
            <div class="game-details col-12 ">
                <div class="lines coins col-12 mt-3 d-flex justify-content-between px-2">
                    <div class="name col-6"> عدد النقاط : </div>
                    <div class="value col-6 text-start"></div>
                </div>
                <div class="lines level col-12 mt-3 d-flex justify-content-between px-2">
                    <div class="name col-6">مستوى اللعبة</div>
                    <div class="value col-6 text-start"></div>
                </div>
                <div class="lines supporte-ticniqs col-12 mt-3 d-flex justify-content-between px-2">
                    <div class="name col-6">التقنيات التاحة :</div>
                    <div class="value col-6 text-start"></div>
                </div>
                <div class="lines aim-to col-12 mt-3 d-flex justify-content-between px-2">
                    <div class="name col-6">تهدف الى : </div>
                    <div class="value col-6 text-start"></div>
                </div>
            </div>
        </div>
        <div class="game-play col-12 col-lg-7">
        <iframe  frameborder="0" width="100%" style="height: 100%;" class="mt-3 rounded-2"></iframe>
        </div>
    </section>
    <script src="../../assets/js/tools/aos.js"></script>
    <script>
        AOS.init({});
    </script>
    <script src="../../assets/js/tools/bootstrap.js"></script>
    <script src="../../assets/js/tools/bootstrap.min.js"></script>
    <script src="../../assets/js/tools/info.js"></script>
    <script src="../../assets/js/tools/sweetalert2.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=OoIbnfpU"></script>
    <script src="../../assets/js/modules/tts.js" type="module"></script>
    <script src="../../assets/js/modules/getCookies.js" type="module"></script>
    <script src="../../assets/js/pages/main/game.js" type="module"></script>
</body>

</html>