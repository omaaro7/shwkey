function getCookieValue(cookieName) {
    const cookies = document.cookie.split("; ");
    for (const cookie of cookies) {
      const [name, value] = cookie.split("=");
      if (name === cookieName) {
        return value;
      }
    }
  }

const card = document.querySelectorAll(".cell");
const front = document.querySelectorAll(".front");
const container = document.querySelector(".container");
const score = document.querySelector(".score span");
suffleImage();
clicking();
function suffleImage() {
  card.forEach((c) => {
    const num = [...Array(card.length).keys()];
    const random = Math.floor(Math.random() * card.length);

    c.style.order = num[random];
  });
}

function clicking() {
  for (let i = 0; i < card.length; i++) {
    front[i].classList.add("show");

    setInterval(() => {
      front[i].classList.remove("show");
    }, 2000);

    card[i].addEventListener("click", () => {
      front[i].classList.add("flip");
      const filppedCard = document.querySelectorAll(".flip");

      if (filppedCard.length == 2) {
        container.style.pointerEvents = "none";

        setInterval(() => {
          container.style.pointerEvents = "all";
        }, 1000);

        match(filppedCard[0], filppedCard[1]);
      }
    });
  }
}

function match(cardOne, cardTwo) {
  if (cardOne.dataset.index == cardTwo.dataset.index) {
    cardOne.classList.remove("flip");
    cardTwo.classList.remove("flip");

    cardOne.classList.add("match");
    cardTwo.classList.add("match");

    score.innerHTML = parseInt(score.innerHTML) + 1;

    if (parseInt(score.innerHTML) == card.length / 2) {
      Swal.fire({
        icon: "success",
        title: `لقد فزت وحصلت على ${localStorage.getItem("gamePoints")} نقطة`,
      }).then(async () => {
        let res = await fetch(
          `../../handlers/getData.php?table=users&token=${getCookieValue(
            "token"
          )}`
        );
        let dt = await res.json();
        let user = dt[0];
        let finshed = JSON.parse(user.finshed_games);
        console.log(finshed);

        finshed.push(localStorage.getItem("gameId"));
        console.log(user);

        let points = user.coins;
        let gamePoints = localStorage.getItem("gamePoints");
        let total = +points + +gamePoints;

        const data = {
          coins: total,
          finshed_games: JSON.stringify(finshed),
        };

        let req = await fetch(
          `../../handlers/putData.php?token=${getCookieValue("token")}&id=${
            user.id
          }&table=users`,
          {
            method: "PUT",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
          }
        );
        if (req.ok) {
            window.parent.location = "../../pages/main/home.php"
          }
      });
    }
  } else {
    setTimeout(() => {
      cardOne.classList.remove("flip");
      cardTwo.classList.remove("flip");
    }, 500);
  }
}
