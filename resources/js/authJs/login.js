const form = document.querySelector('form');
if (!form) throw new Error("Form not found");

const emailInput = form.email;
const passwordInput = form.password;
const emailDesc = document.getElementById('email-desc');
const passwordDesc = document.getElementById('password-desc');

if (!emailInput || !passwordInput || !emailDesc || !passwordDesc) {
  throw new Error("Required form elements not found");
}

// Validate email format
const validateEmail = () => {
  const valid = emailInput.validity.valid;
  emailDesc.style.display = valid ? 'none' : 'block';
  return valid;
};

// Validate password length
const validatePassword = () => {
  const valid = passwordInput.validity.valid;
  passwordDesc.style.display = valid ? 'none' : 'block';
  return valid;
};

// Event listeners for live validation
emailInput.addEventListener('input', validateEmail);
passwordInput.addEventListener('input', validatePassword);

// Form submit handler
form.addEventListener('submit', e => {
  const validEmail = validateEmail();
  const validPassword = validatePassword();

  // Block form submission if any field is invalid
  if (!validEmail || !validPassword) {
    e.preventDefault(); // only prevent when there’s an error
    if (!validEmail) {
      emailInput.focus();
    } else if (!validPassword) {
      passwordInput.focus();
    }
  }
});

// --------- Typing animation ---------
document.addEventListener('DOMContentLoaded', () => {
  const typingText = document.getElementById('typing-text');
  if (!typingText) return;

  const phrases = [
    'Manage your document requests seamlessly.',
    'Report incidents quickly and securely.'
  ];
  const typingSpeed = 50;  // ms per character
  const deletingSpeed = 10; // ms per character when deleting
  const pauseDelay = 1000;  // pause after typing full phrase
  const pauseBetween = 300; // pause after deleting before typing next phrase

  let phraseIndex = 0;
  let charIndex = 0;
  let isDeleting = false;

  function type() {
    const currentPhrase = phrases[phraseIndex];
    if (!isDeleting) {
      typingText.textContent = currentPhrase.substring(0, charIndex + 1);
      charIndex++;
      if (charIndex === currentPhrase.length) {
        setTimeout(() => {
          isDeleting = true;
          type();
        }, pauseDelay);
      } else {
        setTimeout(type, typingSpeed);
      }
    } else {
      typingText.textContent = currentPhrase.substring(0, charIndex - 1);
      charIndex--;
      if (charIndex === 0) {
        isDeleting = false;
        phraseIndex = (phraseIndex + 1) % phrases.length;
        setTimeout(type, pauseBetween);
      } else {
        setTimeout(type, deletingSpeed);
      }
    }
  }

  type();
});
