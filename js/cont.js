function register() {
    document.querySelector('.registerDiv').removeAttribute('style', 'display:none');
    document.querySelector('.loginDiv').setAttribute('style', 'display:none');
}

function login() {
    document.querySelector('.loginDiv').removeAttribute('style', 'display:none');
    document.querySelector('.registerDiv').setAttribute('style', 'display:none');
}

var accountDivs = [document.querySelector('.loginDiv'), document.querySelector('.registerDiv')];
const ValidatorPar = [...document.querySelectorAll('.ValidatorPar')];

function throwError(error, index, element = false) {
    if (element != false) element.style.borderBottom = 'solid red 2px';
    ValidatorPar[index].removeAttribute('style');
    ValidatorPar[index].innerText = error;
}

function removeErrors(elements) {
    elements.forEach(element => {
        if (element.hasAttribute('style')) element.removeAttribute('style');
    })
}

accountDivs.forEach((div, index) => {
    let inputs = [...div.querySelectorAll('input')];
    div.querySelector('.submit').addEventListener('click', e => {
        e.preventDefault();
        // console.log(inputs)
        removeErrors(inputs);
        if (index === 0) {
            //conectare
            let email = inputs[0].value;
            let password = inputs[1].value;
            if (email == '') {
                throwError('Sectiunea EMAIL trebuie completata', index, inputs[0]);
                return;
            } else if (!email.includes('@') || !email.includes('.') || email.length < 5) {
                throwError('Email-ul nu este corect', index, inputs[0]);
                return;
            }
            let form = new FormData();
            form.append('login', JSON.stringify({email: email, password: password}));
            fetch('', {
                method: 'POST',
                body: form
            }).then(response => {
                response.json().then(data => {
                    if (data.status == 'error') throwError(data.message, index, inputs[1]);
                    else location.href = '/index.php';
                })
            });
        } else {
            //creare cont
            let nume = inputs[0].value;
            let email = inputs[1].value;
            let password = inputs[2].value;
            let repPass = inputs[3].value;
            if (email == '') {
                throwError('Sectiunea EMAIL trebuie completata', index, inputs[1]);
                return;
            } else if (!email.includes('@') || !email.includes('.') || email.length < 5) {
                throwError('Email-ul nu este corect', index, inputs[1]);
                return;
            }

            
        }
    })
})

