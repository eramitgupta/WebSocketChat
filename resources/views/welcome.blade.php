<!-- public/chat.html -->
<!DOCTYPE html>
<html>
<head>
    <title>WebSocket Chat</title>
</head>
<body>
    <div id="chat">
        <ul id="messages"></ul>
        <input id="message" autocomplete="off" /><button>Send</button>
    </div>
    <script>
        const socket = new WebSocket('ws://localhost:8080'); // Connect to your websocket server
        socket.onmessage = (event) => {
            const messages = document.getElementById('messages');
            const li = document.createElement('li');
            li.textContent = event.data;
            messages.appendChild(li);
        };

        document.querySelector('button').onclick = () => {
            const messageInput = document.getElementById('message');
            const message = messageInput.value;
            socket.send(message);
            messageInput.value = '';
        };
    </script>
</body>
</html>
