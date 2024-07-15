
import { displayError } from './notificationHandler.js';

export function uploadImage(file) {
    const formData = new FormData();
    formData.append('image', file);

    return fetch('/upload-image', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            const imageInput = controlForm.querySelector('input[type="file"]');
            imageInput.value = '';
            imageInput.nextElementSibling.src = data.url;
            updateWidgetContent(widget, controlForm);
            stateManager.addToUndoStack();

        })
        .catch(error => displayError('An error occurred while uploading the image.', error));
}
