<?php

echo '
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 136px);">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <form action="notes.php" method="post">
                <div class="input-group flex-nowrap mb-3">
                    <input type="text" class="form-control" placeholder="Note Title" name="noteTitle" required>
                </div>

                <div class="mb-3 d-flex flex-column flex-sm-row justify-content-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priority" id="urgent" value="urgent" required>
                        <label class="form-check-label text-danger" for="urgent">
                            Urgent
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priority" id="medium" value="medium" required>
                        <label class="form-check-label text-warning" for="medium">
                            Medium
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="priority" id="low" value="low" required>
                        <label class="form-check-label text-success" for="low">
                            Low
                        </label>
                    </div>
                </div>

                <div class="form-floating mb-1">
                    <textarea class="form-control" placeholder="Leave a comment here" id="descriptionTextarea" name="description" style="height: 200px; resize:none;" maxlength="500" required></textarea>
                    <label for="descriptionTextarea">Description</label>
                </div>
                <div class="text-end text-muted small mb-3">
                    <span id="charCount">0</span> / 500
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark">Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const textarea = document.getElementById("descriptionTextarea");
    const charCount = document.getElementById("charCount");
    textarea.addEventListener("input", function () {
        const len = textarea.value.length;
        charCount.textContent = len;
        charCount.style.color = len >= 450 ? "#dc3545" : len >= 350 ? "#fd7e14" : "";
    });
</script>';

