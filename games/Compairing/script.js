const questions = [
  { 
      question: "أي عدد أكبر؟ 5 أم 1؟", 
      choices: ["5 أكبر", "3 أكبر", "متساويان", "لا أعرف"], 
      answer: "5 أكبر" 
  },
  { 
      question: "أي عدد أصغر؟ 2 أم 6؟", 
      choices: ["2 أصغر", "4 أصغر", "متساويان", "لا أعرف"], 
      answer: "2 أصغر" 
  },
  { 
      question: "هل العدد 10 يساوي 10؟", 
      choices: ["نعم، متساويان", "لا، 10 أكبر", "لا، 10 أصغر", "لا أعرف"], 
      answer: "نعم، متساويان" 
  },
  { 
      question: "أي عدد أصغر؟ 3 أم 9؟", 
      choices: ["7 أصغر", "9 أصغر", "متساويان", "لا أعرف"], 
      answer: "7 أصغر" 
  },
  { 
      question: "أي عدد أكبر؟ 12 أم 8؟", 
      choices: ["12 أكبر", "8 أكبر", "متساويان", "لا أعرف"], 
      answer: "12 أكبر" 
  },
  { 
      question: "أي عدد أصغر؟ 15 أم 20؟", 
      choices: ["15 أصغر", "20 أصغر", "متساويان", "لا أعرف"], 
      answer: "15 أصغر" 
  },
  { 
      question: "هل العدد 6 يساوي 6؟", 
      choices: ["نعم، متساويان", "لا، 6 أكبر", "لا، 6 أصغر", "لا أعرف"], 
      answer: "نعم، متساويان" 
  },
  { 
      question: "أي عدد أكبر؟ 14 أم 10؟", 
      choices: ["14 أكبر", "13 أكبر", "متساويان", "لا أعرف"], 
      answer: "14 أكبر" 
  },
  { 
      question: "أي عدد أصغر؟ 0 أم 1؟", 
      choices: ["0 أصغر", "1 أصغر", "متساويان", "لا أعرف"], 
      answer: "0 أصغر" 
  },
  { 
      question: "أي عدد أكبر؟ 100 أم 50؟", 
      choices: ["100 أكبر", "50 أكبر", "متساويان", "لا أعرف"], 
      answer: "100 أكبر" 
  },
  { 
      question: "هل العدد 25 يساوي 25؟", 
      choices: ["نعم، متساويان", "لا، 25 أكبر", "لا، 25 أصغر", "لا أعرف"], 
      answer: "نعم، متساويان" 
  },
  { 
      question: "أي عدد أصغر؟ 30 أم 40؟", 
      choices: ["30 أصغر", "40 أصغر", "متساويان", "لا أعرف"], 
      answer: "30 أصغر" 
  },
  { 
      question: "أي عدد أكبر؟ 55 أم 45؟", 
      choices: ["55 أكبر", "45 أكبر", "متساويان", "لا أعرف"], 
      answer: "55 أكبر" 
  },
  { 
      question: "هل العدد 9 يساوي 9؟", 
      choices: ["نعم، متساويان", "لا، 9 أكبر", "لا، 9 أصغر", "لا أعرف"], 
      answer: "نعم، متساويان" 
  },
  { 
      question: "أي عدد أصغر؟ 18 أم 22؟", 
      choices: ["18 أصغر", "22 أصغر", "متساويان", "لا أعرف"], 
      answer: "18 أصغر" 
  }
];
//#########################################################################
let quistition = document.querySelector(".quistition");
let answers = document.querySelectorAll(".answer")
let Numbers = document.querySelectorAll(".number")
let imgs_containers = document.querySelectorAll(".img")
let vals = document.querySelectorAll(".val")
let quist_nums_container = document.querySelector(".question-numbers")
//#########################################################################
let questionsLenght = questions.length
let currentQuestion = 1
let aplQuests = 0
let unAplQuest = questionsLenght
//#########################################################################
//controlle details
vals[0].textContent = questionsLenght
vals[1].textContent = currentQuestion
vals[2].textContent = aplQuests
vals[3].textContent = unAplQuest
questions.map((ele,index) => {
    let item = `<div class="q-num p-1" data-qu="${index+1}">${index+1}</div>`
    quist_nums_container.innerHTML+=item
})
//########################################################################
//show first quistition 
quistition.innerHTML = questions[0].question
answers.forEach((ele,index) => ele.innerHTML = questions[0].choices[index])
let text = questions[0].question;
let numbers = text.match(/\d+/g).map(Number);
Numbers.forEach((ele,index) => {
  ele.innerHTML = numbers[index]
  for (let i = 0; i < +numbers[index]; i++) {
    imgs_containers[index].innerHTML += `<img src="image.png" alt="">`
  }
})
//########################################################################

//handling and  switch quistitions
(() => {
    
})()