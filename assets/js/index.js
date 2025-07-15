const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");
const robotSec = document.querySelector(".cover");
let checker = false;
menuBtn.addEventListener("click", () => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
});

navLinks.addEventListener("click", () => {
  navLinks.classList.remove("open");
});

class TextToSpeech {
  speak(text, lang = "Arabic Female", callback = null) {
    if (typeof responsiveVoice !== "undefined") {
      responsiveVoice.speak(text, lang, {
        onend: function () {
          if (callback) callback();
        },
      });
    } else {
      console.error("responsiveVoice library is not loaded.");
    }
  }

  sayHello(callback) {
    const greetings = {
      arabic: `هَيَّا بِنَا نَبْدَأْ رِحْلَتَنَا فِي عَالَمٍ وَاسِعٍ وَكَبِيرٍ، مَلِيءٍ بِالْمُغَامَرَاتِ وَالتَّعَلُّمِ وَالْمَرَحِ!
فِي ذَلِكَ الْعَالَمِ، أَشْيَاءُ كَثِيرَةٌ تَنْتَظِرُكَ، سَتُدْهِشُكَ وَتُسْعِدُكَ إِلَى أَقْصَى حَدٍّ!
هَلْ أَنْتَ مُسْتَعِدٌّ؟ شُدَّ انْتِبَاهَكَ، وَرَكِّزْ جَيِّدًا، لِأَنَّ الْقَادِمَ سَيَكُونُ مُمْتِعًا وَمَلِيئًا بِالتَّحَدِّيَاتِ!
وَلَكِنْ، قَبْلَ أَنْ نَنْطَلِقَ... أَخْبِرْنِي، مَا اسْمُكَ؟ أُرِيدُ أَنْ أَتَعَرَّفَ عَلَيْكَ!`,
    };
    this.speak(greetings.arabic, "Arabic Female", callback);
  }

  greetByName(name, callback) {
    const phrase = `تَشَرَّفْتُ بِمَعْرِفَتِكَ، يَا ${name}! هَيَّا نَنْطَلِقُ فِي مُغَامَرَتِنَا الأُولَى!`;
    this.speak(phrase, "Arabic Female", callback);
    checker = true;
  }
}

document.addEventListener("DOMContentLoaded", () => {
  let clicked = false;
  const tts = new TextToSpeech();
  const clicker = document.getElementById("sayHelloBtn");
  const canveses = document.querySelectorAll("canvas");

  clicker.addEventListener("click", () => {
    clicker.remove();
    canveses[0].style.visibility = "visible";
    canveses[1].style.visibility = "visible";
    setTimeout(() => {
      tts.sayHello(() => {
        startListening();
      });
    }, 1000);
  });

  function startListening() {
    const SpeechRecognition =
      window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
      alert("المتصفح لا يدعم التعرف على الصوت.");
      return;
    }

    const recognition = new SpeechRecognition();
    recognition.lang = "ar-EG";
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;

    recognition.start();

    recognition.onresult = async (event) => {
      const name = event.results[0][0].transcript;
      // نكمل الرد بعد الاسم
      const tts = new TextToSpeech();
      tts.greetByName(name);
      if (checker) {
        robotSec.classList.add("d-none");
      }
    };

    recognition.onerror = (event) => {
      console.error("خطأ في التعرف على الصوت:", event.error);
      alert("حصلت مشكلة أثناء الاستماع. حاول مرة تانية.");
    };
  }
});
