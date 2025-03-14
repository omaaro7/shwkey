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

    <link
      rel="stylesheet"
      href="../../assets/css/pages/main/home.css"
    />
    
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
            <a href="../../dashboard.html" class="nav-link"
              ><i class="fa-solid fa-home ps-2"></i
            ></a>
          </button>
        </div>
      </nav>
      <div class="header-title fs-2 col-12 mt-5 text-center">
        <img src="../../assets/media/imgs/r.png" class="rr" alt="" />
        تصنيفات الألعاب
      </div>
    </header>
    <section
      class="boxes mt-5 p-3 pt-5 col-12 d-flex flex-wrap align-items-center justify-content-center border-0"
    ></section>
    <section class="benifits col-12 mt-5 px-2 px-lg-4 pt-4">

      <div
        class="sec-container col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4"
      >
        <div
          class="text col-12 col-lg-5"
          data-aos="zoom-in"
          data-aos-duration="700"
        >
          <div class="text-title col-12">
            <span class="fs-2">الألعاب الذهنية</span>
          </div>
          <div class="text-content col-12 mt-2">
            <p class="mt-2">
              <span>1</span>. تُساهم في تعزيز التركيز والانتباه عبر ألعاب تتطلب
              متابعة التفاصيل الصغيرة مثل البازل <span>(Puzzle)</span>.<br />
            </p>
            <p>
              <span>2</span>. تُنمي التفكير المنطقي وحل المشكلات، حيث يتعلم
              الفرد كيفية إيجاد حلول للألغاز مثل المتاهة أو ترتيب الأرقام
              <span>(Sudoku)</span>.<br />
            </p>
            <p>
              <span>3</span>. تُعد وسيلة فعالة<span>
                لتعليم ذوي الاحتياجات الخاصة
              </span>
              بطرق تتناسب مع قدراتهم وتُساهم في تنمية إدراكهم العقلي.
            </p>
          </div>
        </div>
        <div
          class="img im col-12 col-lg-5 mt-2"
          data-aos="zoom-in"
          data-aos-duration="700"
        >
          <img src="../../assets/media/imgs/thinking1.svg" alt="" />
        </div>
      </div>
    </section>
    <section
      class="sec-container f col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4 p-3"
    >
      <div
        class="img im col-12 col-lg-5 mt-2"
        data-aos="zoom-in"
        data-aos-duration="700"
      >
        <img src="../../assets/media/imgs/science.svg" alt="" />
      </div>
      <div
        class="text col-12 col-lg-5 mt-2"
        data-aos="zoom-in"
        data-aos-duration="700"
      >
        <div class="text-title col-12">
          <span class="fs-2">الألعاب العلميه</span>
        </div>
        <div class="text-content col-12 mt-2">
          <p class="mt-2">
            <span>1</span> .تعزيز مهارات حل المشكلات: الألعاب التي تتطلب حل
            مشكلات معقدة تشجع ذوي الهمم على استخدام حلول مبتكرة ومرنة لمواجهة
            التحديات<br />
          </p>
          <p>
            <span>2</span>. تقوية المهارات الإدراكية: تساعد الألعاب العلمية على
            تقوية <span>الإدراك والتفكير المنطقي</span>، مثل ترتيب الأرقام أو
            تصنيف الأشياء، مما يساهم في تحسين قدرة الأفراد على فهم وتطبيق
            المفاهيم المعقدة..<br />
          </p>
          <p>
            <span>3</span>. تقليل <span>التوتر والقلق</span>: الألعاب العلمية
            توفر بيئة <span>مرحة وآمنة</span> تساعد على تقليل القلق والتوتر، مما
            يحسن الصحة النفسية ويوفر مساحة لتفريغ الضغوطات.
          </p>
        </div>
      </div>
    </section>
    <section class="benifits col-12 mt-5 px-2 px-lg-4 pt-4">
      <div
        class="sec-container col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4" style="possition:relative;"
      >
        <div
          class="text col-12 col-lg-5"
          data-aos="zoom-in"
          data-aos-duration="700"
        >
          <div class="text-title col-12">
            <span class="fs-2">الألعاب التنسيق الحركي</span>
          </div>
          <div class="text-content col-12 mt-2">
            <p class="mt-2">
              <span>1</span>.تحسين المهارات الحركية الدقيقة والكبيرة: الألعاب
              التي تتطلب تنسيقًا بين <span>اليدين والعينين</span> أو حركات الجسم
              تساعد في تحسين التحكم العضلي.<br />
            </p>
            <p>
              <span>2</span>. تُنمي التفكير المنطقي وحل المشكلات، حيث يتعلم
              الفرد كيفية إيجاد حلول للألغاز مثل المتاهة لتقليل من التوتر
              والقلق: الألعاب الإلكترونية تقدم بيئة ممتعة وآمنة تساعد على تقليل
              التوتر والقلق لدى ذوي الهمم. عندما يتفاعلون مع الألعاب ويحققون
              الإنجازات، يشعرون بتحسن في حالتهم النفسية.<br />
            </p>
          </div>
        </div>
        <div
          class="img im col-12 col-lg-5 mt-2"
          data-aos="zoom-in"
          data-aos-duration="700"
        >
          <img
            src="../../assets/media/imgs/moving.svg"
            class="col-12"
            alt=""
          />
        </div>
      </div>
    </section>
    <section
      class="sec-container f col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-4 p-3"
    >
      <div
        class="img im col-12 col-lg-5 mt-2"
        data-aos="zoom-in"
        data-aos-duration="700"
      >
        <img
          src="../../assets/media/imgs/memory.svg"
          class="col-12"
          alt=""
        />
      </div>
      <div
        class="text col-12 col-lg-5 mt-2"
        data-aos="zoom-in"
        data-aos-duration="700"
      >
        <div class="text-title col-12">
          <span class="fs-2"> العاب الذاكره</span>
        </div>
        <div class="text-content col-12 mt-2">
          <p class="mt-2">
            <span>1</span> تحسين الذاكرة قصيرة وطويلة المدى ألعاب الذاكرة تساعد
            على تقوية القدرة على تذكر المعلومات سواء كانت قصيرة أو طويلة المدى.
            من خلال التكرار والتفاعل مع الألعاب، يمكن تعزيز قدرة الدماغ على
            تخزين واسترجاع المعلومات بشكل أسرع وأكثر دقة. .<br />
          </p>
          <p>
            <span>2</span>. تعزيز التركيز والانتباه هذه الألعاب تتطلب من اللاعب
            التركيز بشكل كامل على المهمة المطلوبة، مما يساعد في تحسين القدرة على
            الانتباه لفترات أطول. هذا يعزز قدرة ذوي الهمم على التفاعل مع المواقف
            اليومية التي تتطلب تركيزًا دقيقًا..<br />
          </p>
          <p>
             تحفيز الدماغ وتحسين الإدراك ألعاب الذاكرة توفر تحديات عقلية
            مستمرة، مما يساعد في تنشيط الدماغ وتحفيز الإدراك. من خلال المشاركة
            في هذه الألعاب، يتم تنمية المهارات المعرفية مثل التذكر، الإدراك
            البصري، والتمييز بين التفاصيل.
          </p>
        </div>
      </div>
    </section>
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
    <script
      src="../../assets/js/modules/getCookies.js"
      type="module"
    ></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=OoIbnfpU"></script>
    <script src="../../assets/js/modules/tts.js" type="module"></script>
    <script
      src="../../assets/js/pages/main/index.js"
      type="module"
    ></script>
  </body>
</html>
