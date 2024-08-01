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
        'createdAt' => date('d-m-Y H:i') 
    ];
    //echo 'New Note Created';
    array_push($notes, $newNote);
    file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
}

if (isset($_POST["deleteIndex"])) {
    $deleteIndex = $_POST["deleteIndex"];
    if (isset($notes[$deleteIndex])) {
        unset($notes[$deleteIndex]);
        $notes = array_values($notes); // Reindex array
        file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
        //echo 'Note Deleted';
    }
}

if (isset($_POST['editIndex'])) {
    $editIndex = $_POST['editIndex'];
    $notes[$editIndex]['noteTitle'] = $_POST['noteTitle'];
    $notes[$editIndex]['notePriority'] = $_POST['notePriority'];
    $notes[$editIndex]['NoteDescription'] = $_POST['noteDescription'];
    file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
}

$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
    $notes = array_filter($notes, function($note) use ($searchQuery) {
        return stripos($note['noteTitle'], $searchQuery) !== false ||
               stripos($note['notePriority'], $searchQuery) !== false ||
               stripos($note['NoteDescription'], $searchQuery) !== false;
    });
}

echo '
    <div class="container pt-5" style="min-height: calc(100dvh - 156px);">
        <h2 class="text-center mb-5 display-5 fw-bolder tracking-wide" style="letter-spacing:.4rem;">Saved Notes</h2>
         <form method="POST" class=" w-50 d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Search notes..." value="' . $searchQuery . '">
            <button type="submit" class="btn"><i class="fa-solid fs-3 fw-bolder fa-magnifying-glass"></i></button>
        </form>

        <div class="row text-center mt-5">';
foreach ($notes as $key => $note) {
    $noteTitle = isset($note['noteTitle']) ? $note['noteTitle'] : 'No title';
    $notePriority = isset($note['notePriority']) ? $note['notePriority'] : 'No priority';
    $noteDescription = isset($note['NoteDescription']) ? $note['NoteDescription'] : 'No description';
    $createdAt = isset($note['createdAt']) ? $note['createdAt'] : 'No date';
    include 'noteCard.php';
}
echo '
        </div>
    </div>';