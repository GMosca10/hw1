function changeAdv(event){
    const img = document.querySelector('#img-low');
    img.src = 'Img/adv2.jpg';
    const title = document.querySelector('#txt-low-bold');
    title.textContent = 'Prenota il soggiorno dei tuoi sogni con l’app Hilton Honors';
    const txt = document.querySelector('#txt-low-thin');
    txt.textContent = 'Scopri i modi in cui l’app Hilton Honors migliorerà il tuo soggiorno. Prenota hotel, esplora destinazioni, guadagna premi e molto altro ancora.';
    const button = document.querySelector('#button-low');
    button.textContent = 'Scarica gratuitamente'
}
function returnAdv(event){
    const img = document.querySelector('#img-low');
    img.src = 'Img/img2.jpg';
    const title = document.querySelector('#txt-low-bold');
    title.textContent = 'Migliora il tuo modo di soggiornare (gratuitamente!)';
    const txt = document.querySelector('#txt-low-thin');
    txt.textContent = 'I soci Hilton Honors ricevono più valore dai soggiorni con tariffe esclusive per i soci, garanzia del prezzo più basso e vantaggi come il WiFi gratuito. Inoltre, ricevi punti per ogni soggiorno che puoi utilizzare per notti gratuite in oltre 7.000 hotel in tutto il mondo o riscattali con i nostri partner esclusivi.';
    const button = document.querySelector('#button-low');
    button.textContent = 'Iscriviti gratuitamente'
}
function returnToTop(event){
    document.body.scrollIntoView({
        behavior: 'smooth'
    });
}
function languageMenu(event){
    const menu = document.querySelector('#menu');
    if (menu.style.display === 'flex') {
        menu.style.display = 'none';
        const img2 = document.querySelector('#icon-sel');
        img2.src = 'Img/Espandi.png';
        img2.classList.remove('adjust');
    } else {
        menu.style.display = 'flex';
        const img1 = document.querySelector('#icon-sel');
        img1.src = 'Img/Comprimi2.png';
        img1.classList.add('adjust');   
    }
}
function consoleInfo(event){
    console.log(info.dataset.info);
    info.removeEventListener('click', consoleInfo);
}
function addElement(event){
    const container = event.currentTarget;
    const newDiv = document.createElement('div');
    const newText = document.createTextNode('Per ulteriori informazioni contattaci');
    container.appendChild(newDiv);
    newDiv.appendChild(newText); 
    container.removeEventListener('click', addElement);
}
function imgSearchView(event){
    const box2 = document.querySelector('.img-search');
    if(box2.style.display === 'flex'){
        box2.style.display = 'none';
    } else {
        box2.style.display = 'flex';
    }
}

const button = document.querySelector('#txt-mid-low2');
button.addEventListener('click', changeAdv);
const button2 = document.querySelector('.txt-mid-low');
button2.addEventListener('click', returnAdv);
const buttonToTop = document.querySelector('.box-1');
buttonToTop.addEventListener('click', returnToTop);
const languageButton = document.querySelector('.lingua');
languageButton.addEventListener('click', languageMenu);
const languageIcon = document.querySelector('#icon-sel');
languageIcon.addEventListener('click', languageMenu);
const info = document.querySelector('.number');
info.addEventListener('click', consoleInfo);
const dynamicElement = document.querySelector('.number');
dynamicElement.addEventListener('click', addElement);


