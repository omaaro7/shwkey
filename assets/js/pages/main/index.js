import getCookieValue from "../../modules/getCookies.js";
let box = document.querySelector(".boxes");
let categories = [];
let gameDetails = [];
async function getCategoriesPoints() {
  let response = await fetch("../../handlers/getData.php?table=games");
  let data = await response.json();
  data.map((ele) => {
    gameDetails.push({
      category: ele.category,
      points: ele.points,
    });
  });
}

window.onload = async () => {
  let allGames = await getCategoriesPoints();
  let res = await fetch(`../../handlers/getData.php?table=categories`);
  let data = await res.json();
  console.log(data);

  let maping = await data.map((ele, index) => {
    let cl = "no";
    ele.active == "1" ? (cl = "yes") : (cl = "no");
    let item = `
            <div
    class="box col-11 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center mt-2"
    data-aos="zoom-in" data-aos-duration="1100"
  >
    <div class="box-content col-11 py-2 px-3 ${cl}">
      <div class="box-title col-12 p-3">${index + 1}. ${ele.name}</div>
      <div class="box-desc col-12 p-3">
        <p>
          ${ele.description}
        </p>
      </div>
      <div class="box-button col-12 p-3 d-flex justify-content-between align-items-center">
        <button class="btn btn-game nav__btn" data-id="${ele.id}" data-name="${
      ele.name
    }">اذهب الآن !</button>
        <div class="points-calc">عدد النقاط : <span>
          ele.total_points</span></div>
      </div>
    </div>
  </div>
        `;
    box.innerHTML += item;
    categories.push(ele.name);
  });
  let pointsBox = document.querySelectorAll(".points-calc span");
  pointsBox.forEach((ele, index) => {
    let catPoints = 0;
    gameDetails.forEach((el) => {
      if (el.category === categories[index]) {
        catPoints += +el.points;
      }
    });
    ele.textContent = catPoints;
    console.log(ele);
  });
  let buttons = document.querySelectorAll(".btn-game");
  buttons.forEach((ele, index) => {
    ele.addEventListener("click", async (e) => {
      let setCategory = await localStorage.setItem(
        "categoryId",
        e.target.dataset.id
      );
      localStorage.setItem("categoryName", e.target.dataset.name);
      window.location = "play.php";
    });
  });
};
console.log(getCookieValue("token"));
