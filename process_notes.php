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

echo '
    <div class="container pt-5" style="min-height: calc(100dvh - 106px);">
        <h2 class="text-center mb-5">Your Notes</h2>
        <div class="row text-center">';
foreach ($notes as $key => $note) {
    $noteTitle = isset($note['noteTitle']) ? $note['noteTitle'] : 'No title';
    $notePriority = isset($note['notePriority']) ? $note['notePriority'] : 'No priority';
    $noteDescription = isset($note['NoteDescription']) ? $note['NoteDescription'] : 'No description';

    echo '
        <div class="col-sm-12 col-md-4 mb-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title ">' . $noteTitle . '</h4>
                    <h6 class="card-subtitle mb-3">Priority: ' . strtoupper($notePriority) . '</h6>
                    <p class="card-text">' . $noteDescription . '</p>
                    <a href="#" class="btn btn-danger mt-auto align-self-end">Delete</a>
                </div>
            </div>
        </div>';
}
echo '
        </div>
    </div>';