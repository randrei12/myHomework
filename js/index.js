var buttonsArray = document.getElementsByClassName('materiiButton');
const url = new URL(location);

for (let i = 0; i < buttonsArray.length; i++) {
    buttonsArray[i].addEventListener ('click', () => {
        if (url.searchParams.get('mat') == null) 
            url.searchParams.append('mat', buttonsArray[i].value);
        else
            url.searchParams.set('mat', buttonsArray[i].value);
        location = url;
    })
}