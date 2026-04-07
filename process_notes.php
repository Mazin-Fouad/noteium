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
        'createdAt' => date('d-m-Y H:i'),
        'pinned' => false
    ];
    array_push($notes, $newNote);
    file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
}

if (isset($_POST["deleteIndex"])) {
    $deleteIndex = $_POST["deleteIndex"];
    if (isset($notes[$deleteIndex])) {
        unset($notes[$deleteIndex]);
        $notes = array_values($notes);
        file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
    }
}

if (isset($_POST['editIndex'])) {
    $editIndex = $_POST['editIndex'];
    $notes[$editIndex]['noteTitle'] = $_POST['noteTitle'];
    $notes[$editIndex]['notePriority'] = $_POST['notePriority'];
    $notes[$editIndex]['NoteDescription'] = $_POST['noteDescription'];
    file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
}

if (isset($_POST['pinIndex'])) {
    $pinIndex = (int)$_POST['pinIndex'];
    if (isset($notes[$pinIndex])) {
        $notes[$pinIndex]['pinned'] = !(isset($notes[$pinIndex]['pinned']) && $notes[$pinIndex]['pinned'] === true);
        file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
    }
}

if (isset($_POST['duplicateIndex'])) {
    $dupIndex = (int)$_POST['duplicateIndex'];
    if (isset($notes[$dupIndex])) {
        $dupNote = $notes[$dupIndex];
        $dupNote['noteTitle'] = $dupNote['noteTitle'] . ' (Copy)';
        $dupNote['createdAt'] = date('d-m-Y H:i');
        $dupNote['pinned'] = false;
        array_push($notes, $dupNote);
        file_put_contents('notes.txt', json_encode($notes, JSON_PRETTY_PRINT));
    }
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

$sortBy = isset($_POST['sortBy']) ? $_POST['sortBy'] : 'newest';

function parseNoteDate($dateStr) {
    $date = DateTime::createFromFormat('d-m-Y H:i', $dateStr);
    if ($date) return $date;
    $date = DateTime::createFromFormat('Y-m-d H:i', $dateStr);
    if ($date) return $date;
    $date = DateTime::createFromFormat('Y-m-d', $dateStr);
    if ($date) return $date;
    return new DateTime('1970-01-01');
}

$priorityOrder = ['urgent' => 0, 'medium' => 1, 'low' => 2];

$keys = array_keys($notes);
usort($keys, function($a, $b) use ($notes, $sortBy, $priorityOrder) {
    $pinnedA = isset($notes[$a]['pinned']) && $notes[$a]['pinned'] === true;
    $pinnedB = isset($notes[$b]['pinned']) && $notes[$b]['pinned'] === true;
    if ($pinnedA !== $pinnedB) {
        return $pinnedA ? -1 : 1;
    }
    if ($sortBy === 'oldest') {
        $dateA = parseNoteDate($notes[$a]['createdAt'] ?? '');
        $dateB = parseNoteDate($notes[$b]['createdAt'] ?? '');
        return $dateA <=> $dateB;
    } elseif ($sortBy === 'priority') {
        $prioA = $priorityOrder[strtolower($notes[$a]['notePriority'] ?? '')] ?? 3;
        $prioB = $priorityOrder[strtolower($notes[$b]['notePriority'] ?? '')] ?? 3;
        return $prioA <=> $prioB;
    } elseif ($sortBy === 'alphabetical') {
        return strcmp($notes[$a]['noteTitle'] ?? '', $notes[$b]['noteTitle'] ?? '');
    } else {
        $dateA = parseNoteDate($notes[$a]['createdAt'] ?? '');
        $dateB = parseNoteDate($notes[$b]['createdAt'] ?? '');
        return $dateB <=> $dateA;
    }
});

$stats = ['total' => count($notes), 'urgent' => 0, 'medium' => 0, 'low' => 0];
foreach ($notes as $note) {
    $p = strtolower($note['notePriority'] ?? '');
    if (array_key_exists($p, $stats)) {
        $stats[$p]++;
    }
}

$sortOptions = [
    'newest'      => 'Newest First',
    'oldest'      => 'Oldest First',
    'priority'    => 'Priority',
    'alphabetical'=> 'A – Z',
];

echo '
    <div class="container pt-5" style="min-height: calc(100dvh - 136px);">
        <h2 class="text-center mb-4 display-5 fw-bolder" style="letter-spacing:.4rem;">Saved Notes</h2>

        <div class="row g-2 mb-4 text-center">
            <div class="col-6 col-sm-3">
                <div class="stats-card stats-total">
                    <div class="stats-number">' . (int)$stats['total'] . '</div>
                    <div class="stats-label">Total</div>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="stats-card stats-urgent">
                    <div class="stats-number">' . (int)$stats['urgent'] . '</div>
                    <div class="stats-label">Urgent</div>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="stats-card stats-medium">
                    <div class="stats-number">' . (int)$stats['medium'] . '</div>
                    <div class="stats-label">Medium</div>
                </div>
            </div>
            <div class="col-6 col-sm-3">
                <div class="stats-card stats-low">
                    <div class="stats-number">' . (int)$stats['low'] . '</div>
                    <div class="stats-label">Low</div>
                </div>
            </div>
        </div>

        <form method="POST" class="d-flex flex-wrap gap-2 mb-4 align-items-center">
            <input type="text" name="search" class="form-control flex-grow-1" style="min-width:180px;" placeholder="Search notes..." value="' . htmlspecialchars($searchQuery) . '">
            <select name="sortBy" class="form-select" style="width:auto;">
';
foreach ($sortOptions as $val => $label) {
    $selected = ($sortBy === $val) ? ' selected' : '';
    echo '                <option value="' . $val . '"' . $selected . '>' . $label . '</option>' . "\n";
}
echo '            </select>
            <button type="submit" class="btn btn-dark px-3"><i class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
        </form>

        <div class="row text-center mt-3">';
foreach ($keys as $key) {
    $note = $notes[$key];
    $noteTitle = isset($note['noteTitle']) ? $note['noteTitle'] : 'No title';
    $notePriority = isset($note['notePriority']) ? $note['notePriority'] : 'No priority';
    $noteDescription = isset($note['NoteDescription']) ? $note['NoteDescription'] : 'No description';
    $createdAt = isset($note['createdAt']) ? $note['createdAt'] : 'No date';
    $isPinned = isset($note['pinned']) && $note['pinned'] === true;
    include 'noteCard.php';
}
echo '
        </div>
    </div>';