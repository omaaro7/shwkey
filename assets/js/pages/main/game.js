import getCookieValue from "../../modules/getCookies.js";
let frame = document.querySelector("iframe");
let title = document.querySelector(".text-black")
let im = document.querySelector(".game-img img")
title.textContent = localStorage.getItem("gameName")
frame.src = `../../games/${localStorage.getItem("gameFolder")}/index.html`
im.src = `../../assets/media/imgs/thumnails/${localStorage.getItem("thumnail")}`

//put game info

let infoLines = document.querySelectorAll(".lines .value");
window.onload = async() => {
    let res = await fetch(`../../handlers/getData.php?table=games&id=${localStorage.getItem("gameId")}`)
    let data = await res.json()
    infoLines[0].textContent = data[0].points
    infoLines[1].textContent = data[0].level
    infoLines[2].textContent = data[0].tech
    infoLines[3].textContent = data[0].description
    
}