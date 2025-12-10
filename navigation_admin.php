<?php
$pageTitle = $pageTitle ?? ($_SESSION["halaman"] ?? "Dashboard");
?>
<div class="admin-topbar">
  <h1 class="admin-title"><?= htmlspecialchars($pageTitle) ?></h1>
</div>
<div class="admin-divider"></div>
