
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
    <?php require_once __DIR__. "/navigation.php"?>
    <div class="conten">
        <div class="content d-flex justify-content-center align-items-center flex-column">
    <div class="main-view d-flex justify-content-center flex-column align-items-center shadow-sm" style="height: 540px;">
        <h1 class="text-light">Selamat datang di Dashboard <span class="text-primary" style="text-shadow:
        0 0 2px #fefefeff">Diary Of Learning</span> </h1>
        <p class="text-sm-center text-light text-start w-75 fs-5">Tingkatkan kemampuanmu setiap hari dengan catatan belajar, progress harian, dan materi yang kamu pelajari. Pantau perkembanganmu dan jadikan belajar sebagai kebiasaan terbaikmu.</p>
    </div>
    <div class="m-3 p-5 mt-4 d-flex justify-content-center align-items-center flex-row shadow-lg rounded-lg" style="height:300px; width:1130px;">
        <div class="w-25 p-2">
            <canvas id="grafik"></canvas>
            <script>
                const data = {
                    labels: [
                        'Red',
                        'Blue',
                        'Yellow'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [300, 50, 100],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ]
                    }]
                };
                const config = {
                type: 'doughnut',
                data: data,
                };

                const chart = document.getElementById("grafik");
                new Chart(chart,config);
            </script>
        </div>
        <div class="w-75 d-flex justify-content-start align-content-center flex-column p-4">
            <h2 class="text-primary p-0">Persentase Pengguna</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cupiditate excepturi quibusdam officiis, veritatis, libero laborum eligendi fuga modi ea optio facilis maxime porro ducimus fugit delectus. Nostrum provident blanditiis numquam.</p>
        </div>
    </div>
    <div class="view-card d-flex gap-5 justify-content-between flex-row m-3 p-5">
        <div class="card mb-3">
            <img src="/Project_PAW/view/gambar/buku.jpg" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="/Project_PAW/view/gambar/buku.jpg" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>
        <div class="card mb-3">
            <img src="/Project_PAW/view/gambar/buku.jpg" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>
</div>

    </div>

</body>

</html>