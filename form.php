<?php
echo '
<div class="w-25 h-75 mx-auto align-content-center" style="min-height: 75dvh;">
    <form class="container">
        <div class="input-group flex-nowrap">
            <input type="text" class="form-control" placeholder="Note title" aria-label="Username" aria-describedby="addon-wrapping">
        </div>
   

 <div class="container mt-2 d-flex justify-content-around align-content-center">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="urgent" value="urgent" checked>
            <label class="form-check-label text-danger" for="urgent">
                Urgent
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="medium" value="medium">
            <label class="form-check-label text-warning" for="medium">
                Medium
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="exampleRadios" id="low" value="low">
            <label class="form-check-label text-success" for="low">
                Low
            </label>
        </div>
    </div>

    <div class="form-floating mt-3">
    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px; resize:none;"></textarea>
    <label for="floatingTextarea2">Note Describtion</label>
    </div>

    <button type="button" class="btn btn-dark mt-2">Add Note</button>
    </form>
</div>';