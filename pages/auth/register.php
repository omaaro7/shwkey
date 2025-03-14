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
  </head>
  <body>
    <div class="container">
      <header> التسجيل </header>
      <form class="form" action="/">
        <div class="form first">
          <div class="details personal">
            <span class="title">البيانات الشخصية </span>
            <div class="fields">
              <div class="input-field">
                <label>الاسم بالكامل </label>
                <input
                  type="text"
                  placeholder="Enter your child name"
                  required
                  class="val"
                />
              </div>
              <div class="input-field">
                <label>تاريخ الميلاد </label>
                <input type="date" placeholder="Enter birth date" required  class="val" />
              </div>
              <div class="input-field">
                <label>النوع</label>
                <select class="val" required>
                  <option disabled selected style="color:white;">اختر الجنس</option>
                  <option>ذكر</option>
                  <option>أنثى</option>
                </select>
              </div>
            </div>
          </div>
          <div class="details Parent">
            <span class="title">بيانات ولي الأمر </span>
            <div class="fields">
              <div class="input-field">
                <label>الاسم بالكامل </label>
                <input type="text" placeholder="Enter your name" required class="val"/>
              </div>
              <div class="input-field">
                <label>تاريخ الميلاد </label>
                <input type="date" placeholder="Enter birth date" required class="val"/>
              </div>
              <div class="input-field">
                <label>المستخد</label>
                <select required class="val">
                  <option disabled selected>اختر المستخدم</option>
                  <option>الأب</option>
                  <option>الأم</option>
                  <option>الجد</option>
                  <option>الجده</option>
                  <option>الخال</option>
                  <option>الخالة</option>
                  <option>العم</option>
                  <option>العمه</option>
                </select>
              </div>
            </div>
          </div>
          <div class="details Account">
            <span class="title">بيانات الحساب (تسجيل الدخول) </span>
            <div class="fields">
              <div class="input-field">
                <label> اسم المستخدم </label>
                <input
                  type="text"
                  placeholder="Enter your user name"
                  required
                  class="val"
                />
              </div>
              <div class="input-field">
                <label> كلمة المرور </label>
                <input
                  type="password"
                  placeholder="Enter your password"
                  required
                  class="pass val"
                />
              </div>
              <div class="input-field">
                <label> تأكيد كلمة المرور </label>
                <input
                  type="password"
                  placeholder="repeat your password"
                  required
                  class="repass "
                />
              </div>
              <div class="input-field">
                <label> رقم الهاتف لاسترداد الحساب </label>
                <input
                  type="text"
                  placeholder="Enter your phone number"
                  required
                  class="phone val"
                />
              </div>
            </div>
          </div>
          <div class="buttons col-12 d-flex align-items-center ">
            <button type="submit">تسجيل</button>
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
          <a href="login.php" style="color:#008ee0e5">هل لديك حساب بالفعل </a>
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
    <script src="../../assets/js/controllers/register.js"></script>
  </body>
</html>
