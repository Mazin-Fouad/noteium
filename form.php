<?php
echo '
<div class="w-25 h-75 mx-auto align-content-center" style="min-height: calc(100dvh - 156px);">
    <form action="notes.php" method="post" class="container">
        <div class="input-group flex-nowrap">
            <input type="text" class="form-control" placeholder="Note Title" name="noteTitle">
        </div>
   

 <div class="container mt-2 d-flex justify-content-around align-content-center">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" id="urgent" value="urgent">
            <label class="form-check-label text-danger" for="urgent">
                Urgent
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" id="medium" value="medium">
            <label class="form-check-label text-warning" for="medium">
                Medium
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="priority" id="low" value="low">
            <label class="form-check-label text-success" for="low">
                Low
            </label>
        </div>
    </div>

    <div class="form-floating mt-3">
    <textarea class="form-control" placeholder="Leave a comment here" name="description" style="height: 200px; resize:none;"></textarea>
    <label for="floatingTextarea2">Description</label>
    </div>

    <button type="submit" class="btn btn-dark mt-2">Add Note</button>
    </form>
</div>';