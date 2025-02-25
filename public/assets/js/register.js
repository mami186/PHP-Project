const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');


signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

function showLoginForm() {
	document.getElementById("login-form").style.display = "block";
	document.getElementById("signup-form").style.display = "none";
}

function showSignupForm() {
	document.getElementById("login-form").style.display = "none";
	document.getElementById("signup-form").style.display = "block";
}