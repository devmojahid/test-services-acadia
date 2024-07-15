export function displayError(message, error) {
    const notification = document.createElement('div');
    notification.className = 'notification error';
    notification.innerText = `Error: ${message}`;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);

    console.error(error);
}

export function displaySuccess(message) {
    const notification = document.createElement('div');
    notification.className = 'notification success';
    notification.innerText = `Success: ${message}`;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}