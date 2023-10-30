<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gallery' ?> | <?= APP_NAME ?></title>
    <link rel="stylesheet" type="text/css" href="<?= ROOT ?>/assets/css/bootstrap.min.css">
    </link>
</head>

<body>
    <?php
    $ses = new \Core\Session;

    ?>

    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT ?>"><?= APP_NAME ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= APP_NAME ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/photos">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT ?>/upload">Upload</a>
                    </li>

                    <?php if ($ses->is_logged_in()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                User
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT ?>/profile">Profile</a></li>

                                <?php if ($ses->user('role') == 'admin') : ?>
                                    <li><a class="dropdown-item" href="<?= ROOT ?>/admin">Admin</a></li>
                                <?php endif; ?>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= ROOT ?>/logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT ?>/signup">Signup</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form action="<?= ROOT ?>/search" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search images" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- navbar end -->