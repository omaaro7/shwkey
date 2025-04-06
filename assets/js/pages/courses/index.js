//show courses 

(async () => {
    let res = await fetch(`../../handlers/getData.php?table=courses&order_dir=DESC&limit=20`)
    let data = await res.json()
let coursesBox = document.querySelector(".courses");
    data.map((ele,index) => {
        let courseStracture = `
        <div
        class="course-container col-12 col-md-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center"
      >
        <div class="course col-11" data-aos="zoom-in" data-aos-duration="600">
          <div class="course-img col-12">
            <img src="../../assets/media/imgs/courses/1.jpg" alt="" />
          </div>
          <div class="course-text-col-12 p-2 pb-3">
            <div class="course-title fs-5">الدوره الأولى</div>
            <div class="course-discription mt-2">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt
              saepe adipisci magni, voluptas mollitia temporibus minima
              dignissimos perspiciatis sapiente atque aut nam illo repudiandae
              cumque non quae, corporis, in sequi.
            </div>
            <div class="separetor col-12 mt-3"></div>
            <div
              class="line d-flex align-items-center justify-content-between col-12 mt-2"
            >
              <div class="category">المكفوفين</div>
              <button class="open px-3 py-2 rounded-3 border-0 text-white ">الدخول للدورة</button>
            </div>
          </div>
        </div>
      </div>
    `
    coursesBox.innerHTML += courseStracture
    })
    
})();