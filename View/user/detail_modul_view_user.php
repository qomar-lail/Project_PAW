<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($modul_judul) ?> - Challenge <?= $current + 1 ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container-fluid p-0">
  <div class="d-flex justify-content-between align-items-center px-2 border-bottom">
    <div class="d-flex align-items-center">
      <a href="modul.php" class="btn btn-link p-0 me-3 d-flex align-items-center text-dark">
        <i class="bi bi-arrow-left fs-4 pb-2"></i>
      </a>
      <h5 class="text-primary">Modul <?= htmlspecialchars($modul_judul) ?></h5>
    </div>
    <div class="d-flex align-items-center text-primary">
      <span class="me-2">User</span>
      <i class="bi bi-person-circle fs-4"></i>
    </div>
  </div>

  <div class="p-4">
    <h2 class="text-center mb-4">Challenge <?= $current + 1 ?> / <?= $total ?></h2>

    <div class="bg-white p-4 rounded shadow-sm mb-4 text-center">
      <p class="fs-5 mb-3">"<?= htmlspecialchars($current_challenge['contoh_kalimat']) ?>"</p>
      <p class="text-muted">Apa bahasa Indonesianya "<strong><?= htmlspecialchars($current_challenge['kata']) ?></strong>"?</p>
    </div>

    <form method="POST">
      <div class="mb-4">
        <label for="jawaban" class="form-label">Jawaban Anda:</label>
        <input type="text" class="form-control form-control-lg" id="jawaban" name="jawaban" placeholder="Ketik jawaban..." required>
      </div>

      <div class="d-flex">
        <?php if ($current < $total - 1): ?>
          <button type="submit" class="btn btn-primary text-white">Next</button>
        <?php else: ?>
          <button type="submit" class="btn btn-success">Selesai & Hitung Skor</button>
        <?php endif; ?>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
