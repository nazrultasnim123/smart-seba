<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Friend Chat</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js" defer></script>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        header {
            padding: 1rem 2rem;
            background-color: #1f2937;
            color: #f8fafc;
        }
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            overflow: hidden;
        }
        #chat-output {
            flex: 1;
            background-color: #fff;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            overflow-y: auto;
        }
        .message {
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        .message strong {
            display: block;
            margin-bottom: 0.25rem;
            color: #1f2937;
        }
        form {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        input[type="text"] {
            flex: 1;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #cbd5f5;
            font-size: 1rem;
        }
        button {
            background-color: #6366f1;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button:hover {
            background-color: #4f46e5;
        }
    </style>
</head>
<body>
<header>
    <h1>Smart Friend</h1>
</header>
<main>
    <div id="chat-output">
        <div class="message">
            <strong>Smart Friend:</strong>
            <span>Ask me anything!</span>
        </div>
    </div>
    <form id="chat-form">
        <input type="text" id="chat-input" name="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('chat-form');
        const input = document.getElementById('chat-input');
        const output = document.getElementById('chat-output');

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const message = input.value.trim();
            if (!message) {
                return;
            }

            appendMessage('You', message);
            input.value = '';
            input.focus();

            axios.post('{{ url('/smartfriend/chat') }}', { message })
                .then(function (response) {
                    if (response.data && response.data.message) {
                        appendMessage('Smart Friend', response.data.message);
                    } else {
                        appendMessage('Smart Friend', 'No response received.');
                    }
                })
                .catch(function () {
                    appendMessage('Smart Friend', 'There was an error contacting the server.');
                });
        });

        function appendMessage(sender, text) {
            const container = document.createElement('div');
            container.className = 'message';

            const title = document.createElement('strong');
            title.textContent = sender + ':';
            container.appendChild(title);

            const body = document.createElement('span');
            body.textContent = text;
            container.appendChild(body);

            output.appendChild(container);
            output.scrollTop = output.scrollHeight;
        }
    });
</script>
</body>
</html>
