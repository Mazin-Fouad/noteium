<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
  .navbar-nav .nav-link:hover {
    color: #ffcc00 !important;
    transition: all 225ms ease-in-out;
  }

  .navbar-nav .nav-link.active {
    color: #ff6600 !important;
    /* Change to your desired active color */
    font-weight: bold;
  }
</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="./assets/logo_transparent.png" alt="Logo" style="width: 200px; height: 80px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a>
        <a class="nav-link <?php echo $current_page == 'notes.php' ? 'active' : ''; ?>" href="notes.php">My Notes</a>
        <a class="nav-link <?php echo $current_page == 'insert.php' ? 'active' : ''; ?>" href="insert.php">Add Notes</a>
      </div>
    </div>
  </div>
</nav>