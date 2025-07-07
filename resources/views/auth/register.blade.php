<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Registration</title>
   @vite('resources/css/authCss/register.css')
</head>
<body>
  <nav class="navbar" role="navigation" aria-label="Site main navigation">
    <div class="nav-left">
      <a href="{{ route('index') }}" aria-label="Go to home page">Home</a>
    </div>
    <div class="nav-right">
      <a href="{{ route('login') }}" aria-label="Go to login page">Log In</a>
    </div>
  </nav>

  <main>
    <section class="registration-card" role="region" aria-labelledby="reg-heading">
      <h2 id="reg-heading">Create Your Account</h2>
      <form action="{{ route('register') }}" method="POST" novalidate>
        <label for="userName">Username</label>
        <input type="text" id="username" name="userName" placeholder="Choose a username" autocomplete="username" required minlength="3" 
        maxlength="20" pattern="[\w\d_-]+" title="3-20 characters: letters, numbers, underscore or dash" aria-describedby="username-desc" />
        <small id="username-desc">Invalid username format!</small>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email" 
        required aria-describedby="email-desc" />
        <small id="email-desc">Please enter a valid email.</small>

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="09xx xxxx xxx" autocomplete="tel" 
        pattern="^\+?\d{1,3}?[- .]?\(?\d{1,4}?\)?[- .]?\d{1,4}[- .]?\d{1,9}$" aria-describedby="phone-desc" />
        <small id="phone-desc">Enter a valid phone number.</small>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" autocomplete="new-password" 
        required minlength="8" aria-describedby="password-desc" />
        <small id="password-desc">Password must be at least 8 characters.</small>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirmPassword" placeholder="Re-enter your password" 
        autocomplete="new-password" required aria-describedby="confirm-password-desc" />
        <small id="confirm-password-desc">Passwords do not match.</small>

        <button type="submit" aria-label="Register new user">Register</button>
      </form>
    </section>
  </main>

  <script>
    const form = document.querySelector('form');
    const usernameInput = form.username;
    const emailInput = form.email;
    const phoneInput = form.phone;
    const passwordInput = form.password;
    const confirmPasswordInput = form['confirm-password'];

    const usernameDesc = document.getElementById('username-desc');
    const emailDesc = document.getElementById('email-desc');
    const phoneDesc = document.getElementById('phone-desc');
    const passwordDesc = document.getElementById('password-desc');
    const confirmPasswordDesc = document.getElementById('confirm-password-desc');

    const validateUsername = () => {
      const valid = usernameInput.validity.valid;
      usernameDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    const validateEmail = () => {
      const valid = emailInput.validity.valid;
      emailDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    const validatePhone = () => {
      if (!phoneInput.value) {
        phoneDesc.style.display = 'none'; // optional field
        return true;
      }
      const valid = phoneInput.validity.valid;
      phoneDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    const validatePassword = () => {
      const valid = passwordInput.validity.valid;
      passwordDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    const validateConfirmPassword = () => {
      const match = confirmPasswordInput.value === passwordInput.value && confirmPasswordInput.value.length > 0;
      confirmPasswordDesc.style.display = match ? 'none' : 'block';
      return match;
    };

    usernameInput.addEventListener('input', validateUsername);
    emailInput.addEventListener('input', validateEmail);
    phoneInput.addEventListener('input', validatePhone);
    passwordInput.addEventListener('input', () => {
      validatePassword();
      validateConfirmPassword();
    });
    confirmPasswordInput.addEventListener('input', validateConfirmPassword);

    form.addEventListener('submit', e => {
      e.preventDefault();
      const validUsername = validateUsername();
      const validEmail = validateEmail();
      const validPhone = validatePhone();
      const validPassword = validatePassword();
      const validConfirm = validateConfirmPassword();

      if (validUsername && validEmail && validPhone && validPassword && validConfirm) {
        alert('Registration successful!');
        form.reset();
        usernameDesc.style.display = 'none';
        emailDesc.style.display = 'none';
        phoneDesc.style.display = 'none';
        passwordDesc.style.display = 'none';
        confirmPasswordDesc.style.display = 'none';
      } else {
        if (!validUsername) usernameInput.focus();
        else if (!validEmail) emailInput.focus();
        else if (!validPhone) phoneInput.focus();
        else if (!validPassword) passwordInput.focus();
        else if (!validConfirm) confirmPasswordInput.focus();
      }
    });
  </script>
</body>
</html>

