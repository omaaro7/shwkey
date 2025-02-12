import getCookies from "../../modules/getCookies.js"
let title = document.querySelector(".header-title span" )
console.log(title);

title.textContent = localStorage.getItem("categoryName")
let box = document.querySelector(".boxes")

window.onload = async() => {
    let res = await fetch(`../../handlers/getData.php?table=games&category=${localStorage.getItem("categoryName")}`)
    let data = await res.json()
    let animate = 0
    let id = 0
    let maping = await data.map((ele,index) => {
        let item = `
            <div
    class="box col-11 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center"
    data-aos="zoom-in" data-aos-duration="${400 + animate}"
  >
    <div class="box-content col-11 py-2 px-3" data-id="${ele.id}">
    <div class="box-image col-12 d-flex justify-content-center">
    <img src"omar.jpg"/>
    </div>
      <div class="box-title col-12 p-3">${index +1}. ${ele.name}</div>
      <div class="box-desc col-12 p-3">
        <p>
          ${ele.description}
        </p>
      </div>
      <div class="box-button col-12 p-3 d-flex justify-content-between align-items-center">
        <button class="btn btn-game nav__btn" data-id="${id}">اذهب الآن !</button>
        <div class="points-calc">عدد النقاط : <span>${ele.points}</span></div>
      </div>
    </div>
  </div>
        `
        box.innerHTML += item
        animate += 100
        id++
    })
    console.log(getCookies("token"));
    let conts = document.querySelectorAll(".box-content");
    let resTwo = await fetch(`../../handlers/getData.php?table=users&token=${getCookies("token")}`)
    let dataTwo = await resTwo.json()
    let finshed = JSON.parse(dataTwo[0].finshed_games)
    console.log(finshed);
    
     conts.forEach((el,index) => {
        finshed.forEach((ele) => {
          if(ele == el.dataset.id){
            let spa = document.createElement("span")
            spa.textContent = "لقد اكملت هذه اللعبة بنجاح ! "
              conts[index].lastElementChild.firstElementChild.replaceWith(spa)
              conts[index].lastElementChild.firstElementChild.style.color = "#00a3a3"
          }
        })
    })
    

    let buttons = document.querySelectorAll(".btn-game")
    buttons.forEach((ele,index) => {
        ele.addEventListener("click" , async (e) => {
          console.log(data[e.target.dataset.id]);
          
            localStorage.setItem("gameId",data[e.target.dataset.id].id)
            localStorage.setItem("gameName",data[e.target.dataset.id].name)
            localStorage.setItem("gamePoints",data[e.target.dataset.id].points)
            localStorage.setItem("gameFolder",data[e.target.dataset.id].path)
            localStorage.setItem("thumnail",data[e.target.dataset.id].thumnail)
            localStorage.setItem(`${data[e.target.dataset.id].storage_value}`,`${data[e.target.dataset.id].storage_value_value}`)
            window.location = "game.php"
        })
    })
}