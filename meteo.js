const formMeteo = document.querySelector('#form-meteo');
formMeteo.addEventListener('submit', weatherSearch);



function weatherSearch(event){
    event.preventDefault();
    const city_input = document.querySelector('#city');
    const city_value = encodeURIComponent(city_input.value);
    console.log('Eseguo Ricerca per: ' + city_value);
    fetch('search_meteo.php?q=' + city_value).then(onResponse).then(onJson);
}
function onResponse(response){
    return response.json();
}
function onJson(json){
    const info = document.querySelector('#weather-info')
    info.innerHTML = '';
    const sezione = document.createElement('div');
    const name = json.location.name;
    const cityName = document.createElement('div');
    cityName.textContent = 'Città: ' + name;
    const region = json.location.region;
    const regionName = document.createElement('div');
    regionName.textContent = 'Regione: ' + region;
    const country = json.location.country;
    const countryName = document.createElement('div');
    countryName.textContent = 'Paese: ' + country;
    const time = json.current.last_updated;
    const showTime = document.createElement('div');
    showTime.textContent = 'Ultimo Aggiornamento: ' + time + ' locali';
    const temp = json.current.temp_c;
    const tempValue = document.createElement('div');
    tempValue.textContent = 'Temperatura: ' + temp + '°C';
    const condition = json.current.condition.text;
    const conditionText = document.createElement('div');
    conditionText.textContent = 'Condizione: ' + condition;
    const icon = json.current.condition.icon;
    const conditionIcon = document.createElement('img');
    conditionIcon.src = 'http:' + icon;
    cityName.classList.add('info-meteo');
    regionName.classList.add('info-meteo');
    countryName.classList.add('info-meteo');
    showTime.classList.add('info-meteo');
    tempValue.classList.add('info-meteo');
    conditionText.classList.add('info-meteo');
    conditionIcon.classList.add('meteo-icon');
    sezione.appendChild(cityName);
    sezione.appendChild(regionName);
    sezione.appendChild(countryName);
    sezione.appendChild(showTime);
    sezione.appendChild(tempValue);
    sezione.appendChild(conditionText);
    sezione.appendChild(conditionIcon);
    info.appendChild(sezione);
    document.querySelector('#city').value='';
}