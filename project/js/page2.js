// Open chat popup
document.querySelectorAll('.chat-icon').forEach((icon) => {
    icon.addEventListener('click', () => {
        const chatId = icon.getAttribute('data-chat-id'); // Get chat ID from data attribute
        const chatPopup = document.getElementById(`chatPopup${chatId}`);
        chatPopup.style.display = 'flex';
    });
});

// Close chat popup
document.querySelectorAll('.close-chat').forEach((button, index) => {
    button.addEventListener('click', () => {
        const chatPopup = document.getElementById(`chatPopup${index + 1}`);
        chatPopup.style.display = 'none';
    });
});

// Send message
function sendMessage(cardId) {
    const input = document.getElementById(`chatInput${cardId}`);
    const chatBody = document.getElementById(`chatBody${cardId}`);
    const message = input.value.trim();

    if (message) {
        const msgDiv = document.createElement('div');
        msgDiv.textContent = message;
        msgDiv.style.background = '#6200ea';
        msgDiv.style.color = '#fff';
        msgDiv.style.marginBottom = '5px';
        msgDiv.style.padding = '5px 10px';
        msgDiv.style.borderRadius = '5px';
        msgDiv.style.alignSelf = 'flex-end';
        chatBody.appendChild(msgDiv);

        input.value = '';
        chatBody.scrollTop = chatBody.scrollHeight;
    }
}

function showNotifications() {
    window.location.href = '/html/notifications.html';

}

function openContactForm() {
    window.location.href = '/html/contact.html'; 
}


function openSettings() {
    alert('Settings page coming soon!');
}

// Function to log out the user
function logoutUser() {
    const confirmation = confirm('Are you sure you want to log out?');
    if (confirmation) {
        window.location.href = '/html/home.html'; // Replace with your logout logic or redirect.
    }
}
