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
    <section class="add-post col-11 col-md-9 col-lg-7 col-xl-5 mt-4">
        <div class="container-add-post col-12 p-3 rounded-3">
            <div class="profAndTyping col-12 d-flex justify-content-around align-items-center pb-2">
                <div class="prof "><img src="../../assets/media/imgs/219983.png" alt=""></div>
                <div class="typing col-10 px-2 pt-2">اكتب ما تريد ....</div>
                <div class="typing-box-container col-12 d-none">
                    <div class="typing-box  col-11 col-md-9 col-lg-7 col-xl-5 px-3 py-2">
                        <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
                        <div class="box-title col-12 text-center text-white fs-3">كتابة منشور</div>
                        <div class="box-content col-12 mt-2">
                            <textarea name="post-content" id="textArea" placeholder="اكتب منشورك"
                                class="col-12"></textarea>
                            <label for="upload-photo" class="px-3 py-2 text-white rounded-1 ">ارفاق صوره <i
                                    class="fa-light fa-camera me-1"></i></label>
                            <input type="file" name="photo" id="upload-photo" class="d-none">
                            <div
                                class="personaity-choises d-flex col-12 justify-content-between align-items-center mt-2">
                                <button class="choise col-5 text-center text-white rounded-2 py-2" id="choise-1"
                                    data-visibility="1"><i class="fa-light fa-user ms-1"></i> معروف</button>
                                <button class="choise col-5 text-center text-white rounded-2 py-2" id="choise-2"
                                    data-visibility="0"><i class="fa-light fa-alien ms-1"></i> مجهول</button>
                            </div>
                            <button class="publish col-12 mt-2 py-2 text-white rounded-5 " id="publish"><i
                                    class="fa-regular fa-up-from-line ms-1"></i>نشر</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons col-12 d-flex align-items-center justify-content-between text-white mt-2">
                <div class="button-1 p-1"><i class="fa-solid fa-comment-question ms-1"
                        style="color: #63E6BE;font-size:20px;"></i>استبيان</div>
                <div class="button-2 p-1"><i class="fa-solid fa-calendar-check ms-1"
                        style="color:#B197FC; font-size: 20px;"></i> حجز ميعاد </div>
                <div class="button-3 p-1"><i class="fa-solid fa-face-smile ms-1"
                        style="color:#FFD438; font-size: 20px;"></i> شعور</div>
                <div class="feelings-box-container col-12 d-none">
                    <div class="feelings-box col-11 col-md-9 col-lg-7 col-xl-5 px-3 py-2">
                        <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
                        <div class="box-title col-12 text-center text-white fs-3"> اوصف شعورك</div>
                        <div
                            class="box-content col-12 mt-2 d-flex flex-wrap justify-content-between align-items-center">
                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="1">
                                <i class="fas fa-face-smile" style="color: yellow; font-size:30px;"></i>
                                <div class="emoji-label mt-1">Happy</div>
                            </div>

                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="2">
                                <i class="fas fa-face-frown" style="color: orange; font-size:30px;"></i>
                                <div class="emoji-label mt-1">Sad</div>
                            </div>

                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="3">
                                <i class="fas fa-face-angry" style="color: red; font-size:30px;"></i>
                                <div class="emoji-label mt-1">Angry</div>
                            </div>

                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="4">
                                <i class="fas fa-face-surprise" style="color: pink; font-size:30px;"></i>
                                <div class="emoji-label mt-1">Surprised</div>
                            </div>

                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="5">
                                <i class="fas fa-face-grin-hearts" style="color: lightblue; font-size:30px;"></i>
                                <div class="emoji-label mt-1">In Love</div>
                            </div>

                            <div class="emoji col-4 d-flex flex-column align-items-center mt-2" data-feel="6">
                                <i class="fas fa-face-tired" style="color: gray; font-size:30px;"></i>
                                <div class="emoji-label mt-1">Tired</div>
                            </div>
                            <button class="publish-feeling col-12 text-white rounded-3 mt-3 py-2">اعرض مشاعرك <i
                                    class="fa-light fa-up-from-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="posts col-11 col-md-9 col-lg-7 col-xl-5 mt-4">
    </section>

    <div class="addd-quistitionair-container col-12 d-none">
        <div class="addd-quistitionair  col-11 col-md-9 col-lg-7 col-xl-5 p-2">
            <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
            <div class="add-quistitionair-title col-12 py-2 fs-3 text-center text-white">اضف استبيان</div>
            <div class="quistisionair-title-box col-12">
                <div class="title text-white fs-5">عنوان الاسبيان...</div>
                <input type="text" placeholder="العنوان" class="col-12 q-title rounded-2 px-2 py-1 mt-2">
            </div>
            <div class="choise-type col-12">
            <div class="title text-white fs-5 mt-1">اضف الاختيارات</div>

            <input type="text" placeholder="اكتب اختيار" class="col-12 q-option rounded-2 px-2 py-1 mt-2">
            </div>
            <div class="add-option mt-2 text-white">
                <span>اضافة اجابة</span><i class="fa-light fa-square-plus me-2"></i>

            </div>
            
            <div class="choises col-12 mt-2" >
                
            </div>

            <button class="save-quistitionaire col-12 py-2 mt-2 rounded-2">ارسال</button>
        </div>
    </div>
    <div class="add-comment-container col-12 d-none">
        <div class="add-comment col-11 col-md-9 col-lg-7 col-xl-5 px-3 py-2">
            <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
            <div class="add-comment-title col-12 py-2 fs-3 text-center text-white">اضف تعليق</div>
            <div class="comment-field col-12">
                <textarea name="comment" class="col-12" placeholder="اكتب تعليقك...."></textarea>
                <label for="add-comment-photo" class="px-2 py-1 rounded-2 mt-2 text-white"
                    style="background-color:rgb(49, 114, 163);cursor: pointer;">اضف صورة <i
                        class="fa-light fa-camera me-1"></i></label>
                <input type="file" id="add-comment-photo" class="d-none">
                <div class="photo-preview col-12 mt-2">
                    <img src="" class="col-12">
                </div>
                <button class="send-comment col-12 text-white border-0 py-1 rounded-2">ارسال</button>
            </div>
        </div>
    </div>
    <div class="comments-viewer-container col-12 d-none">
        <div class="comments-viewer col-11 col-md-9 col-lg-7 col-xl-5 px-3 py-2">
            <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
            <div class="comments-title col-12 text-white fs-3 text-center">كل التعليقات</div>
            <div class="comments-box col-12">
                <div class="comment-box mt-2 d-flex flex-column">
                    <div class="comment  p-2 mt-2 ">
                        <div class="user-info col-12 d-flex align-items-center gap-2">
                            <div class="profile pic d-flex justify-content-center align-items-center"><img
                                    src="../../uploads/pictures/67da186d72d46_482027768_1024986966345205_4634616679795430358_n.jpg"
                                    alt="">
                            </div>
                            <div class="user-name">omar wafeek</div>

                        </div>
                        <div class="comment-text mt-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, facilis voluptatum,
                            earum nostrum error commodi ipsam hic quaerat incidunt perferendis nihil possimus facere
                            velit amet neque quibusdam suscipit doloribus quam!
                        </div>
                        <div class="comment-img col-12 mt-2">
                            <img src="../../uploads/pictures/67da186d72d46_482027768_1024986966345205_4634616679795430358_n.jpg"
                                alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="share-box-container col-12 d-none">
        <div class="share-box col-11 col-md-9 col-lg-8 col-xl-6 px-3 py-2">
            <div class="closer"><i class="fa-solid fa-circle-xmark"></i></div>
            <div class="share-title col-12 text-white fs-3 text-center">مشاركة</div>
            <div class="socials col-12 mt-3 d-flex justify-content-between gap-2 align-items-center flex-wrap">
                <div class="social social-1 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="text  text-white">whatsapp</div>
                </div>
                <div class="social social-2 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-facebook"></i></div>
                    <div class="text  text-white">facebook</div>
                </div>
                <div class="social social-3 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-instagram"></i></div>
                    <div class="text  text-white">instagram</div>
                </div>
                <div class="social social-4 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-facebook-messenger"></i></div>
                    <div class="text  text-white">messanger</div>
                </div>
                <div class="social social-5 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-instagram"></i></div>
                    <div class="text  text-white">story</div>
                </div>
                <div class="social social-6 d-flex align-items-center flex-column">
                    <div class="icon fs-2"><i class="fa-brands fa-snapchat"></i></div>
                    <div class="text  text-white">snap chat</div>
                </div>
            </div>
            <div
                class="link-copy-box col-12 mt-3 d-flex align-items-center justify-content-between px-2 py-2 rounded-2">
                <div class="link col-10">https://khatwat-hema.com/post/11</div>
                <div class="copy col-1 px-2 rounded-2 py-2"><i class="fa-light fa-copy fs-5"></i></div>
            </div>
        </div>
    </div>
    <script src="../../assets/js/tools/aos.js"></script>

    <script>
        AOS.init({});
    </script>
    <script src="../../assets/js/tools/bootstrap.js"></script>
    <script src="../../assets/js/tools/bootstrap.min.js"></script>
    <script src="../../assets/js/tools/info.js"></script>
    <script src="../../assets/js/tools/sweetalert2.js"></script>
    <script src="../../assets/js/modules/getCookies.js" type="module"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=OoIbnfpU"></script>
    <script src="../../assets/js/modules/tts.js" type="module"></script>
    <script src="../../assets/js/pages/comunity/index.js"></script>
</body>

</html>