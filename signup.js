function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.nome] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.cognome] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkbirthdate(event){
    const input = event.currentTarget;

    if (formStatus[input.data_nascita] = input.value.length > 0){
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function jsonCheckUsername(json) {
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
    }
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore.";
        input.parentNode.classList.add('errorj');
        formStatus.username = false;

    } else {
        fetch("username_check.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
    }    
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email span').textContent = "E-mail non valida";
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;

    } else {
        fetch("email_check.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    if (formStatus.password = passwordInput.value.length >= 8) {
        document.querySelector('.password').classList.remove('errorj');
    } else {
        document.querySelector('.password').classList.add('errorj');
    }

}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confpass input');
    if (formStatus.confpass = confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confpass').classList.remove('errorj');
    } else {
        document.querySelector('.confpass').classList.add('errorj');
    }
}


function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus[checkbox.name] = checkbox.checked;
    console.log(formStatus);
}



const formStatus = {'upload': true};
document.querySelector('.nome input').addEventListener('blur', checkName);
document.querySelector('.cognome input').addEventListener('blur', checkSurname);
document.querySelector('.data_nascita input').addEventListener('blur', checkbirthdate);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confpass input').addEventListener('blur', checkConfirmPassword);
document.querySelector('form').addEventListener('submit', checkSignup);

function showpassword(event){
    const pass = document.querySelector('.input-p');
    if(pass.type === 'password'){
        pass.type = 'text';
        const img = document.querySelector('.visible');
        img.src = 'Img/Invisible.png';
    } else{
        pass.type = 'password';
        const img = document.querySelector('.visible');
        img.src = 'Img/Visible.png';
    }
}

function showconfpass(event){
    const cpass = document.querySelector('.input-cp');
    if (cpass.type === 'password'){
        cpass.type = 'text';
        const img = document.querySelector('.visible2');
        img.src = 'Img/Invisible.png';
    } else{
        cpass.type = 'password';
        const img = document.querySelector('.visible2');
        img.src = 'Img/Visible.png';
    }
}

document.querySelector('.visible').addEventListener('click', showpassword);
document.querySelector('.visible2').addEventListener('click', showconfpass);
