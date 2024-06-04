const imgBox = document.querySelector('.search-img');
imgBox.addEventListener('click', imgSearchView);
const formImmagini = document.querySelector('#form-immagini');
formImmagini.addEventListener ('submit', imgSearch);


function imgSearch(event){
    event.preventDefault();
    const img_name = document.querySelector('#search1');
    const img_value = encodeURIComponent(img_name.value);
    console.log('Ricerca di ' + img_value + ' in corso...');
    fetch('search_immagini.php?q=' + img_value + '&image_type=photo').then(onResponse2).then(onJson2);
    }

function onResponse2(response){
    return response.json();
}
function onJson2(json){
    const img_div = document.querySelector('#img-display');
    img_div.innerHTML = '';
    img_div.classList.add('box-center');
    const results = json.hits;
    let num_results = results.length;
    if(num_results > 5)
      num_results = 5;
    for(let i=0; i<num_results; i++)
    {
        const img_data = results[i]
        const img_search = document.createElement('div');
        const fav = document.createElement('div');
        const img_id = img_data.id 
        img_search.classList.add('img_search');
        const tags = img_data.tags;
        const img_tag = document.createElement('div');
        img_tag.textContent = 'tags: ' + tags;
        img_tag.classList.add('img_desc');
        const img_photojson = img_data.webformatURL;
        const img_photo = document.createElement('img');
        img_photo.src = img_photojson;
        img_photo.classList.add('img_photo')
        const views = img_data.views;
        const img_views = document.createElement('div');
        img_views.classList.add('img_desc');
        img_views.textContent = 'Views: ' + views;
        const download = img_data.downloads;
        const img_download = document.createElement('div');
        img_download.classList.add('img_desc');
        img_download.textContent = 'Downloads: ' + download;
        const like = img_data.likes;
        const img_like = document.createElement('div');
        img_like.classList.add('img_desc');
        img_like.textContent = 'Likes: ' + like;
        const user = img_data.user;
        const img_user = document.createElement('div');
        img_user.classList.add('img_desc');
        img_user.textContent = 'User: ' + user;
        const saveform = document.createElement('div');
        const save = document.createElement('img');
        save.classList.add('save');
        save.value='';
        save.src = 'Img/Save.png';
        save.classList.add('save');
        saveform.appendChild(save);
        saveform.addEventListener('click', () => saveimg(fav));
        const img_name = document.querySelector('#search1');
        const img_value = encodeURIComponent(img_name.value);
        const img_city = document.createElement('div');
        img_city.textContent = 'Città: ' +img_value;
        img_city.classList.add('img_desc') 
        fav.dataset.id = img_id;
        fav.dataset.tags = tags;
        fav.dataset.views = views;
        fav.dataset.downloads = download;
        fav.dataset.likes = like;
        fav.dataset.user = user;
        fav.dataset.image = img_photojson;
        fav.dataset.name = img_value;
        img_search.appendChild(img_photo);
        img_search.appendChild(img_city);
        img_search.appendChild(img_tag);
        img_search.appendChild(img_views);
        img_search.appendChild(img_download);
        img_search.appendChild(img_like);
        img_search.appendChild(img_user);
        img_search.appendChild(saveform);
        fav.appendChild(img_search);
        img_div.appendChild(fav);
    }
    document.querySelector('#search1').value='';
}

function saveimg (fav){
    const ID = fav.dataset.id;
    const TAGS = fav.dataset.tags;
    const VIEWS = fav.dataset.views;
    const DOWNLOADS = fav.dataset.downloads;
    const LIKES = fav.dataset.likes;
    const USER = fav.dataset.user;
    const IMAGE = fav.dataset.image;
    const NAME = fav.dataset.name;
    const formData = new FormData();
    formData.append('id', ID);
    formData.append('tags', TAGS);
    formData.append('views', VIEWS);
    formData.append('downloads', DOWNLOADS);
    formData.append('likes', LIKES);
    formData.append('user', USER);
    formData.append('image', IMAGE);
    formData.append('name', NAME);
    fetch("save_img.php", {method: 'post', body: formData}).then(OnResponse, OnError);
    console.log(formData);
    event.stopPropagation();
}

function OnResponse(response) {

    console.log(response);
    return response.json().then(databaseResponse); 
  }
  
  function OnError(error) { 
    console.log("Errore");
  }
  
  function databaseResponse(json) {
    if (!json.ok) {
        OnError();
        return null;
    }
  }