<?php
$notes = [];

if (file_exists('notes.txt')) {
    $notes = json_decode(file_get_contents('notes.txt'), true);
}

if (isset($_POST["noteTitle"]) && isset($_POST["priority"]) && isset($_POST["description"])) {
    $newNote = [
        'noteTitle' => $_POST['noteTitle'],
        'notePriority' => $_POST['priority'],
        'NoteDescription' => $_POST['description'],
    ];
    echo 'New Note Created';
    array_push($notes, $newNote);
    file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
}
