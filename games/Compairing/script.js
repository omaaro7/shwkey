const questions = [
  {
    question: "أي عدد أكبر؟ 5 أم 1؟",
    choices: ["5 أكبر", "3 أكبر", "متساويان", "لا أعرف"],
    answer: "5 أكبر",
  },
  {
    question: "أي عدد أصغر؟ 2 أم 6؟",
    choices: ["2 أصغر", "4 أصغر", "متساويان", "لا أعرف"],
    answer: "2 أصغر",
  },
  {
    question: "هل العدد 10 يساوي 10؟",
    choices: ["نعم، متساويان", "لا، 10 أكبر", "لا، 10 أصغر", "لا أعرف"],
    answer: "نعم، متساويان",
  },
  {
    question: "أي عدد أصغر؟ 3 أم 9؟",
    choices: ["7 أصغر", "9 أصغر", "متساويان", "لا أعرف"],
    answer: "7 أصغر",
  },
  {
    question: "أي عدد أكبر؟ 12 أم 8؟",
    choices: ["12 أكبر", "8 أكبر", "متساويان", "لا أعرف"],
    answer: "12 أكبر",
  },
  {
    question: "أي عدد أصغر؟ 15 أم 20؟",
    choices: ["15 أصغر", "20 أصغر", "متساويان", "لا أعرف"],
    answer: "15 أصغر",
  },
  {
    question: "هل العدد 6 يساوي 6؟",
    choices: ["نعم، متساويان", "لا، 6 أكبر", "لا، 6 أصغر", "لا أعرف"],
    answer: "نعم، متساويان",
  },
  {
    question: "أي عدد أكبر؟ 14 أم 10؟",
    choices: ["14 أكبر", "13 أكبر", "متساويان", "لا أعرف"],
    answer: "14 أكبر",
  },
  {
    question: "أي عدد أصغر؟ 0 أم 1؟",
    choices: ["0 أصغر", "1 أصغر", "متساويان", "لا أعرف"],
    answer: "0 أصغر",
  },
  {
    question: "أي عدد أكبر؟ 20 أم 10؟",
    choices: ["20 أكبر", "10 أكبر", "متساويان", "لا أعرف"],
    answer: "20 أكبر",
  },
  {
    question: "هل العدد 15 يساوي 15؟",
    choices: ["نعم، متساويان", "لا، 15 أكبر", "لا، 15 أصغر", "لا أعرف"],
    answer: "نعم، متساويان",
  },
  {
    question: "أي عدد أصغر؟ 10 أم 20؟",
    choices: ["10 أصغر", "20 أصغر", "متساويان", "لا أعرف"],
    answer: "10 أصغر",
  },
  {
    question: "أي عدد أكبر؟ 15 أم 5؟",
    choices: ["15 أكبر", "5 أكبر", "متساويان", "لا أعرف"],
    answer: "15 أكبر",
  },
  {
    question: "هل العدد 9 يساوي 9؟",
    choices: ["نعم، متساويان", "لا، 9 أكبر", "لا، 9 أصغر", "لا أعرف"],
    answer: "نعم، متساويان",
  },
  {
    question: "أي عدد أصغر؟ 18 أم 20؟",
    choices: ["18 أصغر", "20 أصغر", "متساويان", "لا أعرف"],
    answer: "18 أصغر",
  },
];
let answersRes = [];

//#########################################################################
let quistition = document.querySelector(".quistition");
let answers = document.querySelectorAll(".answer");
let Numbers = document.querySelectorAll(".number");
let imgs_containers = document.querySelectorAll(".img");
let vals = document.querySelectorAll(".val");
let quist_nums_container = document.querySelector(".question-numbers");
//#########################################################################
let questionsLenght = questions.length;
let currentQuestion = 1;
let aplQuests = 0;
let unAplQuest = questionsLenght;
//#########################################################################
//controlle details
vals[0].textContent = questionsLenght;
vals[1].textContent = currentQuestion;
vals[2].textContent = aplQuests;
vals[3].textContent = unAplQuest;
questions.map((ele, index) => {
  let act = "";
  index == 0 ? (act = "active") : "";
  let item = `<div class="q-num p-1 ${act}" data-qu="${index + 1}">${
    index + 1
  }</div>`;
  quist_nums_container.innerHTML += item;
});
//########################################################################
//show first quistition
quistition.innerHTML = questions[currentQuestion - 1].question;
answers.forEach(
  (ele, index) =>
    (ele.innerHTML = questions[currentQuestion - 1].choices[index])
);
let text = questions[currentQuestion - 1].question;
let numbers = text.match(/\d+/g).map(Number);
setNumsAndImgs(numbers);
//########################################################################

//handling and  switch quistitions
(() => {
  let clickers = document.querySelectorAll(".q-num");
  clickers.forEach((ele, index) => {
    ele.addEventListener("click", (e) => {
      answers.forEach((el) => el.classList.remove("active"));

      imgs_containers[0].innerHTML = "";
      imgs_containers[1].innerHTML = "";
      clickers.forEach((clicker) => clicker.classList.remove("active"));
      e.target.classList.add("active");
      quistition.textContent = questions[index].question;
      for (let i = 0; i < answers.length; i++) {
        answers[i].textContent = questions[index].choices[i];
      }

      currentQuestion = Number(e.target.textContent);
      answersRes.map((res) => {
        console.log(res.q_index, currentQuestion - 1);

        if (res.q_index == currentQuestion - 1) {
          answers[res.choise].classList.add("active");
        }
      });
      console.log(currentQuestion);

      let text = questions[currentQuestion - 1].question;
      console.log(text);

      let numbers = text.match(/\d+/g).map(Number);
      setNumsAndImgs(numbers);
      vals[1].textContent = currentQuestion;
    });
  });
})();
//####################################################################################
//handle answer on quistion
(() => {
  let checker = "";
  answers.forEach((ele, index) => {
    ele.addEventListener("click", (e) => {
      answers.forEach((ans) => {
        ans.classList.remove("active");
      });

      e.target.classList.add("active");
      checker = true;
      answersRes.forEach((el) => {
        if (el.q_index == currentQuestion - 1) {
          if (e.target.textContent == questions[currentQuestion - 1].answer) {
            el.state = true;
          } else {
            el.state = false;
          }
          el.choise = index;
          checker = false;
        }
      });
      console.log(checker);

      if (checker) {
        if (e.target.textContent == questions[currentQuestion - 1].answer) {
          answersRes.push({
            q_index: currentQuestion - 1,
            choise: index,
            state: true,
          });
        } else {
          answersRes.push({
            q_index: currentQuestion - 1,
            choise: index,
            state: false,
          });
        }
      }

      console.log(answersRes);
      aplQuests = answersRes.length;
      vals[2].textContent = aplQuests
    });
  });
})();

//helpers
function setNumsAndImgs(numbers) {
  let randomNumber = Math.floor(Math.random() * 5) + 1;
  console.log(numbers);

  Numbers.forEach((ele, index) => {
    ele.innerHTML = numbers[index];
    for (let i = 0; i < +numbers[index]; i++) {
      imgs_containers[
        index
      ].innerHTML += `<img src="${randomNumber}.png" alt="">`;
    }
  });
}
