import { enableWidgetEditing } from './widgetEditor.js';
import { setupWidgetControls } from './widgetControls.js';
import { displayError } from './notificationHandler.js';

export function handleWidgetDrop(event, stateManager) {
    event.preventDefault();
    const widgetClass = event.dataTransfer.getData("widget");
    fetch(`/render-widget`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ widget_class: widgetClass })
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                displayError(data.error);
                return;
            }
            const widgetContainer = createWidgetContainer(data);
            document.querySelector('#main-canvas').appendChild(widgetContainer);
            enableWidgetEditing(widgetContainer);
            setupWidgetControls(widgetContainer, data.widgetName);
            stateManager.addToUndoStack(document.querySelector('#main-canvas').innerHTML);
        })
        .catch(error => displayError('An error occurred while rendering the widget.'));
}

export function handleWidgetDragStart(event) {
    event.dataTransfer.setData("widget", event.target.getAttribute('data-widget'));
}

export function handleDragOver(event) {
    event.preventDefault();
}

function createWidgetContainer(data) {
    let widgetName = data.widgetName;
    const widgetContainer = document.createElement('div');
    widgetContainer.classList.add('widget-init');
    widgetContainer.setAttribute('data-widget', widgetName);
    widgetContainer.setAttribute('draggable', 'true');
    widgetContainer.innerHTML = data.html;
    return widgetContainer;
}