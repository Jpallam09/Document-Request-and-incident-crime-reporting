<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Registration</title>
   @vite('resources/css/authCss/register.css')
   @vite('resources/js/authJs/register.js')
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
      <form action="{{ route('register.post') }}" method="POST" novalidate>
        @csrf
        <label for="userName">Username</label>
        <input type="text" id="username" name="user_name" placeholder="Choose a username" autocomplete="username" required minlength="3"
        maxlength="20" pattern="[\w\d_-]+" title="3-20 characters: letters, numbers, underscore or dash" aria-describedby="username-desc" />
        <small id="username-desc">Invalid username format!</small>

        <label for="userName">First name</label>
        <input type="text" id="username" name="first_name" placeholder="Enter your First name" autocomplete="firstname" required minlength="3"
        maxlength="20" pattern="[\w\d_-]+" title="3-20 characters: letters, numbers, underscore or dash" aria-describedby="firstname-desc" />
        <small id="first-desc">Invalid First name format!</small>

        <label for="userName">Last name</label>
        <input type="text" id="username" name="last_name" placeholder="Enter your Last name" autocomplete="lastname" required minlength="3"
        maxlength="20" pattern="[\w\d_-]+" title="3-20 characters: letters, numbers, underscore or dash" aria-describedby="lastname-desc" />
        <small id="lastname-desc">Invalid Last name format!</small>

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
        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Re-enter your password"
        autocomplete="new-password" required aria-describedby="confirm-password-desc" />
        <small id="confirm-password-desc">Passwords do not match.</small>

        <button type="submit" aria-label="Register new user">Register</button>
      </form>
    </section>
  </main>
</body>
</html>
