<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kivotos Website</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="img/bluarcip.png" type="image/x-icon" />
</head>

<body>
    <!-- Navbar -->
    <nav id="navBg" class="navbar navbar-expand-lg bg-info sticky-top">
        <div class="container">
            <a id="navLink" class="navbar-brand h1" href="#">
                <h1>KIVOTOS</h1>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span id="mobilebtn"><i class="bi bi-list h1"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link " href="#">Home</a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link" href="#article">Academies</a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link" href="#aboutme">About Me</a>
                    </li>
                    <li class="nav-item my-auto">
                        <a class="navLinka nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <button id="darkTheme" class="btn btn-dark">
                            <i
                                id="DTB"
                                class="DTB nav-link bi bi-moon-fill rounded-circle text-light"></i>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button id="lightTheme" class="btn btn-info">
                            <i
                                id="LTB"
                                class="LTB nav-link bi bi-brightness-high-fill rounded-circle text-light"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--  -->
    <!-- Hero Secttion -->
    <section id="hero" class="isi text-center p-5 bg-info-subtle">
        <div class="container">
            <div class="d-lg-flex flex-lg-row-reverse align-items-center">
                <img
                    src="img/BG_CS_PV_03.jpg"
                    alt="default"
                    class="img-fluid"
                    width="600" />
                <div class="p-2">
                    <h1 class="fw-bold display-4 text-sm-start">Welcome to Kivotos</h1>
                    <h4 class="lead display-6 text-sm-start">
                        Home to thousands of different academies (changed made by <b>Tera</b>)
                    </h4>
                    <h6 class="text-sm-start">
                        <span id="tanggal"></span>
                        <span id="jam"></span>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <!-- Article Secttion -->
    <!-- article begin -->
    <section id="article" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Academies</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                <?php
                $sql = "SELECT * FROM article ORDER BY id";
                $hasil = $conn->query($sql);

                while ($row = $hasil->fetch_assoc()) {
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["judul"] ?></h5>
                                <p class="card-text">
                                    <?= $row["isi"] ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">
                                    <?= $row["tanggal"] ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- article end -->
    <!--  -->
    <!-- Gallery Secttion -->
    <section id="gallery" class="isi text-center p-5 bg-info-subtle">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Gallery</h1>
            <div id="carouselExample" class="carousel slide">
                <?php
                $sql = "SELECT * FROM gallery";
                $hasil = $conn->query($sql);

                $active = true; // Flag to set the first item as active
                ?>
                <div class="carousel-inner">
                    <?php
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <div class="carousel-item <?= $active ? 'active' : '' ?>">
                            <img
                                src="img/<?= $row["gambar"] ?>"
                                class="d-block w-100"
                                alt="..." />
                        </div>
                    <?php
                        $active = false;
                    }
                    ?>
                    <button
                        class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
    </section>
    <!--  -->
    <!-- schedule -->
    <section id="schedule" class="text-center">
        <div class="container p-5">
            <h1 class="navLinka fw-bold display-6 pb-3">schedule</h1>
            <div class="row row-cols-1 row-cols-md-4 g-3 justify-content-center">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">SENIN</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Rekayasa Perangkat Lunak
                                <p>12:30 - 15:00 | H.5.12</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">SELASA</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Pendidikan Kewarganegaraan
                                <p>12:30 - 15:00 | Aula E.3.1</p>
                            </li>
                            <li class="list-group-item">
                                Basis Data
                                <p>12:30 - 15:00 | H.5.14</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">RABU</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Pemrograman Berbasis Web
                                <p>12:30 - 15:00 | D.2.J</p>
                            </li>
                            <li class="list-group-item">
                                Sistem Informasi
                                <p>12:30 - 15:00 | H.5.13</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">KAMIS</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Sistem Operasi
                                <p>12:30 - 15:00 | H.4.9</p>
                            </li>
                            <li class="list-group-item">
                                Logika Informatika
                                <p>12:30 - 15:00 | H.4.1</p>
                            </li>
                            <li class="list-group-item">
                                Basis Data
                                <p>12:30 - 15:00 | D.3.M</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">JUMAT</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                Probabilitas dan Statistik
                                <p>12:30 - 15:00 | H.3.8</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header bg-danger">
                            <h5 class="card-title text-white">SABTU</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Free</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  -->
    <!-- about me  -->
    <section id="aboutme" class="isi text-center p-5 bg-info-subtle">
        <div class="container">
            <div class="d-lg-flex flex-md-row align-items-center justify-content-evenly">
                <img
                    src="https://media.istockphoto.com/id/539210890/photo/clouds-over-a-corn-field.jpg?s=612x612&w=0&k=20&c=X1UJ3ofNYWgPjspMVGujsgPxqgW9xr3Zg8ISW881xWo="
                    alt="default"
                    class="img-fluid rounded-circle"
                    width="300" />
                <div class="p-2">
                    <p class="text-md-start">A11.2023.15139</p>
                    <h1 class="fw-bold display-4 text-md-start">Naufal Irfan najib</h1>
                    <h5 class="lead text-md-start">Program Studi Teknik Informatika</h5>
                    <a
                        href="https://dinus.ac.id/"
                        target="_blank"
                        class="text-md-start text-decoration-none text-black">
                        <h4>Universitas Dian Nuswantoro</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer class="text-center p-5">
        <div>
            <a href=""><i class="navLinka bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href=""><i class="navLinka bi bi-twitter h2 p-2 text-dark"></i></a>
            <a href=""><i class="navLinka bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div class="navLinka text-dark">Naufal Irfan Najib © 2024</div>
    </footer>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        window.setTimeout("showTime()", 1000);

        function showTime() {
            var time = new Date();
            var month = time.getMonth() + 1;

            setTimeout("showTime()", 1000);
            document.getElementById("tanggal").innerHTML =
                time.getDate() + "/" + month + "/" + time.getFullYear();
            document.getElementById("jam").innerHTML =
                time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
        }
    </script>
    <script type="text/javascript">
        document.getElementById("darkTheme").onclick = function() {
            document.body.classList.add("bg-dark");

            document.getElementById("navBg").classList.remove("bg-info");
            document.getElementById("navBg").classList.add("bg-dark");
            document.getElementById("navLink").classList.add("text-light");

            document.getElementById("darkTheme").classList.remove("btn-dark");
            document.getElementById("LTB").classList.remove("text-light");
            document.getElementById("LTB").classList.add("text-dark");

            document.getElementById("mobilebtn").classList.add("text-light");

            const navLinka = document.getElementsByClassName("navLinka");
            for (let i = 0; i < navLinka.length; i++) {
                navLinka[i].classList.remove("text-dark");
                navLinka[i].classList.add("text-light");
            }

            const collection = document.getElementsByClassName("isi");
            for (let i = 0; i < collection.length; i++) {
                collection[i].classList.remove("bg-info-subtle");
                collection[i].classList.add("bg-secondary");
                collection[i].classList.add("border-body-secondary");
                collection[i].classList.add("text-light");
            }

            const cardcolor = document.getElementsByClassName("isiCard");
            for (let i = 0; i < cardcolor.length; i++) {
                cardcolor[i].classList.remove("bg-body");
                cardcolor[i].classList.add("bg-secondary");
                cardcolor[i].classList.add("border-body-secondary");
                cardcolor[i].classList.add("text-light");
            }
        };
    </script>
    <script type="text/javascript">
        document.getElementById("lightTheme").onclick = function() {
            document.body.classList.remove("bg-dark");

            document.getElementById("navBg").classList.remove("bg-dark");
            document.getElementById("navBg").classList.add("bg-info");
            document.getElementById("navLink").classList.remove("text-light");

            document.getElementById("darkTheme").classList.add("btn-dark");
            document.getElementById("LTB").classList.add("text-light");
            document.getElementById("LTB").classList.remove("text-dark");

            document.getElementById("mobilebtn").classList.remove("text-light");

            const navLinka = document.getElementsByClassName("navLinka");
            for (let i = 0; i < navLinka.length; i++) {
                navLinka[i].classList.remove("text-light");
                navLinka[i].classList.add("text-dark");
            }

            const collection = document.getElementsByClassName("isi");
            for (let i = 0; i < collection.length; i++) {
                collection[i].classList.remove("bg-secondary");
                collection[i].classList.remove("border-body-secondary");
                collection[i].classList.remove("text-light");
                collection[i].classList.add("bg-info-subtle");
            }

            const cardcolor = document.getElementsByClassName("isiCard");
            for (let i = 0; i < cardcolor.length; i++) {
                cardcolor[i].classList.remove("border-body-secondary");
                cardcolor[i].classList.remove("text-light");
                cardcolor[i].classList.add("text-black");
                cardcolor[i].classList.add("bg-body");
            }
        };
    </script>
</body>

</html>