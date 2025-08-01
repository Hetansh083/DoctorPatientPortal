<?php
include('connection.php');

// Assuming the meeting starts and the link is generated dynamically
$doctor_id = 1;  // Example doctor ID
$patient_id = 5;  // Example patient ID
$meeting_link = 'https://video-call-link.com/meeting123';  // Example meeting link

// Insert the meeting data into the virtual_meetings table
$sql = "INSERT INTO virtual_meetings (doctor_id, patient_id, meeting_link, status) 
        VALUES ('$doctor_id', '$patient_id', '$meeting_link', 'scheduled')";

if ($database->query($sql) === TRUE) {
    echo "Meeting scheduled successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $database->error;
}

// Assuming the meeting is in progress and updates status after the call
$meeting_id = 123; // Example meeting ID
$sql_update = "UPDATE virtual_meetings SET status = 'in_progress' WHERE meeting_id = '$meeting_id'";

if ($database->query($sql_update) === TRUE) {
    echo "Meeting status updated to in progress!";
}
?>