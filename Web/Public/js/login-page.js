const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const signUpForm = document.querySelector('.form-container.sign-up');
const signInForm = document.querySelector('.form-container.sign-in');

registerBtn.addEventListener('click', () => {
  signInForm.classList.add('hidden');
  signUpForm.classList.remove('hidden');
  container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
  signUpForm.classList.add('hidden');
  signInForm.classList.remove('hidden');
  container.classList.remove('active');
});
