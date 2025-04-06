export default class TextToSpeech {
    constructor(defaultLang = "Arabic Female") {
        this.defaultLang = defaultLang; // Default voice for Arabic
    }

    // Detect if the text contains Arabic
    detectLanguage(text) {
        const arabicPattern = /[\u0600-\u06FF]/; // Arabic Unicode range
        return arabicPattern.test(text) ? "Arabic Female" : "UK English Female"; // Fallback to English
    }

    // Speak the given text
    speak(text) {
        if (!text.trim()) {
            console.warn("No text provided to speak.");
            return;
        }

        const voice = this.detectLanguage(text);
        if (responsiveVoice.voiceSupport()) {
            responsiveVoice.speak(text, voice, {
                rate: 1, // Adjust the speech speed
                onstart: () => console.log("Speech started"),
                onend: () => console.log("Speech ended"),
                onerror: (e) => console.error("ResponsiveVoice error:", e),
            });
        } else {
            console.error("ResponsiveVoice is not supported in this browser.");
        }
    }

    // Stop any ongoing speech
    stop() {
        responsiveVoice.cancel();
    }
}

// Usage Example
document.addEventListener("DOMContentLoaded", () => {
    const tts = new TextToSpeech();

    document.addEventListener("mouseup", () => {
        const selectedText = window.getSelection().toString().trim();
        if (selectedText) {
            tts.speak(selectedText);
        }
    });
});
