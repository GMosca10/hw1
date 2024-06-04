const formVoli = document.querySelector('#form-voli');
formVoli.addEventListener ('submit', flightSearch);

function flightSearch(event){
    event.preventDefault();
    const origin_name = document.querySelector('#origin');
    const origin_value = encodeURIComponent(origin_name.value);
    const destination_name = document.querySelector('#destination');
    const destination_value = encodeURIComponent(destination_name.value);
    const departureDate = document.querySelector('#departure-date');
    const departureDate_value = encodeURIComponent(departureDate.value);
    const adults = document.querySelector('#adults');
    const adults_value = encodeURIComponent(adults.value);
    console.log('Ricerca del volo in corso...');
    const parametri = 'originLocationCode=' + origin_value + '&destinationLocationCode=' + destination_value + '&departureDate=' + departureDate_value + '&adults=' + adults_value + '&max=10';
    fetch('search_voli.php?' + parametri).then(onResponse3).then(onJson3);
    }

function onResponse3(response){
    return response.json();
}
function onJson3(json){
    const flight_info = document.querySelector('#voli-display');
    flight_info.innerHTML = '';
    const results2 = json.data;
    if (results2 === undefined){
        const error = document.createElement('div');
        error.textContent = 'Non esistono voli per questa ricerca, riprova con altri dati';
        error.classList.add('error');
        flight_info.appendChild(error);
        const origin = document.querySelector('#origin');
        const orig = encodeURIComponent(origin.value);
        const destinsation = document.querySelector('#destination');
        const dest = encodeURIComponent(destinsation.value);
        const departure = document.querySelector('#departure-date');
        const dep = encodeURIComponent(departure.value);
        const adults = document.querySelector('#adults');
        const pass = encodeURIComponent(adults.value);
        const title = document.createElement('div');
        const dato1 = document.createElement('div');
        const dato2 = document.createElement('div');
        const dato3 = document.createElement('div');
        const dato4 = document.createElement('div');
        title.textContent = 'Questi sono i parametri della tua ricerca:';
        dato1.textContent = 'Aereoporto di partenza: ' + orig;
        dato2.textContent = 'Aereoporto di arrivo: ' + dest;
        dato3.textContent = 'Data di partenza: ' + dep;
        dato4.textContent = 'Numero  di passeggeri: ' + pass;
        title.classList.add('title');
        dato1.classList.add('dato');
        dato2.classList.add('dato');
        dato3.classList.add('dato');
        dato4.classList.add('dato');
        flight_info.appendChild(title);
        flight_info.appendChild(dato1);
        flight_info.appendChild(dato2);
        flight_info.appendChild(dato3);
        flight_info.appendChild(dato4);
    } else{
    let num_results2 = results2.length;
    const origin = document.querySelector('#origin');
    const orig = encodeURIComponent(origin.value);
    const destinsation = document.querySelector('#destination');
    const dest = encodeURIComponent(destinsation.value);
    const departure = document.querySelector('#departure-date');
    const dep = encodeURIComponent(departure.value);
    const adults = document.querySelector('#adults');
    const pass = encodeURIComponent(adults.value);
    const title = document.createElement('div');
    const dato1= document.createElement('div');
    const dato2= document.createElement('div');
    const dato3= document.createElement('div');
    const dato4 = document.createElement('div');
    title.textContent = 'Eccoti i risultati per la seguente ricerca:';
    dato1.textContent = 'Aereoporto di partenza: ' + orig;
    dato2.textContent = 'Aereoporto di arrivo: ' + dest;
    dato3.textContent = "Data di partenza: " + dep;
    dato4.textContent = 'Numero  di passeggeri: ' + pass;
    title.classList.add('title');
    dato1.classList.add('dato');
    dato2.classList.add('dato');
    dato3.classList.add('dato');
    dato4.classList.add('dato');
    flight_info.appendChild(title);
    flight_info.appendChild(dato1);
    flight_info.appendChild(dato2);
    flight_info.appendChild(dato3);
    flight_info.appendChild(dato4);
    for(let i=0; i<num_results2; i++){
        const fly_data = results2[i];
        const fly_box = document.createElement('div');
        const price_currency = fly_data.price.currency;
        const price = fly_data.price.total;
        const prezzo = document.createElement('div');
        prezzo.textContent = 'Prezzo: ' + price + ' ' + price_currency;
        const seats = fly_data.numberOfBookableSeats;
        const seats_number = document.createElement('div');
        seats_number.textContent = 'Numero posti disponibili: ' + seats;
        const numero = document.createElement('div');
        numero.textContent = '- Volo numero: ' + i;
        const source = fly_data.source;
        const fonte = document.createElement('div');
        fonte.textContent = 'Fonte: ' + source;
        numero.classList.add('txt-num-voli');
        seats_number.classList.add('voli-text');
        prezzo.classList.add('voli-text');
        fonte.classList.add('voli-text');
        fly_box.appendChild(numero);
        fly_box.appendChild(seats_number);
        fly_box.appendChild(prezzo);
        fly_box.appendChild(fonte);
        flight_info.appendChild(fly_box);
    }
    document.querySelector('#origin').value='';
    document.querySelector('#destination').value='';
    document.querySelector('#departure-date').value='';
    document.querySelector('#adults').value='';
    }
}