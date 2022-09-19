<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url() ?>assets/hrm/img/logo.png" alt="logo" width="70%" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="<?= base_url() ?>assets/hrm/img/nav/grid.svg" width="24px" alt="nav" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="<?= base_url() ?>assets/hrm/img/nav/bell.svg" width="24px" alt="nav" />
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="testing/inbox">
                            <img src="<?= base_url() ?>assets/hrm/img/nav/inbox.svg" width="24px" alt="nav" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a onclick="showProfileModal()">
                            <?= staff_profile_image($current_user->staffid, array('img', 'rounded-circle'), 'small', ['width' => '45px']); ?>
                        </a>
                    </li>
                </ul>

                <div class="profile-modal d-none">
                    <div class="card">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="closeProfileModal()">
                                    My Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="closeProfileModal()">
                                    My Timesheets
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="closeProfileModal()">
                                    Edit Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="closeProfileModal()">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="main" class="position-relative">
        <div class="container-fluid px-4 wrapper">
            <div class="card border-0">
                <div class="card-body">
                    <span>Welcome, <?= ucfirst(get_staff_full_name($current_user->staffid)) ?>!</span>
                </div>
            </div>

            <div class="d-flex mt-3">
                <div class="flex-1">
                    <span class="text-title">Announcement</span>
                    <div class="d-flex mt-3">
                        <img src="<?= base_url() ?>/assets/hrm/img/1.png" alt="1" />
                        <div class="infor">
                            <span> Nominasi karyawan terbaik bulan Oktober </span>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                                laborum magni ipsum quidem architecto? Corporis quidem...
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <img src="<?= base_url() ?>/assets/hrm/img/1.png" alt="1" />
                        <div class="infor">
                            <span> Nominasi karyawan terbaik bulan Oktober </span>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit
                                laborum magni ipsum quidem architecto? Corporis quidem...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-2">
                    <span class="text-title">Inbox</span>

                    <ul>
                        <?php foreach ($inbox as $i) : ?>
                        <li class="mt-2">
                            <a href="home/inbox/<?= $i->id . '/' . $i->uniq_code ?>">
                                <span>
                                    <b class="w500"><?= ucfirst($i->firstname) ?> (<?= $i->subject ?>)</b> <br />
                                    <b class="w400 text-muted">3 hours ago</b>
                                </span>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="go-to-inbox">
                        <a href="home/inbox"> Go to Inbox </a>
                    </div>
                </div>
            </div>

            <div class="card mt-4 border-0 mb-5">
                <div class="card-body">
                    <span class="text-title">Applications</span>

                    <div class="d-flex">
                        <?php
                        hooks()->do_action('before_render_aside_menu');
                        foreach ($sidebar_menu as $key => $item) {
                            if ((isset($item['collapse']) && $item['collapse']) && count($item['children']) === 0) {
                                continue;
                            }
                        ?>
                            <div class="items">
                                <div class="btn-group dropright">
                                    <?php if ($item['name'] != 'Reminder') : ?>
                                        <a href="<?= count($item['children']) > 0 ? '#' : $item['href']; ?>" <?= count($item['children']) > 0 ? 'data-toggle="dropdown" aria-haspopup="true"' : ''; ?> aria-expanded="false" <?= _attributes_to_string(isset($item['href_attributes']) ? $item['href_attributes'] : []); ?>>
                                            <i class="<?php echo $item['icon']; ?> menu-icon"></i>
                                            <h6><?= $item['name'] ?></h6>
                                        </a>
                                    <?php else : ?>
                                        <a href="home/reminder" <?= count($item['children']) > 0 ? 'data-toggle="dropdown" aria-haspopup="true"' : ''; ?> aria-expanded="false" <?= _attributes_to_string(isset($item['href_attributes']) ? $item['href_attributes'] : []); ?>>
                                            <i class="<?php echo $item['icon']; ?> menu-icon"></i>
                                            <h6><?= $item['name'] ?></h6>
                                        </a>
                                    <?php endif ?>

                                    <div class="dropdown-menu border-0 shadow ml-3 mr-3">
                                        <?php if (count($item['children']) > 0) { ?>
                                            <?php foreach ($item['children'] as $submenu) { ?>
                                                <div class="d-flex flex-column">
                                                    <a href="<?= $submenu['href'] ?>"><?= $submenu['name'] ?></a>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
</body>

</html>