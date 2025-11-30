

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily-Learning</title>
    <script defer src="./package/jquery/jquery.js"></script>
    <script defer src="./js/sidebar.js"></script>
    <script defer src="./js/main.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="View/user/css/sidebar.css">
    <link rel="stylesheet" href="View/user/css/dasboard.css">
    <link rel="stylesheet" href="View/user/css/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="/View/css/main.css"> -->
</head>
<body>

    <?php if (isset($_SESSION["notif"])): ?>
        <?php
            require_once "include/notif/notif.php";
            unset($_SESSION["notif"]);
        ?>
    <?php endif; ?>
    <?php include "navigation.php"?>
    <div class="conten">
        <?php require_once __DIR__. "/controler/index_controller.php" ?>
    </div>

</body>

</html>