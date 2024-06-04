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

document.querySelector('.visible').addEventListener('click', showpassword);