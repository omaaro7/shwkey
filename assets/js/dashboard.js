import getCookieValue from "./modules/getCookies.js";
//get games info
let gamesLength = 0;
let games = [];
let endFinish = "";
let finishsOb = [];
let comFinishsOb =[]
let unComFinishsOb = []
async function getGamesInfo() {
  let res = await fetch(`handlers/getData.php?table=games`);
  let data = await res.json();
  games = data;
  gamesLength = data.length;
}
//controlle analytics
let valueBox = document.querySelectorAll(".box-content-value");
let buttons = document.querySelectorAll(".box-content-details-shower button");
let finshed = 0;
let unfinshed = 0;
let coins = 0;
//set val
async function setVals() {
  let res = await fetch(
    `handlers/getData.php?table=users&token=${getCookieValue("token")}`
  );
  let data = await res.json();
  finshed = data[0].finshed_games;
  coins = data[0].coins;
  endFinish = JSON.parse(finshed);

  console.log(endFinish);
  console.log(endFinish);

  valueBox[0].textContent = coins;
  valueBox[1].textContent = endFinish.length;
  valueBox[2].textContent = gamesLength - endFinish.length;
}
let aplOne = await getGamesInfo();
let aplTwo = await setVals();
//manage details
async function gameInf() {
  
  games.forEach((ele, index) => {
    endFinish.forEach((el) => {
      if (el == ele.id) {
        finishsOb.push({
          gameName: ele.name,
          value: ele.points,
        });
      }
    });
  });
}
let aplThree = await gameInf();
async function comGameInf() {
    games.forEach((ele, index) => {
      endFinish.forEach((el) => {
        if (el == ele.id) {
            comFinishsOb.push({
            gameName: ele.name,
            value: ele.category,
          });
        }
      });
    });
  }
  let aplFour = await comGameInf();
  async function unComGameInf() {
    games.forEach((ele, index) => {
      endFinish.forEach((el) => {
        if (el != ele.id) {
            unComFinishsOb.push({
            gameName: ele.name,
            value: ele.category,
          });
        }
      });
    });
  }
  let aplFive = await unComGameInf();
//handle show or hide details

async function showOrHideDetails() {
    let box = document.querySelector(".details-container");
    buttons.forEach((ele,index) => {
        ele.addEventListener("click" , () => {
            box.classList.replace("d-none","d-flex")
            let val =""
            let ob = []
            let title = ""
            if (index == 1 ) {
                val = "التصنيف"
                ob =comFinishsOb
                title = `تفاصيل الالعاب المكتملة`
                

            }
            if (index == 2) {
                val = "التصنيف"
                ob = unComFinishsOb
                title = `تفاصيل الالعاب غير المكتملة`

            }
            if (index == 0){
                val="عدد النقاط"
                ob = finishsOb
                title = `تفاصيل  النقاط`

            }
            box.firstElementChild.lastElementChild.previousElementSibling.lastElementChild.textContent = `${val}`
            box.firstElementChild.firstElementChild.nextElementSibling.textContent = `${title}`
            ob.map((it) => {
                let line = `
            <div class="line col-12 d-flex justify-content-between mt-2">
                    <div class="name col-6 text-center">${it.gameName}</div>
                    <div class="value col-6 text-center" style="color: var(--main-color);">${it.value}</div>
            </div>`
            box.firstElementChild.lastElementChild.innerHTML += line
            })
            box.firstElementChild.firstElementChild.firstElementChild.onclick = () => {
                box.classList.replace("d-flex","d-none");
                box.firstElementChild.lastElementChild.innerHTML = ""
            }
            
        })
    })
}
let aplSix = await showOrHideDetails();
