<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/all.css" />
  <link rel="stylesheet" href="assets/css/sharp-light.css" />
  <link rel="stylesheet" href="assets/css/sharp-regular.css" />
  <link rel="stylesheet" href="assets/css/sharp-solid.css" />
  <link rel="stylesheet" href="assets/css/sharp-thin.css" />
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/css/sweetalert2.css" />
  <link rel="stylesheet" href="assets/css/aos.css" />
  <link rel="stylesheet" href="assets/css/root.css" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <link rel="stylesheet" href="assets/css/pages/index.css" />
  <title>معلومات عن ذوي الهمم</title>
</head>

<body>
  <section class="cover col-12 d-flex align-items-center justify-content-center flex-column " style="background: #00000094;
  position: fixed;
  height: 100vh;
  z-index: 20;
  backdrop-filter: blur(9px);
">
    <div class="imgs d-flex align-items-center justify-content-around">
    <canvas id="canvasOne" width="300" height="300" class="col-3 col-md-3 col-lg-3 col-xl-4 " style="visibility: hidden;"></canvas>
      <img src="assets/media/imgs/robot.png" class="col-4 col-md-5 col-lg-4 col-xl-3" alt="" style="    filter: drop-shadow(2px 7px 6px black);">
    <canvas id="canvasTwo" width="300" height="300" class="col-3 col-md-3 col-lg-3 col-xl-4 " style="visibility: hidden;"></canvas>
    </div>
    <button id="sayHelloBtn">ابدأ رحلتك الأن </button>

  </section>
  <header class="header">
    <nav>
      <div class="nav__bar">
        <div class="logo">
          <a href="#">خطوة هِمَّة</a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="fa-solid fa-bars"></i>
        </div>
      </div>
      <ul class="nav__links" id="nav-links">
        <li><a href="#home">الرئيسية</a></li>
        <li><a href="#about">حول</a></li>
        <li><a href="#service">الخدمات</a></li>
        <li><a href="#contact">تواصل</a></li>
      </ul>
      <a class="btn nav__btn" href="pages/auth/register.php">سجل الآن</a>
    </nav>
    <div class="section__container header__container" id="home">
      <p>ذكاء - سرعة بديهة - تسلية</p>
      <h1>
        ذوو الهمم: من هم<br />
        وكيف <span>نساهم في دعمهم </span>؟
      </h1>
    </div>


  </header>
  <section
    class="col-12 first hint-container d-flex align-items-stretch justify-content-center justify-content-lg-between flex-wrap  px-3  py-4">
    <img src="assets/media/imgs/1-Recovered.png" class="d-none d-xl-block arrow" alt="">
    <div class="hint hint-text col-11 col-lg-5" data-aos="zoom-in" data-aos-duration="600">

      <div class="essay-title col-12 d-flex align-items-center fs-2">
        <p class="m-0">
          ذوو الهمم: أبطال التحدي <span> و دعائم المجتمع ! </span>
        </p>
      </div>
      <div class="essay-text col-12 mt-3">
        <p>
          <span>ذوو الهمم</span> هم الأشخاص الذين يملكون احتياجات خاصة نتيجة
          إعاقات <span>جسدية</span>، <span>عقلية</span>، أو <span>حسية</span>،
          لكنهم في الوقت ذاته يتمتعون بقدرات فريدة تساهم في بناء المجتمع. يواجه
          ذوو الهمم تحديات متعددة، من أبرزها <span>التمييز الاجتماعي</span>،
          وصعوبة الوصول إلى <span>التعليم</span> و<span>التوظيف</span>. ومع ذلك،
          فإن <span>التمكين</span> و<span>التعليم</span> يلعبان دورًا أساسيًا في
          تعزيز استقلاليتهم وإطلاق إمكانياتهم. تسعى
          <span>التشريعات الحديثة</span> لدعم حقوق ذوي الهمم، مع التركيز على
          توفير فرص متساوية في <span>العمل</span> و<span>التعليم</span>. ويلعب
          <span>المجتمع</span> و<span>الأسرة</span> دورًا محوريًا في تقديم الدعم
          العاطفي والعملي لهم، مما يعزز من شعورهم بالانتماء والثقة بالنفس. كما
          تُعد <span>التكنولوجيا</span> أداة قوية لتمكينهم من التواصل والتنقل
          بسهولة أكبر. لذلك، من واجبنا جميعًا المساهمة في بناء
          <span>مجتمع شامل</span> يحتضن التنوع ويقدر إمكانيات كل فرد، مما يفتح
          آفاقًا جديدة نحو <span>مستقبل أفضل</span> للجميع.
        </p>
      </div>
    </div>
    <div class="hint hint-video col-11 col-lg-5" data-aos="zoom-in" data-aos-duration="600">
      <iframe src="https://www.youtube.com/embed/4N9cWWIMgvo?si=pJJBFUjo7iNgtOU9" frameborder="0"
        class="col-12"></iframe>
    </div>
  </section>
  <section class="types col-12 mt-5 pt-5 px-1 px-lg-5">
    <div class="hint types-title col-12 text-center fs-2" data-aos="fade-down" data-aos-duration="700">
      بعض أنواع <span>ذوي الهمم</span> وصفاتهم
    </div>
    <div class="types-list-container">
      <div class="type mt-5" data-aos="zoom-in" data-aos-duration="500">
        <button class="type-click col-12 text-end px-3 py-4 d-flex justify-content-between align-items-center">
          <div class="click-text">ذوو الإعاقة الحركية</div>
          <div class="click-arrow">
            <i class="fa-regular fa-angle-down mt-2"></i>
          </div>
        </button>
        <div class="item mt-1 d-none" data-aos="fade-down">
          <div class="positive">
            <div class="label">المميزات الإيجابية:</div>
            <p class="mt-2">يمتلكون عزيمة وإرادة قوية للتغلب على الصعوبات.</p>
            <p>مهارات عقلية وتنظيمية متميزة تساعدهم في أداء أعمالهم بفعالية.</p>
          </div>
          <div class="negative">
            <div class="label">الصفات التي قد تحتاج إلى دعم:</div>
            <p class="mt-2">
              قد يواجهون قيودًا في التنقل داخل الأماكن غير المهيأة.
            </p>
            <p>يحتاجون إلى أدوات أو مساعدة خارجية لتلبية احتياجاتهم اليومية.</p>
          </div>
        </div>
      </div>

      <!-- ذوو الإعاقة البصرية -->
      <div class="type" data-aos="zoom-in" data-aos-duration="700">
        <button class="type-click col-12 text-end px-3 py-4 d-flex justify-content-between align-items-center">
          <div class="click-text">ذوو الإعاقة البصرية</div>
          <div class="click-arrow">
            <i class="fa-regular fa-angle-down mt-2"></i>
          </div>
        </button>
        <div class="item mt-1 d-none" data-aos="fade-down">
          <div class="positive">
            <div class="label">المميزات الإيجابية:</div>
            <p class="mt-2">حواس أخرى قوية ومتطورة مثل السمع واللمس.</p>
            <p>قدرة على تخيل وتحليل المواقف بشكل مختلف ومبدع.</p>
          </div>
          <div class="negative">
            <div class="label">الصفات التي قد تحتاج إلى دعم:</div>
            <p class="mt-2">
              صعوبة في التعامل مع المعلومات البصرية بشكل مباشر.
            </p>
            <p>حاجة إلى الدعم في التعرف على الأماكن أو الأشخاص الجدد.</p>
          </div>
        </div>
      </div>

      <!-- ذوو الإعاقة السمعية -->
      <div class="type" data-aos="zoom-in" data-aos-duration="1000">
        <button class="type-click col-12 text-end px-3 py-4 d-flex justify-content-between align-items-center">
          <div class="click-text">ذوو الإعاقة السمعية</div>
          <div class="click-arrow">
            <i class="fa-regular fa-angle-down mt-2"></i>
          </div>
        </button>
        <div class="item mt-1 d-none" data-aos="fade-down">
          <div class="positive">
            <div class="label">المميزات الإيجابية:</div>
            <p class="mt-2">قدرة كبيرة على التواصل البصري مثل لغة الإشارة.</p>
            <p>ذكاء بصري وتحليلي قوي.</p>
          </div>
          <div class="negative">
            <div class="label">الصفات التي قد تحتاج إلى دعم:</div>
            <p class="mt-2">
              تحديات في التواصل مع الآخرين الذين لا يجيدون لغة الإشارة.
            </p>
            <p>
              صعوبة في الاستفادة من المعلومات السمعية مثل المحاضرات أو الإعلانات
              الصوتية.
            </p>
          </div>
        </div>
      </div>

      <!-- ذوو الإعاقة العقلية -->
      <div class="type" data-aos="zoom-in" data-aos-duration="1200">
        <button class="type-click col-12 text-end px-3 py-4 d-flex justify-content-between align-items-center">
          <div class="click-text">ذوو الإعاقة العقلية</div>
          <div class="click-arrow">
            <i class="fa-regular fa-angle-down mt-2"></i>
          </div>
        </button>
        <div class="item mt-1 d-none" data-aos="fade-down">
          <div class="positive">
            <div class="label">المميزات الإيجابية:</div>
            <p class="mt-2">طيبة القلب وبساطة في التعامل مع الآخرين.</p>
            <p>قدرة على التعلم والنمو مع التدريب والدعم المناسب.</p>
          </div>
          <div class="negative">
            <div class="label">الصفات التي قد تحتاج إلى دعم:</div>
            <p class="mt-2">
              حاجة مستمرة للتوجيه والإشراف في العديد من الأنشطة اليومية.
            </p>
            <p>صعوبة في حل المشكلات أو اتخاذ القرارات المعقدة.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="ways col-12 mt-5 pt-5">
    <div class="hint ways-title col-12 text-center fs-2" data-aos="fade-down" data-aos-duration="700">
      فن التعامل مع <span>ذوي الهمم</span>!
    </div>
    <div
      class="col-12 hint-container d-flex align-items-stretch justify-content-center justify-content-lg-between flex-wrap mt-5 px-3  pb-2 flex-lg-row-reverse ">

      <div class="hint  col-11 col-lg-4" data-aos="fade-up" data-aos-duration="600">
        <img src="assets/media/imgs/1-Recovered.png" class="d-none d-xl-block arrow t" alt="">

        <img src="assets/media/imgs/thinking.svg">
      </div>
      <div class="hint hint-video col-11 col-lg-7" data-aos="fade-down" data-aos-duration="600">
        <iframe src="https://www.youtube.com/embed/QOZcILKXh_w?si=eUe1t2V9YxCyrrl_"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin" allowfullscreen width="100%"></iframe>
      </div>

    </div>
  </section>
  <section class="help col-12 mt-5 pt-5">
    <div class="hint help-title col-12 text-center fs-2" data-aos="fade-down" data-aos-duration="700">

      كيف يمكننا مساعدة <span>ذوي الهمم <i class="fa-light fa-face-thinking"></i></span>؟
    </div>
    <div
      class="hint help-container col-12 d-flex flex-column flex-lg-row-reverse align-items-center justify-content-center justify-content-lg-between mt-3">
      <img src="assets/media/imgs/1-Recovered.png" class="d-none d-xl-block arrow t" alt="">


      <div class="help-text px-2 px-lg-4 py-3 col-11 col-lg-6 rounded-2" data-aos="zoom-in" data-aos-duration="700">

        <div>
          <p><span>1. كن صديقًا لطيفًا:</span> عامل ذوي الهمم بلطف واحترام. إذا رأيتهم يحتاجون مساعدة، مثل حمل شيء ثقيل
            أو الوصول إلى مكان معين، ساعدهم بابتسامة.</p>
          <p><span>2. العب معهم:</span> بعض الألعاب قد تكون صعبة على أصدقائنا من ذوي الهمم. اختر ألعابًا تناسب الجميع
            وشاركهم اللعب لتشعروا بالمرح معًا.</p>
          <p><span>3. ساعدهم في المدرسة:</span> إذا كان صديقك يواجه صعوبة في قراءة الدروس أو الكتابة، يمكنك مساعدته
            بالتفسير أو القراءة بصوت عالٍ.</p>
          <p><span>4. شجعهم دائمًا:</span> ذوو الهمم لديهم مواهب رائعة، مثل الرسم أو الرياضة أو الغناء. شجعهم على
            الاستمرار وتحدث عن إنجازاتهم أمام الآخرين.</p>
          <p><span>5. تعلم كيف تفهمهم:</span> قد يستخدم بعض أصدقائنا لغة الإشارة أو طرقًا خاصة للتواصل. حاول أن تتعلم
            كيف تتحدث معهم لتجعلهم يشعرون بأنهم جزء من فريقك.</p>
          <p><span>6. احترم احتياجاتهم:</span> بعض ذوي الهمم قد يحتاجون إلى كرسي متحرك أو أجهزة مساعدة. تأكد أن تترك
            المساحة لهم للمرور ولا تستخدم أدواتهم أو أماكنهم المخصصة دون إذن.</p>
          <p><span>7. ادعمهم في الأنشطة:</span> ساعد أصدقاءك من ذوي الهمم على المشاركة في الأنشطة الرياضية، الرحلات
            المدرسية، والمسابقات. وجودك بجانبهم يمنحهم الثقة.</p>
          <p><span>8. كن مستمعًا جيدًا:</span> إذا أراد صديقك التحدث عن شيء يشعره بالسعادة أو الحزن، استمع له وكن
            داعمًا. هذا يجعلهم يشعرون أنك تهتم حقًا.</p>
          <p><span>9. احتفل بإنجازاتهم:</span> إذا نجحوا في تحقيق شيء جديد، مثل الفوز في لعبة أو رسم لوحة جميلة، احتفل
            معهم واجعلهم يشعرون بالفخر.</p>
          <p><span>10. كن قدوة للآخرين:</span> عندما تساعد ذوي الهمم، سيراك أصدقاؤك الآخرون ويتعلمون منك. معًا يمكننا
            نشر الحب واللطف في كل مكان.</p>
        </div>
      </div>


      <div class="help-img col-11 col-lg-5"><img src="assets/media/imgs/group.png" alt="" data-aos="zoom-in"
          data-aos-duration="700"></div>
    </div>
  </section>
  <footer class="footer pt-5" id="contact">
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
        <a class="btn nav__btn col-3" href="pages/auth/register.php">سجل الآن</a>
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

  </footer>
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
  
    <script type="module">
      import { DotLottie } from "./assets/js/tools/lotties.js";

      new DotLottie({
        autoplay: true,
        loop: true,
        canvas: document.getElementById("canvasOne"),
        src: "assets/media/animations/waves.json", // replace with your .lottie or .json file URL
      });
      new DotLottie({
        autoplay: true,
        loop: true,
        canvas: document.getElementById("canvasTwo"),
        src: "assets/media/animations/waves.json", // replace with your .lottie or .json file URL
      });
    </script>
  <script src="assets/js/tools/aos.js"></script>
  <script>
    AOS.init({});
  </script>
  <script src="assets/js/tools/scrollreveal.js"></script>
  <script src="assets/js/tools/bootstrap.js"></script>
  <script src="assets/js/tools/bootstrap.min.js"></script>
  <script src="assets/js/tools/info.js"></script>
  <script src="assets/js/tools/sweetalert2.js"></script>
  <script src="assets/js/modules/getCookies.js" type="module"></script>
  <script src="https://code.responsivevoice.org/responsivevoice.js?key=OoIbnfpU"></script>
  <script src="assets/js/index.js" type="module"></script>
  <script src="assets/js/home.js" type="module"></script>
</body>

</html>