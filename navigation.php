<!--  -->
<nav class="navbar bg-light border-bottom px-2 shadow-sm">
    <div class="r-head d-flex">
        <?php require_once __DIR__. "/sidebar.php"?>
        <h3 class="text-primary p-0"><?= $_SESSION["halaman"] ?></h3>
    </div>
    <div class="profil d-flex flex-row justify-content-center align-items-center me-2">
        <p class="text-primary m-0 me-2">User</p>
        <i class="fa-solid fa-user p-2 "></i>
    </div>
</nav>