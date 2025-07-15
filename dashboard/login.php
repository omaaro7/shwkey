<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/tools/all.css" />
    <link rel="stylesheet" href="assets/css/tools/sharp-light.css" />
    <link rel="stylesheet" href="assets/css/tools/sharp-regular.css" />
    <link rel="stylesheet" href="assets/css/tools/sharp-solid.css" />
    <link rel="stylesheet" href="assets/css/tools/sharp-thin.css" />
    <link rel="stylesheet" href="assets/css/tools/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/tools/sweetalert2.css" />
    <link rel="stylesheet" href="assets/css/tools/aos.css" />
    <link rel="stylesheet" href="assets/css/tools/root.css" />
    <link rel="stylesheet" href="assets/css/tools/normalize.css" />
    <link rel="stylesheet" href="assets/css/pages/login.css" />
    <title>login To admin page</title>
</head>
<body>
    <form class="login-form col-11 col-md-9 col-lg-7 col-xl-5 p-2 rounded-2" id="form">
        <div class="title col-12 fs-4 text-white text-center" >الدخول للوحة المشرف</div>
        <div class="line col-12">
            <label for="userName">اسم المستخدم</label>
            <input type="text" class="col-12" id="userName" placeholder="ادخل اسم المستخدم" >
        </div>
        <div class="line col-12">
            <label for="passWord">كلمة المرور</label>
            <input type="password" class="col-12" id="passWord" placeholder="ادخل كلمة المرور">
        </div>
        <button type="submit" class="btn">تسجيل الدخول</button>
    </form>

    <script src="assets/js/tools/aos.js"></script>
    <script src="assets/js/tools/bootstrap.js"></script>
    <script src="assets/js/tools/sweetalert2.js"></script>
    <script src="assets/js/controllers/login.js"></script>
</body>
</html>