function fetchImmagini(){
    fetch('fetch_immagine.php').then(onResponse).then(onJson);
}

function onResponse(response){
    if(!response.ok) {return null};
    return response.json();
}

function onJson(json){
    if (!json.length) {noResults(); return;}
    console.log(json);
    const box = document.querySelector('#results');
    box.innerHTML = '';
    for (let i=0; i<json.length; i++){
        const container = document.createElement('div');
        container.dataset.id = json[i].content.id; 
        container.classList.add('container');
        const dati_img = document.createElement('div');
        const centerbox = document.createElement('div');
        centerbox.classList.add('center');
        const img = document.createElement('img');
        img.src = json[i].content.image;
        img.classList.add('img_photo');
        const tags = document.createElement('div');
        tags.textContent = 'Tags: ' + json[i].content.tags;
        tags.classList.add('img_desc');
        const downloads = document.createElement('div');
        downloads.textContent = 'Downloads: ' + json[i].content.downloads;
        downloads.classList.add('img_desc');
        const likes = document.createElement('div');
        likes.textContent = 'Likes: ' + json[i].content.likes;
        likes.classList.add('img_desc');
        const user = document.createElement('div');
        user.textContent = 'User: ' + json[i].content.user;
        user.classList.add('img_desc');
        const views = document.createElement('div');
        views.textContent = 'Views: ' + json[i].content.views;
        views.classList.add('img_desc');
        const name = document.createElement('div');
        name.textContent = 'Città: ' + json[i].content.name;
        name.classList.add('img_desc');
        const remove = document.createElement('div');
        remove.textContent = 'Rimuovi';
        remove.classList.add('remove');
        remove.addEventListener('click', () => removeImg(container)); 
        remove.addEventListener('click', rimuovielemento);      
        dati_img.appendChild(img);
        dati_img.appendChild(name);
        dati_img.appendChild(tags);
        dati_img.appendChild(views);
        dati_img.appendChild(downloads);
        dati_img.appendChild(likes);
        dati_img.appendChild(user);
        centerbox.appendChild(remove);
        container.appendChild(dati_img);
        container.appendChild(centerbox);
        box.appendChild(container);
    }
}

function removeImg(container){
    const ID = container.dataset.id;
    const formData = new FormData();
    formData.append('id', ID);
    fetch('remove_image.php', {method: 'post', body: formData}).then(onResponse2, onError);
}

function onResponse2(response){
    return response.json().then(databaseResponse);
}

function onError(error) { 
    console.log("Errore");
  }

function databaseResponse(json) {
    if (!json.ok) {
        onError();
        return null;
    }
}

function rimuovielemento(event){
    const elem = document.querySelector('.container');
    elem.parentNode.removeChild(elem);

}
function noResults() {
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Non sono presenti elementi nei tuoi preferiti";
    container.appendChild(nores);
  }

fetchImmagini();