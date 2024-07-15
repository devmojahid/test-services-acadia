import { handleWidgetDrop, handleWidgetDragStart, handleDragOver } from './modules/widgetHandler.js';
import { enableWidgetEditing } from './modules/widgetEditor.js';
import { StateManager } from './modules/stateManager.js';
import { displayError, displaySuccess } from './modules/notificationHandler.js';
import { setupWidgetControls } from './modules/widgetControls.js';

document.addEventListener('DOMContentLoaded', function () {
    const stateManager = new StateManager();

    document.querySelectorAll('.widget-item').forEach(function (widgetItem) {
        widgetItem.addEventListener('dragstart', handleWidgetDragStart);
    });

    document.querySelector('#main-canvas').addEventListener('drop', function (event) {
        handleWidgetDrop(event, stateManager);
    });
    document.querySelector('#main-canvas').addEventListener('dragover', handleDragOver);

    document.querySelector('#save-page').addEventListener('click', function (event) {
        savePageContent(event, stateManager);
    });
    document.querySelector('#undo').addEventListener('click', function () {
        undoAction(stateManager);
    });
    document.querySelector('#redo').addEventListener('click', function () {
        redoAction(stateManager);
    });

    function savePageContent(event, stateManager) {
        event.preventDefault();
        const content = document.querySelector('#main-canvas').innerHTML;
        fetch(`/save-page`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ page_content: content })
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    displayError(data.error);
                } else {
                    displaySuccess('Page saved successfully!');
                    stateManager.addToUndoStack(content);
                }
            })
            .catch(error => displayError('An error occurred while saving the page.'));
    }

    function undoAction(stateManager) {
        const content = stateManager.undo();
        if (content) {
            document.querySelector('#main-canvas').innerHTML = content;
            reinitializeWidgets();
        }
    }

    function redoAction(stateManager) {
        const content = stateManager.redo();
        if (content) {
            document.querySelector('#main-canvas').innerHTML = content;
            reinitializeWidgets();
        }
    }

    function reinitializeWidgets() {
        document.querySelectorAll('.widget-init').forEach(function (widgetElement) {
            enableWidgetEditing(widgetElement);
            setupWidgetControls(widgetElement, widgetElement.getAttribute('data-widget'));
        });
    }

    // Restore the initial state
    if (stateManager.getCurrentState()) {
        document.querySelector('#main-canvas').innerHTML = stateManager.getCurrentState();
        reinitializeWidgets();
    } else {
        stateManager.addToUndoStack(document.querySelector('#main-canvas').innerHTML);
    }
});