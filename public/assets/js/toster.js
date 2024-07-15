function showToast(message, duration = 3000, backgroundColor = '#333') {
    const toasterContainer = document.getElementById('toaster-container');

    // Create the toaster element
    const toaster = document.createElement('div');
    toaster.className = 'toaster';
    toaster.style.backgroundColor = backgroundColor;

    // Add the message text
    const messageText = document.createElement('span');
    messageText.textContent = message;
    toaster.appendChild(messageText);

    // Add the dismiss button
    const dismissButton = document.createElement('button');
    dismissButton.innerHTML = '&times;';
    dismissButton.onclick = () => {
        toaster.classList.remove('show');
        setTimeout(() => toaster.remove(), 500);
    };
    toaster.appendChild(dismissButton);

    // Append the toaster to the container
    toasterContainer.appendChild(toaster);

    // Show the toaster
    setTimeout(() => {
        toaster.classList.add('show');
    }, 10);

    // Automatically remove the toaster after the specified duration
    setTimeout(() => {
        toaster.classList.remove('show');
        setTimeout(() => toaster.remove(), 500);
    }, duration);
}