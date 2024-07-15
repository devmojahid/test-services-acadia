export class StateManager {
    constructor() {
        this.undoStack = [];
        this.redoStack = [];
        this.loadState();
    }

    addToUndoStack(content) {
        this.undoStack.push(content);
        this.redoStack = []; // Clear the redo stack when a new action is taken
        this.saveState();
    }

    undo() {
        if (this.undoStack.length > 1) {
            this.redoStack.push(this.undoStack.pop());
            this.saveState();
            return this.undoStack[this.undoStack.length - 1];
        }
        return null;
    }

    redo() {
        if (this.redoStack.length > 0) {
            const content = this.redoStack.pop();
            this.undoStack.push(content);
            this.saveState();
            return content;
        }
        return null;
    }

    getCurrentState() {
        return this.undoStack[this.undoStack.length - 1];
    }

    saveState() {
        localStorage.setItem('pageBuilderState', JSON.stringify({
            undoStack: this.undoStack,
            redoStack: this.redoStack
        }));
    }

    loadState() {
        const savedState = JSON.parse(localStorage.getItem('pageBuilderState'));
        if (savedState) {
            this.undoStack = savedState.undoStack || [];
            this.redoStack = savedState.redoStack || [];
        }
    }
}