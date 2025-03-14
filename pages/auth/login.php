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
    <link rel="stylesheet" href="../../assets/css/aos.css">
    <link rel="stylesheet" href="../../assets/css/sweetalert2.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../../assets/css/pages/auth/form.css" />
    <title>سجل اللآن</title>
    <style>
      form .fields .input-field{
        width: 100%;
      }
      </style>
  </head>
  <body>
    <div class="container">
      <header> الدخول للحساب </header>
      <form class="form" action="/">
        <div class="form first col-12">
          <div class="details personal col-12">
            <div class="fields col-12">
              <div class="input-field col-12">
                <label> رقم الهاتف </label>
                <input
                  type="text"
                  placeholder="Enter your phone"
                  required
                  class="val col-12"
                />
              </div>
              <div class="input-field col-12">
                <label> كلمة المرور </label>
                <input type="password" placeholder="Enter yout password  " required  class="val" />
              </div>

            </div>
          </div>
          <div class="buttons col-12 d-flex align-items-center ">
            <button type="submit">دخول</button>
            <div class="d-flex gap-2 align-items-center">
              <a
                href="../../index.php"
                class="nav-link back me-2"
                style="color: #008ee0e5"
              >
              رجوع <i class="fa-solid fa-chevron-left"></i>
            </a>
          </div>
          </div>
          <a href="register.php" style="color:#008ee0e5">   انشاء حساب جديد </a>
        </div>
      </form>
    </div>
    <div class="text col-6 d-flex align-items-center justify-content-center">
      <div class="section__container text__container" id="home" >
        <p data-aos="zoom-in" data-aos-duration="400" >ذكاء - سرعة بديهة - تسلية</p>
        <h1 data-aos="zoom-in" data-aos-duration="600">نمي مهارات طفلك <br />بطرق مسلية <span data-aos="zoom-in" data-aos-duration="800">و تابع تطوره</span>.</h1>
      </div>
    </div>

    <script src="../../assets/js/tools/aos.js"></script>
    <script>AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      
    });</script>
    <script src="../../assets/js/tools/bootstrap.js"></script>
    <script src="../../assets/js/tools/bootstrap.min.js"></script>
    <script src="../../assets/js/tools/info.js"></script>
    <script src="../../assets/js/tools/sweetalert2.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=OoIbnfpU"></script>
    <script src="../../assets/js/modules/tts.js" type="module"></script>
    <script src="../../assets/js/controllers/login.js"></script>
  </body>
</html>

