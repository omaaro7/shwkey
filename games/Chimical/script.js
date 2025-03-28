import getCookieValue from "../../assets/js/modules/getCookies.js";
let inf = 0;
window.onload = async () => {
  let res = await fetch(
    `../../handlers/getData.php?table=users&token=${getCookieValue("token")}`
  );
  let data = await res.json();
  inf = data[0];
};
// Custom page
let colors = [
  {
    "colors": ["#FF0000", "#0000FF"],
    "choices": ["بنفسجي", "أخضر", "برتقالي"],
    "correct_answer": "بنفسجي"
  },
  {
    "colors": ["#FF0000", "#FFFF00"],
    "choices": ["أزرق فاتح", "برتقالي", "وردي"],
    "correct_answer": "برتقالي"
  },
  {
    "colors": ["#0000FF", "#FFFF00"],
    "choices": ["أخضر", "رمادي", "كحلي"],
    "correct_answer": "أخضر"
  },
  {
    "colors": ["#FF0000", "#FFFFFF"],
    "choices": ["وردي", "رمادي", "بني"],
    "correct_answer": "وردي"
  },
  {
    "colors": ["#0000FF", "#FFFFFF"],
    "choices": ["كحلي", "أزرق فاتح", "ليموني"],
    "correct_answer": "أزرق فاتح"
  },
  {
    "colors": ["#000000", "#FFFFFF"],
    "choices": ["رمادي", "وردي", "بني"],
    "correct_answer": "رمادي"
  },
  {
    "colors": ["#FF0000", "#008000"],
    "choices": ["بني", "كحلي", "زيتي"],
    "correct_answer": "بني"
  },
  {
    "colors": ["#0000FF", "#008000"],
    "choices": ["سماوي", "أرجواني", "ليموني"],
    "correct_answer": "سماوي"
  },
  {
    "colors": ["#FFFF00", "#008000"],
    "choices": ["ليموني", "أزرق فاتح", "بني"],
    "correct_answer": "ليموني"
  },
  {
    "colors": ["#0000FF", "#000000"],
    "choices": ["كحلي", "رمادي", "برتقالي"],
    "correct_answer": "كحلي"
  },
  {
    "colors": ["#FFFF00", "#000000"],
    "choices": ["زيتي", "أخضر", "بني"],
    "correct_answer": "زيتي"
  },
  {
    "colors": ["#FF0000", "#000000"],
    "choices": ["أحمر داكن", "وردي", "رمادي"],
    "correct_answer": "أحمر داكن"
  }
]

let boxes = document.querySelectorAll(".box")
let ind = Math.floor(Math.random() * 9)
let chs = document.querySelectorAll(".choies")
boxes[0].style.background = `${colors[ind].colors[0]}`
boxes[1].style.background = `${colors[ind].colors[1]}`

console.log(colors[ind]);

chs.forEach((ele , index) => {
  ele.textContent = colors[ind].choices[index]
})

// Check for SpeechRecognition support
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (!SpeechRecognition) {
  alert('Your browser does not support the Web Speech API.');
} else {
  const recognition = new SpeechRecognition();
  recognition.lang = 'ar-EG'; // Arabic language (Egyptian dialect)
  recognition.continuous = true; // Keep listening continuously
  recognition.interimResults = false; // Final results only

  // Add click event listener to start recognition
  recognition.start();
  console.log('Speech recognition started...');

  recognition.onresult = async(event) => {
    let uP = +inf.coins;
    let poients = +localStorage.getItem("gamePoints");
    let finshed = JSON.parse(inf.finshed_games);
    // Get the recognized command
    let command = event.results[event.results.length - 1][0].transcript.trim();

    // Remove any non-Arabic characters
    command = command.replace(/[^\u0600-\u06FF\s]/g, '');

    // Remove the question mark if it's at the end
    if (command.endsWith('؟')) {
      command = command.slice(0, -1); // Remove last character (the question mark)
    }

    console.log('Recognized command:', command);

    // Check if the command includes the correct answer
    if (command.includes(colors[ind].correct_answer)) {
      console.log(true);
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
          }),
        }
      );
      Swal.fire({
        icon: 'success',
        title:`مبروك لقد ربحت ${localStorage.getItem("gamePoints")}`

      })
    }
    // Check if the command includes any of the choices
    if (command.includes(colors[ind].choices[0]) || command.includes(colors[ind].choices[1]) || command.includes(colors[ind].choices[2])) {
      Swal.fire({
        icon: 'error',
        title:`حظ اوفر`

      }).then(() => {
        window.parent.location = "../../pages/main/home.php"
      })
    }
  };

  recognition.onerror = (event) => {
    console.error('Speech recognition error:', event.error);
    if (event.error === 'not-allowed') {
      alert('Microphone access is not allowed. Please enable it.');
    }
  };
  let micDiv = document.querySelector(".mic-box")
  micDiv.addEventListener('click', () => {
    recognition.start();
    console.log('Speech recognition started...');
  });
  recognition.onend = () => {
    console.log('Speech recognition stopped. Click on the mic to restart.');
  };
}
