<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = $pageTitle ?? 'NgeEvent - Platform Event Manajemen';
$isLoggedIn = isset($_SESSION['user_id']);

$userIdentifier = $_SESSION['username'] ?? 'Pengguna';

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?> | NgeEvent</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Font Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .navbar-dark {
            background-color: #1e3c72 !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand:hover {
            color: #f7a61f !important;
            transition: color 0.3s ease;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-item.active .nav-link {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .dropdown-menu {
            background-color: #2a5298;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item {
            color: #ffffff;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #1e3c72;
            color: #ffffff !important;
        }

        /* Tombol Logout */
        .dropdown-menu .btn-logout {
            background-color: #f7a61f;
            color: #1e3c72;
            font-weight: bold;
            display: block;
            margin: 10px 15px;
            padding: 8px 15px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-menu .btn-logout:hover {
            background-color: #e6981a;
            transform: scale(1.02);
        }

        /* Search Bar */
        .btn-outline-light {
            color: #f7a61f !important;
            border-color: #f7a61f !important;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: #f7a61f !important;
            color: #1e3c72 !important;
        }
        .navbar-nav-secondary {
            display: flex;
            align-items: center;
        }

        @media (min-width: 992px) {
            .navbar-nav-secondary .nav-item {
                padding-bottom: 0 !important;
            }
        }

        .navbar-nav-secondary .btn-outline-light {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
            font-size: 1rem;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="fas fa-calendar-check me-2"></i>NgeEvent
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <!-- Nav Items Shared -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Find Event</a>
                    </li>

                    <!-- Opsi ketika sudah login -->
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Create Event</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-secondary align-items-center">
                    <li class="nav-item d-flex align-items-center me-lg-3">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Cari Event Terdekat..." aria-label="Search">
                            <button class="btn btn-outline-light" type="submit">Search</button>
                        </form>
                    </li>

                    <?php if ($isLoggedIn): ?>
                        <!-- OPSI AKUN LENGKAP (Sudah Login) -->
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> <?= htmlspecialchars($userIdentifier); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-cog me-2"></i>Profil & Pengaturan</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-exchange-alt me-2"></i>Ganti Akun</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a href="logout.php" class="btn-logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- OPSI TAMU (Belum Login) -->
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link btn btn-outline-light px-3" href="login.php">Masuk</a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link" href="register.php">Daftar</a>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>
    <main class="container mt-4">