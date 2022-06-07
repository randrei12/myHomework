//sistem pentru update automat al scrisului in textarea

const titleInput = document.getElementsByName('titleInput')[0];
const textInput = document.getElementsByTagName('textarea')[0];
const textPreview = document.getElementById('textPreview');
const warning = document.getElementsByClassName('warning');

titleInput.addEventListener('keydown', () => {
    warning[0].innerText = '';
});

textInput.addEventListener('keyup', () => {
    warning[1].innerText = '';
    var text = textInput.value;
    text = text.split('**');
    var newText = '';
    for(let i = 0; i < text.length; ++i) {
        if (i % 2 == 1) {
            newText = newText + "<span style='font-weight: bold'>" + text[i] + "</span>"
        } else {
            newText = newText + text[i]
        }
    }
    if (text.length % 2 == 0) {
        newText = newText.substring(0, newText.lastIndexOf("<span style='font-weight: bold'>")) + newText.substring(newText.lastIndexOf("<span style='font-weight: bold'>") + 32, newText.length)
        newText = newText.substring(0, newText.lastIndexOf("</span>")) + newText.substring(newText.lastIndexOf("</span>") + 7, newText.length)
    }
    // trecem la urmatorul

    text = newText.split('//')
    newText = '';

    for(let i = 0; i < text.length; ++i) {
        if (i % 2 == 1) {
            newText = newText + "<span style='font-style: italic'>" + text[i] + "</span>"
        } else {
            newText = newText + text[i]
        }
    }
    if (text.length % 2 == 0) {
        newText = newText.substring(0, newText.lastIndexOf("<span style='font-style: italic'>")) + newText.substring(newText.lastIndexOf("<span style='font-style: italic'>") + 33, newText.length)
        newText = newText.substring(0, newText.lastIndexOf("</span>")) + newText.substring(newText.lastIndexOf("</span>") + 7, newText.length)
    }

    // trecem la urmatorul

    text = newText.split('##')
    newText = '';

    for(let i = 0; i < text.length; ++i) {
        if (i % 2 == 1) {
            newText = newText + "<span style='text-decoration: line-through'>" + text[i] + "</span>"
        } else {
            newText = newText + text[i]
        }
    }
    if (text.length % 2 == 0) {
        newText = newText.substring(0, newText.lastIndexOf("<span style='text-decoration: line-through'>")) + newText.substring(newText.lastIndexOf("<span style='text-decoration: line-through'>") + 44, newText.length)
        newText = newText.substring(0, newText.lastIndexOf("</span>")) + newText.substring(newText.lastIndexOf("</span>") + 7, newText.length)
    }

    text = newText.replace(/\n/g, "<br>")
    textPreview.innerHTML = text;
});

//sistem de upload

const imageUpload = document.getElementById('imgInput');
var arrayImagini = [];

imageUpload.addEventListener('change', (event) => {
    for (let i = 0; i < event.target.files.length; ++i) {
        var imageDiv = document.createElement('div');
        imageDiv.classList.add('image');
        document.getElementById('imagesDiv').appendChild(imageDiv);
    
        var Uimage = document.createElement('img');
        var currentImage = event.target.files[i];
        let reader = new FileReader();
        reader.onloadend = function() {
            var base64 = reader.result.replace('data:image/png;base64,', '')
            arrayImagini.push(base64);
        }
        reader.readAsDataURL(currentImage);
        Uimage.src = URL.createObjectURL(currentImage);
        Uimage.setAttribute('onclick', 'imgClick(this.src)')
        imageDiv.insertBefore(Uimage, imageDiv.childNodes[1]);
        
        var Bimage = document.createElement('button');
        Bimage.setAttribute('type', 'button')
        Bimage.setAttribute('name', 'closeButtons')
        Bimage.setAttribute('onclick', 'deleteImage(this)')
        Bimage.innerHTML = '<i class="fas fa-times""></i>'
        imageDiv.appendChild(Bimage);
    }
});

const submit = document.getElementById('submitButton');

submit.addEventListener('click', () => {
    var title = titleInput.value;
    var desc = textInput.value;
    var mat = document.getElementsByName('materii')[0].value;

    if (title == '' || desc == '') {
        if (title == '') {
            warning[0].innerText = loc.warning1;
        }
        if (desc == '') {
            warning[1].innerText = loc.warning2;
        }
        return;
    }

    $.ajax({
        type: "POST", 
        url: 'addIntrebare', 
        data: { imgArray: JSON.stringify(arrayImagini), titluEdit: title, descEdit: desc, materii: mat}, 
        dataType: 'text',
        success: function(data) {
            window.location.reload()
        }
    });
});

const imagesDiv = document.getElementById('imagesDiv');
function deleteImage(target) {
    var index = Array.from(imagesDiv.children).indexOf(target.parentElement) - 1;  // -1 pentru ca si butonul (imaginea) de upload se ia in considerare
    arrayImagini.splice(index, 1)
    target.parentElement.remove();
}