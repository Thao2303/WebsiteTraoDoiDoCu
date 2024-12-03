import './bootstrap';
import './echo'; // Nếu đã tách file cho Echo

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// ID người nhận và người gửi
const authUserId = 1; // Gán động từ backend hoặc lấy từ giao diện

// Lấy receiverId từ localStorage nếu có
let receiverId = localStorage.getItem('receiverId');

// Danh sách tin nhắn hiện tại
let messages = [];

// Hàm hiển thị tin nhắn
function renderMessages(messages) {
    const messagesContainer = document.querySelector('#messages');
    messagesContainer.innerHTML = ''; // Xóa các tin nhắn cũ

    messages.forEach(message => {
        const messageDiv = document.createElement('div');
        messageDiv.style.marginBottom = '10px';
        messageDiv.style.padding = '5px';

        // Kiểm tra người gửi để hiển thị vị trí tin nhắn
        if (message.sender_id === authUserId) {
            messageDiv.style.textAlign = 'right'; // Tin nhắn của bạn nằm bên phải
            messageDiv.style.backgroundColor = '#e0f7fa';
        } else {
            messageDiv.style.textAlign = 'left'; // Tin nhắn của người nhận nằm bên trái
            messageDiv.style.backgroundColor = '#fff9c4';
        }

        messageDiv.textContent = `${message.message}`;
        messagesContainer.appendChild(messageDiv);
    });

    // Cuộn xuống cuối cùng của danh sách tin nhắn
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Thiết lập Laravel Echo cho realtime
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

// Lắng nghe tin nhắn mới
window.Echo.private(`chat.${authUserId}`)
    .listen('MessageSent', (event) => {
        console.log('New message received:', event.message);
        messages.push(event.message); // Thêm tin nhắn mới vào danh sách
        renderMessages(messages); // Hiển thị lại danh sách tin nhắn
});
document.addEventListener('DOMContentLoaded', () => {
    const searchButton = document.querySelector('#search-button');
    const searchInput = document.querySelector('#search');
    const userList = document.querySelector('#user-list');
    const sendButton = document.querySelector('#send-button');
    
    // Lấy phần tử hiển thị tên người nhận và email người nhận
    const recipientNameElement = document.querySelector('.recipient-name');
    const recipientEmailElement = document.querySelector('.recipient-email');
    
    // Lấy receiverId và receiverName từ localStorage
    let receiverId = localStorage.getItem('receiverId');
    let receiverName = localStorage.getItem('receiverName');
    let receiverEmail = localStorage.getItem('receiverEmail'); // Lấy email

    // Nếu receiverName và receiverEmail đã được lưu trong localStorage, hiển thị chúng
    if (receiverName && recipientNameElement) {
        recipientNameElement.textContent = receiverName; // Hiển thị tên người nhận
    } else if (recipientNameElement) {
        recipientNameElement.textContent = 'Tên người nhận'; // Mặc định nếu chưa có tên người nhận
    }

    if (receiverEmail && recipientEmailElement) {
        recipientEmailElement.textContent = receiverEmail; // Hiển thị email người nhận
    } else if (recipientEmailElement) {
        recipientEmailElement.textContent = 'Email người nhận'; // Mặc định nếu chưa có email người nhận
    }

    // Kiểm tra nếu có receiverId, thì gọi hàm fetchMessages để tải tin nhắn
    if (receiverId) {
        fetchMessages(receiverId); // Tải tin nhắn của người nhận
    }

    // Tìm kiếm người dùng khi gõ vào ô tìm kiếm
    searchInput.addEventListener('input', () => {
        const searchTerm = searchInput.value.trim();
    
        if (searchTerm) {
            axios.get('/search_chat', { params: { search: searchTerm } })
                .then(response => {
                    userList.innerHTML = ''; // Xóa kết quả cũ
                    response.data.users.forEach(user => {
                        const userDiv = document.createElement('div');
                        userDiv.textContent = user.name;
        
                        // Di chuyển event listener vào bên trong vòng lặp
                        userDiv.addEventListener('click', () => {
                            receiverId = user.id;
                            receiverName = user.name;
                            receiverEmail = user.email; // Lưu email người nhận
                            localStorage.setItem('receiverId', receiverId); // Lưu receiverId vào localStorage
                            localStorage.setItem('receiverName', receiverName); // Lưu receiverName vào localStorage
                            localStorage.setItem('receiverEmail', receiverEmail); // Lưu email vào localStorage
                            searchInput.value = user.name;
                            userList.innerHTML = ''; // Ẩn danh sách tìm kiếm
        
                            // Cập nhật tên và email người nhận
                            if (recipientNameElement) {
                                recipientNameElement.textContent = receiverName; // Cập nhật tên người nhận
                            }
                            if (recipientEmailElement) {
                                recipientEmailElement.textContent = receiverEmail; // Cập nhật email người nhận
                            }
                            
                            fetchMessages(receiverId); // Tải tin nhắn khi người dùng chọn người nhận
                        });
        
                        userList.appendChild(userDiv);
                    });
                })
                .catch(error => console.error('Error searching users:', error));
        } else {
            userList.innerHTML = ''; // Nếu không có từ khóa tìm kiếm, ẩn kết quả
        }
    });

    // Hàm lấy tin nhắn của người nhận
    function fetchMessages(receiverId) {
        if (!receiverId) {
            console.warn('Receiver ID is not selected!');
            return;
        }

        // Gọi API để lấy tin nhắn của người nhận
        axios.get('/messages', { params: { receiver_id: receiverId } })
            .then(response => {
                renderMessages(response.data, receiverId); // Truyền receiverId vào hàm renderMessages
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    // Gửi tin nhắn
    sendButton.addEventListener('click', () => {
        const messageContent = document.querySelector('#message-content').value.trim();

        if (!messageContent) {
            alert('Vui lòng nhập nội dung tin nhắn!');
            return;
        }

        if (!receiverId) {
            alert('Vui lòng chọn người nhận!');
            return;
        }

        // Gửi tin nhắn qua API
        axios.post('/send-message', {
            receiver_id: receiverId,
            message: messageContent,
        })
        .then(response => {
            fetchMessages(receiverId); // Lấy lại tin nhắn mới nhất của người nhận
            document.querySelector('#message-content').value = ''; // Xóa nội dung trong textarea
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
    });
});

// Kiểm tra danh sách người dùng
function updateSidebar() {
    const userList = document.getElementById('user-list');
    const sidebar = document.querySelector('.sidebar');
    
    // Kiểm tra nếu danh sách người dùng rỗng
    if (userList.children.length === 0) {
      sidebar.classList.add('no-users');  // Thêm class để ẩn đường kẻ
    } else {
      sidebar.classList.remove('no-users');  // Bỏ class khi có người dùng
    }
  }
  
  // Gọi hàm updateSidebar mỗi khi danh sách người dùng thay đổi
  updateSidebar();
  