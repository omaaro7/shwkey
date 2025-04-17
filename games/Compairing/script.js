import getCookieValue from "../../assets/js/modules/getCookies.js";
let inf = 0;

window.onload = async () => {
  Swal.fire({
    icon:"warning",
    title:"تنبيهات ",
    html:"<h5>لتغير السؤال قل سؤال وبعدها رقم السؤال<h5><br><h5>لتغير الاجابة قل   رقم الاجابة<h5>"
    
  })
  let res = await fetch(
    `../../handlers/getData.php?table=users&token=${getCookieValue("token")}`
  );
  let data = await res.json();
  inf = data[0];
};
let sender = document.querySelector(".send-answers");

//////////////////////////////////////////////////////////////////
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
      answersRes.forEach((it) => {
        clickers[it.q_index].classList.add("active");
      });
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
      unAplQuest = questionsLenght - aplQuests;
      vals[2].textContent = aplQuests;
      vals[3].textContent = unAplQuest;
    });
  });
})();
//####################################################################################
//send answers
(() => {
  sender.addEventListener("click", async (e) => {
    let grade = 0;
    answersRes.map((ele, index) => {
      if (ele.state == true) {
        grade++;
      }
    });
    Swal.fire({
      title: "هل انت متأكد",
      text: "سيتم تسليم اجاباتاك اذا وافقت",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "لا",
      confirmButtonText: "موافق",
    }).then(async (result) => {
      if (result.isConfirmed) {
        let finshed = JSON.parse(inf.finshed_games);
        let coins = +inf.coins;
        finshed.push(localStorage.getItem("gameId"));
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
              coins: coins + grade,
              finshed_games: JSON.stringify(finshed),
            }),
          }
        ).then(() => {
          Swal.fire({
            title: ` تم تسليم اجاباتاك بنجاح وحصلت على  ${grade} نقطة`,
            icon: "success",
          }).then(() => {
            window.parent.location = "../../pages/main"
          })
        })
      }
    });
  });
})();
//####################################################################################
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
// ################### التعرف على الصوت ###################
window.addEventListener("load", () => {
  const SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition;

  if (!SpeechRecognition) {
    alert("المتصفح لا يدعم التعرف على الصوت");
    return;
  }

  const arabicToNumber = {
    واحد: "1",
    "١": "1",
    1: "1",
    اثنين: "2",
    اتنين: "2",
    "٢": "2",
    2: "2",
    ثلاثة: "3",
    ثلاثه: "3",
    تلاتة: "3",
    ثلاثه: "3",
    ثلاثه: "3",
    ثلاثه: "3",
    "٣": "3",
    3: "3",
    أربعة: "4",
    اربعة: "4",
    اربعه: "4",
    "٤": "4",
    4: "4",
    خمسة: "5",
    خمسه: "5",
    "٥": "5",
    5: "5",
    ستة: "6",
    سته: "6",
    "٦": "6",
    6: "6",
    سبعة: "7",
    سبعه: "7",
    "٧": "7",
    7: "7",
    تمانية: "8",
    ثمانية: "8",
    "٨": "8",
    8: "8",
    تسعة: "9",
    تسعه: "9",
    "٩": "9",
    9: "9",
    عشرة: "10",
    "١٠": "10",
    10: "10",
    حداشر: "11",
    "إحدى عشر": "11",
    "١١": "11",
    11: "11",
    اتناشر: "12",
    "اثنا عشر": "12",
    "١٢": "12",
    12: "12",
    تلتاشر: "13",
    "ثلاثة عشر": "13",
    "١٣": "13",
    13: "13",
    اربعتاشر: "14",
    "أربعة عشر": "14",
    "١٤": "14",
    14: "14",
    خمستاشر: "15",
    "خمسة عشر": "15",
    "١٥": "15",
    15: "15",
  };

  const recognition = new SpeechRecognition();
  recognition.lang = "ar-EG"; // اللغة العربية المصرية
  recognition.continuous = true;
  recognition.interimResults = false;

  recognition.onresult = (event) => {
    const transcript =
      event.results[event.results.length - 1][0].transcript.trim();
    console.log("🗣 الكلام اللي اتقال:", transcript);

    // أوامر التأكيد
    if (
      transcript.includes("موافق") ||
      transcript.includes("تمام") ||
      transcript.includes("اكيد") ||
      transcript.includes("متأكد")
    ) {
      const confirmBtn = document.querySelector(".swal2-confirm");
      if (confirmBtn) {
        confirmBtn.click();
        console.log("✔ تم الضغط على موافق");
      } else {
        console.log("⚠ لا يوجد زر موافق");
      }
      return;
    }

    if (
      transcript.includes("لا") ||
      transcript.includes("متبعتش") ||
      transcript.includes("مخلصتش") ||
      transcript.includes("هكمل")
    ) {
      const cancelBtn = document.querySelector(".swal2-cancel");
      if (cancelBtn) {
        cancelBtn.click();
        console.log("✔ تم الضغط على لا");
      } else {
        console.log("⚠ لا يوجد زر لا");
      }
      return;
    }

    // أوامر الإرسال
    if (
      transcript.includes("حفظ") ||
      transcript.includes("إرسال") ||
      transcript.includes("سلم") ||
      transcript.includes("ارسال") ||
      transcript.includes("ابعت") ||
      transcript.includes("خلصت")
    ) {
      if (sender) {
        sender.click();
        console.log("✔ تم الضغط على زر الإرسال");
      } else {
        console.log("⚠ لا يوجد زر للإرسال");
      }
      return;
    }

    // تقسيم الكلام إلى كلمات منفصلة والبحث عن رقم مطابق
    const words = transcript.split(/\s+/);
    let matchedNumber = null;
    for (const word of words) {
      if (arabicToNumber[word]) {
        matchedNumber = arabicToNumber[word];
        break;
      }
    }
    if (!matchedNumber) return;

    // لو الكلام يحتوي على "سؤال" أو "رقم"، نعتبره طلب فتح سؤال
    if (transcript.includes("سؤال") || transcript.includes("رقم")) {
      const questionBtn = document.querySelector(
        `.q-num[data-qu="${matchedNumber}"]`
      );
      if (questionBtn) {
        questionBtn.click();
        console.log(`✔ تم الضغط على السؤال رقم ${matchedNumber}`);
      } else {
        console.log(`⚠ لا يوجد سؤال برقم ${matchedNumber}`);
      }
    } else {
      // لو الرقم بين 1 و 4 نعتبره إجابة، وإلا نعتبره سؤال
      if (parseInt(matchedNumber) >= 1 && parseInt(matchedNumber) <= 4) {
        const answerBtn = document.querySelector(
          `.answer[data-an="${matchedNumber}"]`
        );
        if (answerBtn) {
          answerBtn.click();
          console.log(`✔ تم الضغط على الاختيار رقم ${matchedNumber}`);
        } else {
          console.log(`⚠ لا يوجد اختيار برقم ${matchedNumber}`);
        }
      } else {
        const questionBtn = document.querySelector(
          `.q-num[data-qu="${matchedNumber}"]`
        );
        if (questionBtn) {
          questionBtn.click();
          console.log(`✔ تم الضغط على السؤال رقم ${matchedNumber}`);
        } else {
          console.log(`⚠ لا يوجد سؤال برقم ${matchedNumber}`);
        }
      }
    }
  };

  recognition.onerror = (event) => {
    console.error("❌ خطأ في التعرف على الصوت:", event.error);
    if (
      event.error === "not-allowed" ||
      event.error === "service-not-allowed"
    ) {
      alert("يرجى السماح باستخدام المايكروفون");
    } else {
      recognition.stop();
      setTimeout(() => recognition.start(), 2000);
    }
  };

  recognition.onend = () => {
    setTimeout(() => recognition.start(), 1000);
  };

  recognition.start(); // نبدأ التسجيل أول ما الصفحة تفتح
});
