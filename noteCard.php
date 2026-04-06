<?php

$bgClass = '';
if (strtolower($notePriority) === 'urgent') {
    $bgClass = 'bg-danger';
} elseif (strtolower($notePriority) === 'medium') {
    $bgClass = 'bg-warning';
} elseif (strtolower($notePriority) === 'low') {
    $bgClass = 'bg-success';
}

$borderColor = '';
if (strtolower($notePriority) === 'urgent') {
    $borderColor = 'border-danger';
} elseif (strtolower($notePriority) === 'medium') {
    $borderColor = 'border-warning';
} elseif (strtolower($notePriority) === 'low') {
    $borderColor = 'border-success';
}

$pinnedBadge = $isPinned
    ? '<span class="badge bg-secondary mb-2"><i class="fa-solid fa-thumbtack me-1"></i>Pinned</span>'
    : '';
$pinColor = $isPinned ? '#6c757d' : '#adb5bd';
$pinTitle = $isPinned ? 'Unpin this note'    : 'Pin this note';

echo '
<div class="col-12 col-md-6 col-lg-4 mb-2">
    <div class="card h-100' . ($isPinned ? ' pinned-card' : '') . '">
        <div class="card-body d-flex flex-column border-start border-4 ' . $borderColor . '">
            ' . $pinnedBadge . '
            <h4 class="card-title">' . htmlspecialchars($noteTitle) . '</h4>
            <h6 class="card-subtitle rounded-4 mb-3 ' . $bgClass . ' text-white p-1 mx-auto" style="width: 38%">Priority: ' . strtoupper($notePriority) . '</h6>
            <p class="card-text text-start">' . nl2br(htmlspecialchars($noteDescription)) . '</p>

            <div class="mt-auto d-flex justify-content-end gap-1">
                <!-- Pin -->
                <form method="POST" action="" class="d-inline">
                    <input type="hidden" name="pinIndex" value="' . $key . '">
                    <button type="submit" class="btn btn-sm" title="' . $pinTitle . '">
                        <i class="fa-solid fa-thumbtack' . ($isPinned ? '' : ' fa-rotate-90') . '" style="color:' . $pinColor . ';"></i>
                    </button>
                </form>
                <!-- Edit -->
                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal' . $key . '" title="Edit this note">
                    <i class="fa-solid fa-edit" style="color:#007bff;"></i>
                </button>
                <!-- Duplicate -->
                <form method="POST" action="" class="d-inline">
                    <input type="hidden" name="duplicateIndex" value="' . $key . '">
                    <button type="submit" class="btn btn-sm" title="Duplicate this note">
                        <i class="fa-solid fa-copy" style="color:#28a745;"></i>
                    </button>
                </form>
                <!-- Delete -->
                <form method="POST" action="" class="d-inline">
                    <input type="hidden" name="deleteIndex" value="' . $key . '">
                    <button type="submit" class="btn btn-sm" title="Delete this note">
                        <i class="fa-solid fa-trash" style="color:#ff3c41;"></i>
                    </button>
                </form>
            </div>

            <div class="fs-6 text-start mt-2">
                <i class="fa-solid fa-clock" style="color:#ffd43b;" title="Note created"></i>
                <span class="ms-1">' . htmlspecialchars($createdAt) . '</span>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal' . $key . '" tabindex="-1" aria-labelledby="editModalLabel' . $key . '" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel' . $key . '">Edit Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <input type="hidden" name="editIndex" value="' . $key . '">
                    <div class="mb-3">
                        <label for="noteTitle' . $key . '" class="form-label">Title</label>
                        <input type="text" class="form-control" id="noteTitle' . $key . '" name="noteTitle" value="' . htmlspecialchars($noteTitle) . '">
                    </div>
                    <div class="mb-3">
                        <label for="notePriority' . $key . '" class="form-label">Priority</label>
                        <select class="form-select" id="notePriority' . $key . '" name="notePriority">
                            <option value="urgent"' . (strtolower($notePriority) === 'urgent' ? ' selected' : '') . '>Urgent</option>
                            <option value="medium"' . (strtolower($notePriority) === 'medium' ? ' selected' : '') . '>Medium</option>
                            <option value="low"' . (strtolower($notePriority) === 'low' ? ' selected' : '') . '>Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="noteDescription' . $key . '" class="form-label">Description</label>
                        <textarea class="form-control" id="noteDescription' . $key . '" name="noteDescription" rows="3">' . htmlspecialchars($noteDescription) . '</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>';