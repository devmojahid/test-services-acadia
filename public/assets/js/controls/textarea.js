// TextareaControl.js
export function createControl(controlData, widget) {
    let controlElement = document.createElement('div');
    controlElement.classList.add('control');
    controlElement.innerHTML = `
        <label>${controlData.label}: <textarea class="control-textarea">${controlData.default}</textarea></label>
    `;

    controlElement.querySelector('.control-textarea').addEventListener('input', function (event) {
        // Handle textarea input change
        widget.querySelector('#description').innerText = event.target.value;
    });


    return controlElement;
}