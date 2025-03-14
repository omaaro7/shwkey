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
        body{
            color: white !important;
        }
        nav {
          position: fixed;
  isolation: isolate;
  top: 10px;
  width: 100%;
  max-width: var(--max-width);
  margin: auto;
  z-index: 9;
  padding: 10px;
  background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.1),
    rgba(255, 255, 255, 0.05)
  );
  backdrop-filter: blur(20px);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  text-align: center;
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
            background-color: #6EACDA;
        }
        .game-info{
            background-color:#03346E;
        }
        .footer {
  background-color: black;
}

.footer__container {
  display: grid;
  gap: 4rem 2rem;
}

.footer__col .section__description {
  margin-block: 2rem;
  color: rgba(255, 255, 255, 0.466);
}

.footer__col h4 {
  margin-bottom: 2rem;
  font-size: 1.2rem;
  font-weight: 500;
  color: white;
}

.footer__links {
  list-style: none;
  display: grid;
  gap: 1rem;
}

.footer__links a {
  text-decoration: none;
  color: rgba(255, 255, 255, 0.466);
  transition: 0.3s;
}

.footer__links a:hover {
  color: white;
}

.footer__socials {
  margin-top: 2rem;
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.footer__socials img {
  max-width: 25px;
  opacity: 0.8;
  transition: 0.3s;
}

.footer__socials img:hover {
  opacity: 1;
}

.footer__bar {
  padding: 1rem;
  font-size: 0.9rem;
  color:rgba(255, 255, 255, 0.466);
  text-align: center;
}
@media (width > 576px) {

  .footer__container {
    grid-template-columns: repeat(2, 1fr);
  }
}

    </style>
    <title>Document</title>
</head>

<body>
    <header class="header">
        <nav>
            <div class="nav__bar d-flex align-items-center ">
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
        <div class="header-title fs-2 col-12 mt-5 text-center mt-5 pt-5">

            <span class="text-black" style="color: white !important;"></span>
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
        <section class="sticky">
  <div class="bubbles">
      <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    
  </div>
</section>
    </section>
    <footer class="footer pt-5 px-3 mt-5" id="contact">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="logo">
          <a href="#home">خطوة هِمَّة</a>
        </div>
        <p class="section__description">
          منصتنا هي الوجهة المثالية لتنمية ذكاء الأطفال وصقل مهاراتهم الفكرية
          بطريقة ممتعة ومبتكرة. نقدم مجموعة واسعة من ألعاب الذكاء التفاعلية
          المصممة لتحفيز عقول الأطفال وتعزيز التفكير النقدي والإبداعي،
          بالإضافة إلى تطوير سرعة البديهة ومهارات التحليل وحل المشكلات. تهدف
          منصتنا إلى تزويد الأطفال ببيئة تعليمية محفزة تجمع بين التعلم
          والترفيه،
        </p>
      </div>
      <div class="footer__col">
        <h4>روابط سريعة</h4>
        <ul class="footer__links">
          <li><a href="#home">الرئيسية</a></li>
          <li><a href="#about">حول</a></li>
          <li><a href="#service">الخدمات</a></li>
          <li><a href="#contact">تواصل</a></li>
        </ul>
      </div>

      <div class="footer__col">
        <h4>تواصل معنا</h4>
        <ul class="footer__links">
          <li><a href="mail.com://omarwafeek09@gmail.com">omarwafeek09@gmail.com</a></li>
        </ul>

      </div>
      <div class="footer__bar" style="width:100%;display:block;">
        حقوق النشر © 2024 omar wafeek . جميع الحقوق محفوظة.
      </div>

  </div></footer>
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