const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

// Serve static files (e.g., HTML, JS, CSS)
app.use(express.static('public'));

// Handle WebRTC signaling messages
io.on('connection', (socket) => {
    console.log('A user connected');

    // Listen for WebRTC offer
    socket.on('webrtc-offer', (offer) => {
        socket.broadcast.emit('webrtc-offer', offer);
    });

    // Listen for WebRTC answer
    socket.on('webrtc-answer', (answer) => {
        socket.broadcast.emit('webrtc-answer', answer);
    });

    // Listen for ICE candidate
    socket.on('ice-candidate', (candidate) => {
        socket.broadcast.emit('ice-candidate', candidate);
    });

    // Listen for chat messages
    socket.on('chat_message', (message) => {
        io.emit('chat_message', message);
    });

    // Disconnect event
    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

// Start the server
server.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});