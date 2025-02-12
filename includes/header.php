<nav>
    <div class="nav__bar d-flex">
        <div class="logo">
            <a href="#">ساند طفلك</a>
        </div>
        <div class="points__box d-flex gap-2">
            <div class="points__box__title">عدد النقاط :</div>
            <div class="points__box__ammount"></div>
        </div>
    </div>

    <div class="buutton__grouop d-flex align-items-center">
        <button class="btn nav__btn user px-2">
            <i class="fa-solid fa-user ps-2"></i>
        </button>
        <button class="btn nav__btn px-2">
            <a href="../../dashboard.html" class="nav-link"><i class="fa-solid fa-home ps-2"></i></a>
        </button>
    </div>
</nav>
<section class="profile col-12 d-none justify-content-center align-items-center">
    <style>
        .profile {
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            background-color: rgba(0, 0, 0, 0.322);
            z-index: 1000;
        }

        .profile-info {
            position: relative;
            background-color: white;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            color: var(--main-color);
            font-size: 30px;
            cursor: pointer;
            transition: all 0.5s;
        }

        .close:hover {
            color: red;
        }

        .line-value {
            color: var(--main-color);
        }
    </style>
    <div class="profile-info col-11 col-md-9 col-lg-7 col-xl-5 p-3 rounded-2">
        <div class="close">
            <i class="fa-sharp fa-solid fa-circle-xmark"></i>
        </div>
        <div class="info-title col-12 text-center fs-4 pb-2 " style="border-bottom:solid 3px var(--main-color);">
            البيانات الشخصية</div>
        <div class="lines col-12">
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name">اسم المستخدم : </div>
                <div class="line-value name"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> تاريخ الميلاد : </div>
                <div class="line-value age"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name">اسم ولي الامر : </div>
                <div class="line-value parent-name"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> ولي الامر : </div>
                <div class="line-value parent-type"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> رقم ولي الامر : </div>
                <div class="line-value parent-phone"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> عدد الألعاب المكتملة : </div>
                <div class="line-value completed-games"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> نسبة الذكاء : </div>
                <div class="line-value intilligence-persent"> </div>
            </div>
            <div class="line col-12 mt-3 d-flex justify-content-between align-items-center">
                <div class="line-name"> عدد الألعاب غير المكتملة : </div>
                <div class="line-value uncompleted-games"> </div>
            </div>
        </div>
    </div>
</section>
<script>
    function getCookieValue(cookieName) {
        console.log("Current document.cookie:", document.cookie); // Debugging log
        const cookies = document.cookie.split("; ");
        for (const cookie of cookies) {
            const [name, ...valueParts] = cookie.split("=");
            if (decodeURIComponent(name) === cookieName) {
                const value = decodeURIComponent(valueParts.join("="));
                console.log(`Found cookie: ${cookieName} = ${value}`); // Debugging log
                return value;
            }
        }
        console.log(`Cookie ${cookieName} not found.`); // Debugging log
        return undefined; // Explicitly return undefined if not found
    }

    let coinsBox = document.querySelector(".points__box__ammount");
    async function setCoins() {
        console.log(getCookieValue("token"));

        let res = await fetch(`../../handlers/getData.php?table=users&token=${getCookieValue("token")}`)
        let data = await res.json()
        console.log(data);

        coinsBox.textContent = data[0].coins;
    }
    setCoins();
    let clicker = document.querySelector(".user");
    let box = document.querySelector(".profile");
    console.log(clicker);
    async function getData() {
        let res = await fetch(`../../handlers/getData.php?table=users&token=${getCookieValue("token")}`)
        let data = await res.json()
        let labels = document.querySelectorAll(".line-value")
        console.log(data);

        labels[0].innerHTML = data[0].name
        labels[1].innerHTML = data[0].date_birth
        labels[2].innerHTML = data[0].parent_name
        labels[3].innerHTML = data[0].parent_type
        labels[4].innerHTML = data[0].parent_phonenumber
        labels[5].innerHTML = JSON.parse(data[0].finshed_games).length
        let resT = await fetch(`../../handlers/getData.php?table=games&active=1`)
        let dataT = await resT.json()

        labels[7].innerHTML = dataT.length - JSON.parse(data[0].finshed_games).length
        labels[6].innerHTML = `${(JSON.parse(data[0].finshed_games).length / dataT.length) * 100}%`

    }
    getData()
    let closer = document.querySelector(".close i");
    closer.addEventListener("click", function () {
        box.classList.replace("d-flex", "d-none")
    })
    clicker.addEventListener("click", function () {
        box.classList.replace("d-none", "d-flex");
    })
</script>