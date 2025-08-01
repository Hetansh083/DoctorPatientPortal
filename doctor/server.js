const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql2');

// Create a MySQL connection
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',  // Replace with your MySQL username
    password: '',  // Replace with your MySQL password
    database: 'your_database_name'  // Replace with your database name
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL database');
});

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

app.get('/', (req, res) => {
    res.send('Video call backend');
});

// Real-time chat message handling
io.on('connection', (socket) => {
    console.log('User connected: ' + socket.id);

    socket.on('sendMessage', (data) => {
        const { session_id, sender_id, message_text } = data;

        // Insert message into meeting_chat table
        const query = 'INSERT INTO meeting_chat (session_id, sender_id, message_text) VALUES (?, ?, ?)';
        db.query(query, [session_id, sender_id, message_text], (err, result) => {
            if (err) {
                console.error('Error inserting chat message: ' + err);
            } else {
                console.log('Message inserted');
            }
        });

        // Broadcast message to all participants in the session
        io.to(session_id).emit('receiveMessage', { sender_id, message_text });
    });

    // Handle session attendance updates
    socket.on('sessionStarted', (data) => {
        const { session_id, patient_id, doctor_id } = data;

        // Insert attendance into meeting_attendance table
        const query = 'INSERT INTO meeting_attendance (session_id, patient_id, doctor_id, status) VALUES (?, ?, ?, "attended")';
        db.query(query, [session_id, patient_id, doctor_id], (err, result) => {
            if (err) {
                console.error('Error inserting attendance: ' + err);
            } else {
                console.log('Attendance recorded');
            }
        });
    });

    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

const port = 3000;
server.listen(port, () => {
    console.log(`Server running on port ${port}`);
});