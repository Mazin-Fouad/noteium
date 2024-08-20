<style>
section{
position: relative;
background-image: url('./assets/hero-bg.jpg');
background-size:cover;
background-position: center;
color: #E0FFFF;
overflow: hidden;
}

section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3); 
    z-index: 1; 
}

section .container {
    position: relative;
    z-index: 2; 
}
</style>


<section class='p-5 rounded-lg text-white'>
  <div class="container align-content-center" style="min-height: calc(100dvh - 252px);">
    <h1 class='display-4'>Welcome to Your Notes Hub!</h1>
    <p class='lead'>Discover the easiest way to organize, manage, and access your notes <br> with our streamlined platform.</p>
    <a class='btn btn-dark' href='notes.php' role='button'>Get Started</a>
  </div>
</section>