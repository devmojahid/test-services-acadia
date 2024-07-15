// controls/text.js
export function createControl(controlData, widget) {
    let controlElement = document.createElement('div');
    controlElement.classList.add('control');
    controlElement.innerHTML = `
        <label>${controlData.label}: <input type="text" class="control-text" value="${controlData.default}"></label>
    `;
    console.log('controlData', controlData);
    console.log('widget', widget);
    // Add event listener for text input changes
    controlElement.querySelector('.control-text').addEventListener('input', function (event) {
        widget.querySelector('p').innerText = event.target.value;
    });

    return controlElement;
}
