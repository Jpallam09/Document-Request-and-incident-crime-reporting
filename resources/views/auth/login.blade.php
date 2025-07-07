<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Login</title>
   @vite('resources/css/authCss/login.css')
</head>

<body>
  <nav class="navbar" role="navigation" aria-label="Site main navigation">
    <div class="nav-left">
      <a href="{{ route('index') }}" aria-label="Go to home page">Home</a>
    </div>
    <div class="nav-right">
      <a href="{{ route('register') }}" aria-label="Go to registration page">Register</a>
    </div>
  </nav>

  <!-- Login form -->
  <main>
    <section class="login-card" role="region" aria-labelledby="login-heading">
      <h2 id="login-heading">Log In to Your Account</h2>

      <form action="/user/userMainDashboard" method="POST" novalidate>
      @csrf
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" 
        autocomplete="email" required aria-describedby="email-desc" />
        <small id="email-desc">Please enter a valid email.</small>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password"  
        autocomplete="current-password" required minlength="8" aria-describedby="password-desc" />  
        <small id="password-desc">Password must be at least 8 characters.</small>

        <button type="submit" aria-label="Log in user">Log In</button>
      </form>
    </section>
  </main>

  <script>
    const form = document.querySelector('form');
    const emailInput = form.email;
    const passwordInput = form.password;

    const emailDesc = document.getElementById('email-desc');
    const passwordDesc = document.getElementById('password-desc');

    const validateEmail = () => {
      const valid = emailInput.validity.valid;
      emailDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    const validatePassword = () => {
      const valid = passwordInput.validity.valid;
      passwordDesc.style.display = valid ? 'none' : 'block';
      return valid;
    };

    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validatePassword);

    form.addEventListener('submit', e => {
      e.preventDefault();
      const validEmail = validateEmail();
      const validPassword = validatePassword();

      if (validEmail && validPassword) {
        alert('Login successful!');
        form.reset();
        emailDesc.style.display = 'none';
        passwordDesc.style.display = 'none';
      } else {
        if (!validEmail) emailInput.focus();
        else if (!validPassword) passwordInput.focus();
      }
    });
  </script>
</body>
</html>

