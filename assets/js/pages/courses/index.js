(async () => {
  try {
    let res = await fetch(`../../handlers/getData.php?table=courses&order_dir=DESC&limit=20`);
    
    if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
    
    let data = await res.json();

    let coursesBox = document.querySelector(".courses");
    if (!coursesBox) {
      console.error("Element with class 'courses' not found.");
      return;
    }

    if (!Array.isArray(data) || data.length === 0) {
      coursesBox.innerHTML = `<div class="text-center col-12 mt-4">لا توجد دورات متاحة حالياً</div>`;
      return;
    }

    data.forEach((ele, index) => {
      let courseStracture = `
        <div class="course-container col-12 col-md-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center mt-3">
          <div class="course col-11 aos-init aos-animate" data-aos="zoom-in" data-aos-duration="600">
            <div class="course-img col-12">
              <img src="../../assets/media/imgs/courses/${ele.thumbnail}" alt="${ele.title || 'course image'}" />
            </div>
            <div class="course-text-col-12 p-2 pb-3">
              <div class="course-title fs-5">${ele.title || 'عنوان الدورة'}</div>
              <div class="course-discription mt-2">
                ${ele.description || 'لا يوجد وصف متاح لهذه الدورة.'}
              </div>
              <div class="separetor col-12 mt-3"></div>
              <div class="line d-flex align-items-center justify-content-between col-12 mt-2">
                <div class="category">${ele.category || 'غير مصنف'}</div>
                <button class="open px-3 py-2 rounded-3 border-0 text-white">الدخول للدورة</button>
              </div>
            </div>
          </div>
        </div>
      `;
      coursesBox.innerHTML += courseStracture;
    });
  } catch (error) {
    console.error("Error loading courses:", error);
    document.querySelector(".courses").innerHTML = `<div class="text-danger col-12 text-center mt-4">حدث خطأ أثناء تحميل الدورات</div>`;
  }
})();
