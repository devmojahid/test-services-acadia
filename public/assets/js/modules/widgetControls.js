import { StateManager } from './stateManager.js';
import { uploadImage } from './imageUploader.js';
import { displayError } from './notificationHandler.js';
const stateManager = new StateManager();


// function handleImageUpload(input, widget, controlForm) {
//     const file = input.files[0];
//     uploadImage(file)
//         .then(data => {
//             if (data.error) {
//                 displayError(data.error);
//             } else {
//                 document.querySelector(`#${input.id}-preview`).src = data.imageUrl;
//                 document.querySelector(`#${input.id}`).value = data.imageUrl;
//                 updateWidgetContent(widget, controlForm);
//                 addToUndoStack();
//             }
//         })
//         .catch(error => displayError('An error occurred while uploading the image.', error));
// }

function handleImageUpload(input, widget, controlForm) {
    const file = input.files[0];
    uploadImage(file)
        .then(data => {
            if (data.error) {
                displayError(data.error);
            } else {
                document.querySelector(`#${input.id}-preview`).src = data.imageUrl;

                // Store the image URL in a hidden input
                let hiddenInput = document.querySelector(`#${input.id}-url`);
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = `${input.id}-url`;
                    controlForm.appendChild(hiddenInput);
                }
                hiddenInput.value = data.imageUrl;

                updateWidgetContent(widget, controlForm);
                stateManager.addToUndoStack();
            }
        })
        .catch(error => displayError('An error occurred while uploading the image.', error));
}

export function setupWidgetControls(widgetContainer, widgetName) {
    widgetContainer.querySelectorAll('.widget').forEach(function (widget) {
        const controlPanel = document.createElement('div');
        controlPanel.classList.add('widget-control-panel');
        controlPanel.innerHTML = `
            <button class="edit-widget">Edit</button>
            <button class="delete-widget">Delete</button>
        `;
        widget.appendChild(controlPanel);

        controlPanel.querySelector('.edit-widget').addEventListener('click', function () {
            showWidgetControlInterface(widget, widgetName);
        });

        controlPanel.querySelector('.delete-widget').addEventListener('click', function () {
            widget.remove();
            stateManager.addToUndoStack();
        });
    });
}

export function showWidgetControlInterface(widget, widgetName) {
    fetch(`/render-controls?widget-type=${widgetName}`, {
        method: 'POST',
        body: JSON.stringify({ widget: widget.outerHTML }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            const canvasPageContentEdit = document.querySelector('#canvas-pagecontent-edit-controlls-list');
            canvasPageContentEdit.innerHTML = '';

            const controlForm = document.createElement('form');
            controlForm.classList.add('widget-control-form');
            controlForm.innerHTML = data.html;
            canvasPageContentEdit.appendChild(controlForm);

            controlForm.querySelectorAll('input, textarea').forEach(function (input) {
                input.addEventListener('input', function () {
                    updateWidgetContent(widget, controlForm);
                    stateManager.addToUndoStack();
                });
            });

            controlForm.querySelectorAll('input[type="file"]').forEach(function (input) {
                input.addEventListener('change', function () {
                    handleImageUpload(input, widget, controlForm);
                });
            });
        })
        .catch(error => displayError('An error occurred while fetching widget controls.'));
}

function updateWidgetContent(widget, controlForm) {
    const controls = new FormData(controlForm);
    controls.forEach((value, key) => {
        const element = widget.querySelector(`#${key}`);
        if (element) {
            if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                element.value = value;
            } else if (element.tagName === 'IMG') {
                element.src = value;
            } else {
                element.innerText = value;
            }
        }
    });
}