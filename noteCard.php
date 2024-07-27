<?php

$bgClass = '';
if (strtolower($notePriority) === 'urgent') {
    $bgClass = 'bg-danger';
} elseif (strtolower($notePriority) === 'medium') {
    $bgClass = 'bg-warning';
} elseif (strtolower($notePriority) === 'low') {
    $bgClass = 'bg-success';
}
 
echo '
<div class="col-12 col-md-6 col-lg-4 mb-2">
    <div class="card h-100">
        <div class="card-body d-flex flex-column">
            <h4 class="card-title">' . $noteTitle . '</h4>
            <h6 class="card-subtitle rounded-4 mb-3 '. $bgClass . ' text-white p-1 mx-auto" style="width: 38%">Priority: ' . strtoupper($notePriority) . '</h6>
            <p class="card-text text-start">' . $noteDescription . '</p>
            <form method="POST" action="" class="mt-auto align-self-end">
                <input type="hidden" name="deleteIndex" value="' . $key . '">
                <button type="submit" class="btn"><i class="fa-solid fs-5 fa-trash" style="color: #ff3c41;"></i></button>
            </form>
        </div>
    </div>
</div>';
