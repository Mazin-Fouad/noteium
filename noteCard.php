<?php

$bgClass = '';
if (strtolower($notePriority) === 'urgent') {
    $bgClass = 'bg-danger';
} elseif (strtolower($notePriority) === 'medium') {
    $bgClass = 'bg-warning';
} elseif (strtolower($notePriority) === 'low') {
    $bgClass = 'bg-success';
}

$borderColor = '';#
if (strtolower($notePriority) === 'urgent') {
    $borderColor = 'border-danger';
} elseif (strtolower($notePriority) === 'medium') {
    $borderColor = 'border-warning';
} elseif (strtolower($notePriority) === 'low') {
    $borderColor = 'border-success';
}

 
echo '
<div class="col-12 col-md-6 col-lg-4 mb-2">
    <div class="card h-100">
        <div class="card-body d-flex flex-column border-start border-4 ' . $borderColor . '">
            <h4 class="card-title">' . $noteTitle . '</h4>
            <h6 class="card-subtitle rounded-4 mb-3 ' . $bgClass . ' text-white p-1 mx-auto" style="width: 38%">Priority: ' . strtoupper($notePriority) . '</h6>
            <p class="card-text text-start">' . $noteDescription . '</p>
            <form method="POST" action="" class="mt-auto align-self-end">
                <input type="hidden" name="deleteIndex" value="' . $key . '">
             <div class="d-flex justify-content-center">
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal' . $key . '" data-bs-placement="bottom" title="Edit this note">
                <i class="fa-solid fs-5 fa-edit" style="color: #007bff;"></i>
            </button>

             <button type="submit" class="btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete this note">
                    <i class="fa-solid fs-5 fa-trash" style="color: #ff3c41;"></i>
                </button>

             </div>
          
            </form>
            <div class="fs-6 text-start"> 
            <i class="fa-solid fa-clock" style="color: #ffd43b;" title="Note created"></i>
            <span class="ms-1">'.$createdAt.'</span>
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
                        <input type="text" class="form-control" id="noteTitle' . $key . '" name="noteTitle" value="' . $noteTitle . '">
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
                        <textarea class="form-control" id="noteDescription' . $key . '" name="noteDescription" rows="3">' . $noteDescription . '</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>';