//incarcare articol

const articolTitle = document.querySelector('.articolTitle');
const articolDesc = document.querySelector('.articolDesc');
const articolUser = [...document.querySelector('.articolUserText').children[0].querySelectorAll('span'), document.querySelector('.articolUser').children[0]];
const articolImg = document.querySelector('.articolImg');

var id;

function requestQuestion() {
    let form = new FormData();

    let url = new URL(location.href);
    if (!url.searchParams.has('id')) location.href = '/php/404.php';
    id = new URL(location.href).searchParams.get('id');
    
    
    form.append('id', id);
    form.append('requestQuestion', true)
    fetch('/api/questions.php', {
        method: 'POST',
        body: form
    }).then(res => {
        if (res.status == 200) res.json().then(data => {
            if (data.result === 'success') {
                articolTitle.innerText = data.title;
                articolDesc.innerText = data.description;
                articolUser[0].innerText = data.nume;
                articolUser[0].setAttribute('onclick', `location = 'profile.php?target=${data.publicToken}'`);
                articolUser[1].innerText = dateToSince(data.time);
                articolUser[2].innerText = materieLoc(data.materie);
                articolUser[3].src = "../uploads/conturi/" + data.publicToken + '.png';
                articolUser[3].setAttribute('onclick', `location = 'profile.php?target=${data.publicToken}'`);
                data.img.forEach(image => {
                    let img = document.createElement('img');
                    img.setAttribute('onclick', 'imgClick(this.src)');
                    img.classList.add('articolImg');
                    img.src = image.substring(2, image.length);
                    articolImg.appendChild(img);
                });
            } else {
                document.body.innerHTML = data.message;
            }
            console.log(data);
            requestLikes(JSON.parse(data.likes), data.publicToken);
        });
        else document.querySelector('.mainDiv').innerText = 'Error';
    });
}

function dateToSince(val) {
    let timePassed = Math.floor((new Date().getTime() - new Date(val).getTime()) / 1000);
    if (timePassed < 60) return 'cateva secunde';
    else if (timePassed < 120) return 'un minut';
    else if (timePassed < 3600) return `${Math.floor(timePassed / 60)} minute`;
    else if (timePassed < 86400) return `${Math.floor(timePassed / 3600)} ore`;
    else if (timePassed < 604800) return `${Math.floor(timePassed / 86400)} zile`;
    else if (timePassed < 2592000) return `${Math.floor(timePassed / 604800)} saptamani`;
    else if (timePassed < 31556926) return `${Math.floor(timePassed / 2592000)} luni`;
    else return `${Math.floor(timePassed / 31556926)} ani`;
} 

function materieLoc(materie) {
    switch(materie) {
        case 'bio': return 'Biologie';
        case 'chi': return 'Chimie';
        case 'ses': return 'Desen/Educatie Plastica';
        case 'eng': return 'Engleza';
        case 'spo': return 'Educatie Fizica/Sport';
        case 'fiz': return 'Fizica';
        case 'fra': return 'Franceza';
        case 'geo': return 'Geografie';
        case 'ger': return 'Germana';
        case 'inf': return 'Informatica';
        case 'ist': return 'Istorie';
        case 'ita': return 'Italiana';
        case 'log': return 'Logica';
        case 'mat': return 'Matematica';
        case 'muz': return 'Muzica/Educatie Muzicala';
        case 'rel': return 'Religie';
        case 'rom': return 'Romana';
        case 'spa': return 'Spaniola';
        case 'tic': return 'TIC';
        case 'oth': return 'Altele';
    }
}


//like & dislke

const interactionButtons = [document.querySelector('#like'), document.querySelector('#dislike')]; //butoanele de like/dislike
const diffLabel = document.getElementById('diffLabel'); //label-ul pentru diferenta dintre ele

let status = 0;  //status-ul ne spune ce a facut user-ul (a dat like/dis)
let diff = 0;
let userPublicToken;

function requestLikes(data, userToken) {
    console.log(data)
    diff = data.likes.length - data.dislikes.length;
    let z = data.likes.find(e => e === userToken) || -1;
    if (z === -1) {
        z = data.dislikes.find(e => e === userToken) || -1;
        if (z !== -1) status = -1;
    } else status = 1;
    userPublicToken = userToken;

    setStatus(status, diff)
}

function setStatus(status, diff) {
    diffLabel.innerText = diff;
    interactionButtons[0].setAttribute('class', '');
    interactionButtons[1].setAttribute('class', '');
    // console.log(status);
    if (status == 1) interactionButtons[0].setAttribute('class', 'active');
    else if (status == -1) interactionButtons[1].setAttribute('class', 'active');
}

function updateStatus(status) {
    let form = new FormData();
    form.append('sendLikes', true)
    form.append('status', status);
    form.append('user', userPublicToken);
    form.append('id', id)
    fetch('/api/questions.php', { 
        method: 'POST',
        body: form
    }).then(res => {
        //ceva cod de eroare daca nu a mers
    })
}

interactionButtons[0].addEventListener('click', () => {
    if (status == 1) {
        status = 0;
        diff--;
    } else if (status == 0) {
        status = 1;
        diff++;
    } else {
        status = 1;
        diff -= 2;
    }
    setStatus(status, diff);
    updateStatus(status);
});

interactionButtons[1].addEventListener('click', () => {
    if (status == 1) {
        status = -1;
        diff -= 2;
    } else if (status == 0) {
        status = -1;
        diff--;
    } else {
        status = 0;
        diff++;
    }
    setStatus(status, diff);
    updateStatus(status);
});

requestQuestion();