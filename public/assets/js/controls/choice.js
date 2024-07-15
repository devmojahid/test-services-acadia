// ChooseControl.js
export function createControl(controlData, widget) {
    let controlElement = document.createElement('div');
    controlElement.classList.add('control', 'file-upload-control');

    let inputElement = document.createElement('input');
    inputElement.setAttribute('type', 'file');
    inputElement.setAttribute('name', controlData.name);
    // inputElement.setAttribute('accept', controlData.acceptedFormats.join(','));
    inputElement.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            // Handle file upload logic
            console.log('Uploaded file:', file);
        }
    });

    let labelElement = document.createElement('label');
    labelElement.innerText = controlData.label;

    controlElement.appendChild(labelElement);
    controlElement.appendChild(inputElement);

    return controlElement;
}
