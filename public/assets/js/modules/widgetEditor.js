import { setupWidgetControls, showWidgetControlInterface } from './widgetControls.js';
import { handleWidgetDragStart, handleDragOver } from './widgetHandler.js';

export function enableWidgetEditing(widgetContainer) {
    widgetContainer.querySelectorAll('.editable').forEach(function (element) {
        element.addEventListener('click', function () {
            showWidgetControlInterface(widgetContainer, widgetContainer.getAttribute('data-widget'));
        });
    });

    widgetContainer.addEventListener('dragstart', handleWidgetDragStart);
    widgetContainer.addEventListener('dragover', handleDragOver);

    widgetContainer.addEventListener('drop', function (event) {
        event.preventDefault();
        const draggedWidgetId = event.dataTransfer.getData('widget-id');
        const draggedWidget = document.getElementById(draggedWidgetId);
        if (draggedWidget && draggedWidget !== widgetContainer) {
            widgetContainer.parentNode.insertBefore(draggedWidget, widgetContainer.nextSibling);
            addToUndoStack();
        }
    });
}