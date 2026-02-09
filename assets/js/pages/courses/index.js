//show categories
(async () => {
  let categories = await fetch(
    "../../handlers/handleCourses.php?type=categories"
  );
  let res = await categories.json();
  let categoriesBox = document.querySelector(".categories-box");
  res.data.categories.items.forEach((item) => {
    let category = document.createElement("div");
    category.className =
      "category-box col-12 col-md-6 col-lg-4 col-xl-3 d-flex align-items-center justify-content-center";
    category.innerHTML = `
          <div class="category col-11 px-3 py-4">
            <div class="category-title d-flex align-items-center justify-content-between">
              <div class="text">${item.name}</div>
              <div class="icon">
                <div class="icon-box">
                  <i class="fa-light fa-book-open-reader"></i>
                </div>
              </div>
            </div>
            <div class="category-desc mt-3">
              ${item.description}
            </div>
            <div class="line d-flex justify-content-between align-items-center mt-3">
              <div class="numOfCourses">عدد الكورسات <span>${item.metrics.total_courses}</span></div>
              <button class="btn-open" onclick="location.href = './course.html?id=${item.id}'">فتح القسم</button>
            </div>
          </div>
    `;
    categoriesBox.appendChild(category);
  });
})();

