// utils.js
export function renderMessages(messages, authUserId) {
    const messagesContainer = document.querySelector('#messages');
    messagesContainer.innerHTML = ''; // Xóa các tin nhắn cũ

    messages.forEach(message => {
        const messageDiv = document.createElement('div');
        messageDiv.style.marginBottom = '10px';
        messageDiv.style.padding = '5px';

        if (message.sender_id === authUserId) {
            messageDiv.style.textAlign = 'right';
            messageDiv.style.backgroundColor = '#e0f7fa';
        } else {
            messageDiv.style.textAlign = 'left';
            messageDiv.style.backgroundColor = '#fff9c4';
        }

        messageDiv.textContent = `${message.message}`;
        messagesContainer.appendChild(messageDiv);
    });

    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

export function fetchMessages(receiverId) {
    return axios.get('/get-messages', {
        params: { receiver_id: receiverId }
    });
}

export function sendMessage(receiverId, messageContent) {
    return axios.post('/send-message', {
        receiver_id: receiverId,
        message: messageContent,
    });
}
