import getCookieValue from "../../assets/js/modules/getCookies.js";
let bt = document.querySelector(".btn");
let ifr = document.querySelector("iframe");
let box = document.querySelector(".qustions-box");
let inf = 0;
window.onload = async () => {
  let res = await fetch(
    `../../handlers/getData.php?table=users&token=${getCookieValue("token")}`
  );
  let data = await res.json();
  inf = data[0];
};
bt.addEventListener("click", (e) => {
  e.preventDefault();
  e.target.remove();
  ifr.remove();
  box.style.visibility = "visible";
});
let ans = document.querySelectorAll(".answer");
ans.forEach((e) => {
  e.addEventListener("click", async (e) => {
    e.preventDefault();
    console.log(inf);
    
    let uP = +inf.coins;
    
    let poients = +localStorage.getItem("gamePoints");
    let finshed = JSON.parse(inf.finshed_games);
    finshed.push(localStorage.gameId);
    console.log(e.target);
    
    if (e.target.dataset.cor == "1") {
      console.log("tttttttttt");
      
      let res = await fetch(
        `../../handlers/putData.php?table=users&id=${
          inf.id
        }&token=${getCookieValue("token")}`,
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            coins: uP + poients,
            finshed_games: JSON.stringify(finshed),
          })
        }
      )
        Swal.fire({
          title: `تهانينا لقد ربحت ${localStorage.getItem("gamePoints")} نقطة`,
          icon: "success",
        }).then(() =>{
        })
    } if (e.target.dataset.cor !== "1") {
      let res = await fetch(
        `../../handlers/putData.php?table=users&id=${
          inf.id
        }&token=${getCookieValue("token")}`,
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            finshed_games: JSON.stringify(finshed),
          }),
        }
      );
      let data = await res.json();
      Swal.fire({
        title: "حظ أوفر",
  
        icon: "error",
      }).then(() => (console.log("err")
      ));
    }
  });
});
