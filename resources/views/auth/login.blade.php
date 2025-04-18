<x-guest-layout>
    <div class="auth-card">
        <div class="logo-container">
            <div class="logo">
                <span>Scanfyi</span>
            </div>
            <a href="{{ route('register') }}" class="sign-up-button">sign up.</a>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-wrapper">
                <label for="email" class="input-label">Username</label>
                <input id="email" class="text-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div class="input-wrapper">
                <label for="password" class="input-label">Password</label>
                <input id="password" class="text-input" type="password" name="password" required autocomplete="current-password" />
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        forgot password!
                    </a>
                @endif
            </div>

            <button type="submit" class="login-button">
                Login to scanfyi.
            </button>
        </form>

        <!-- <button class="google-button">
            <svg class="google-icon" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
            </svg>
            Login with Google
        </button> -->
    </div>
</x-guest-layout>
<style>

    :root {
  --primary-color: #FF7730; /* Orange color from Scanfyi logo */
  --text-color: #333333;
  --background-color: transparent;
  --input-border-color: #FF7730;
  --input-focus-color: rgba(255, 119, 48, 0.2);
  --blur-circle-color: rgba(255, 119, 48, 0.15);
  --error-color: #EF4444;
  --success-color: #10B981;
}

body {
  font-family: 'Figtree', sans-serif;
  background: linear-gradient(135deg, #FFFFFF, #FFF5F0);
  min-height: 100vh;
  margin: 0;
  position: relative;
  overflow-x: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Blur circle at corner */
body::before {
  content: '';
  position: fixed;
  top: -100px;
  right: -150px;
  width: 400px;
  height: 400px;
  border-radius: 50%;
  background: var(--blur-circle-color);
  filter: blur(30px);
  z-index: -1;
}

body::after {
  content: '';
  position: fixed;
  bottom: -100px;
  left: -100px;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background: var(--blur-circle-color);
  filter: blur(80px);
  z-index: -1;
  opacity: 0.7;
}

.min-h-screen {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* Auth card removal and adjustment */
.auth-card {
  max-width: 500px;
  width: 90vw;
  margin: 0 auto;
  padding: 2rem;
  background-color: transparent;
  border-radius: 0.5rem;
  box-shadow: none;
}

/* Logo styles */
.logo-container {
  margin-bottom: 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--text-color);
}

.logo span:first-child {
  color: var(--primary-color);
}

.sign-up-button {
  padding: 0.5rem 1.25rem;
  border: 1px solid var(--primary-color);
  border-radius: 2rem;
  color: var(--primary-color);
  text-decoration: none;
  font-size: 0.875rem;
  transition: all 0.2s ease;
}

.sign-up-button:hover {
  background-color: var(--primary-color);
  color: white;
}

/* Form elements */
.input-wrapper {
  margin-bottom: 1rem;
}

.input-label {
  display: block;
  margin-bottom: 0.5rem;
  color: var(--text-color);
  font-size: 0.875rem;
}

.text-input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #E5E7EB;
  border-radius: 0.375rem;
  font-size: 1rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.text-input:focus {
  outline: none;
  border-color: var(--input-border-color);
  box-shadow: 0 0 0 3px var(--input-focus-color);
}

.forgot-password {
  display: block;
  text-align: right;
  color: var(--text-color);
  font-size: 0.75rem;
  text-decoration: none;
  margin-top: 0.25rem;
}

.forgot-password:hover {
  text-decoration: underline;
  color: var(--primary-color);
}

/* Buttons */
.login-button {
  width: 100%;
  padding: 0.75rem;
  background-color: var(--primary-color);
  color: white;
  border: none;
  border-radius: 2rem;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
  margin-top: 1.5rem;
  text-align: center;
}

.login-button:hover {
  background-color: #E66A2C; /* Slightly darker orange on hover */
}

.google-button {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem;
  background-color: white;
  color: var(--text-color);
  border: 1px solid #E5E7EB;
  border-radius: 2rem;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s ease;
  margin-top: 1rem;
}

.google-button:hover {
  background-color: #F9FAFB;
}

.google-icon {
  margin-right: 0.5rem;
}

/* Error and success messages */
.validation-error {
  color: var(--error-color);
  font-size: 0.875rem;
  margin-top: 0.25rem;
}

.success-message {
  color: var(--success-color);
  font-size: 0.875rem;
  margin-bottom: 1rem;
}

@media (max-width: 640px) {
  .auth-card {
    padding: 1.5rem;
  }
}
</style>