// Check for SpeechRecognition support
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

if (!SpeechRecognition) {
  alert('Your browser does not support the Web Speech API.');
} else {
  const recognition = new webkitSpeechRecognition();
  recognition.lang = 'ar-EG'; // Arabic language (Egyptian dialect)
  recognition.continuous = true; // Keep listening continuously
  recognition.interimResults = false; // Final results only

  // Start recognition automatically
  recognition.start();

  recognition.onresult = (event) => {
    // Clean the command by removing unwanted characters and trimming spaces
    let command = event.results[event.results.length - 1][0].transcript.trim();
    
    // Remove any non-Arabic characters, except question mark
    command = command.replace(/[^\w\s\u0600-\u06FF؟]/g, '');

    // Remove the question mark only if it's at the end of the string
    if (command.endsWith('؟')) {
      command = command.slice(0, -1); // Remove last character (the question mark)
    }

    console.log('Recognized command:', command);

    // Check if the command contains one of the directions (for example, "فوق")
    if (command.includes('فوق')) {
      simulateKeyPress(38); // Up Arrow key code
    } else if (command.includes('تحت')) {
      simulateKeyPress(40); // Down Arrow key code
    } else if (command.includes('يمين')) {
      simulateKeyPress(39); // Right Arrow key code
    } else if (command.includes('يسار')) {
      simulateKeyPress(37); // Left Arrow key code
    } else {
      console.log('Unknown command:', command);
    }
  };

  recognition.onerror = (event) => {
    console.error('Speech recognition error:', event.error);
    if (event.error === 'not-allowed') {
      alert('Microphone access is not allowed. Please enable it.');
    }
  };

  recognition.onend = () => {
    console.log('Speech recognition stopped. Restarting...');
    recognition.start(); // Restart recognition on end
  };

  // Function to simulate keypress events with key codes
  function simulateKeyPress(keyCode) {
    const keyDownEvent = new KeyboardEvent('keydown', { keyCode: keyCode, bubbles: true });
    const keyUpEvent = new KeyboardEvent('keyup', { keyCode: keyCode, bubbles: true });

    // Dispatch the keydown and keyup events
    document.dispatchEvent(keyDownEvent);
    document.dispatchEvent(keyUpEvent);
    console.log(`Simulated keypress with key code: ${keyCode}`);
  }
}
