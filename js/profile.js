const buttons = document.getElementsByName('intRasp');

buttons.forEach((button, index) => {
    button.addEventListener('click', () => {
        buttons[index].setAttribute('class', 'active');
        buttons[buttons.length - (index + 1)].setAttribute('class', '');
        switch (index) {
            case 0:
                var ajaxData = 'intrebari';
                break;
            default:
                var ajaxData = 'raspunsuri';
                break;
        }
        $.ajax({
            type: "POST", 
            url: 'profile', 
            data: {dat: ajaxData}, 
            dataType: 'text',
            success: function(data) {
                console.log(data)
                // window.location.reload();
            }
        });
    })
})

