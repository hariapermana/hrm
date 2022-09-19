<?php
$dueDate = new DateTime($detailReminder[0]->date);
$startDate = new DateTime($detailReminder[0]->start_periode_date);
$endDate = new DateTime($detailReminder[0]->end_periode_date);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>Inbox</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form action="">
                    <div class="group">
                        <input type="search" name="search">
                        <i class="fas fa-search"></i>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="navbar-brand" href="#">
                            <img src="<?= base_url() ?>assets/hrm/img/logo.png" alt="logo" width="70%" />
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="<?= base_url() ?>assets/hrm/img/nav/grid-light.svg" width="24px" alt="nav" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="notification">
                                <img src="<?= base_url() ?>assets/hrm/img/nav/bell-light.svg" width="24px" alt="nav" />
                                <span>1</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="inbox">
                            <img src="<?= base_url() ?>assets/hrm/img/nav/inbox-light.svg" width="24px" alt="nav" />
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
                                <a class="nav-link" href="/logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="inbox">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Inbox</li>
            </ol>
        </nav>

        <div class="container-fluid mainbox">
            <div class="row px-3">
                <div class="col-md-5">
                    <div class="card border-0">
                        <div class="card-header">
                            Sort by Newest
                        </div>
                        <?php foreach ($reminders as $inbox) : ?>
                            <a href="<?= base_url('admin/testing/inbox/' . $inbox->uniq_code) ?>">
                                <div class="card-body <?php if ($this->uri->segment(4) == $inbox->uniq_code) {
                                                            echo 'active';
                                                        } ?>">
                                    <div class="message">
                                        <h6><?= $inbox->subject ?></h6>
                                        <span><?= $inbox->rel_type == 'goals-setting' ? 'Please update your performance' : ($inbox->rel_type == 'sendback' ? 'Manager has send back your performance' : '') ?></span>
                                    </div>
                                    <div class="progres">
                                        <span>27 Second ago - In Progress</span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card border-0">
                        <div class="card-body">
                            <?php if ($detailReminder[0] != NULL) : ?>
                                <div class="profile-info">
                                    <img src="<?= base_url('assets/hrm/img/profile.png') ?>" class="rounded-circle" width="40px" alt="hrd">
                                    <div class="profile-info-desc">
                                        <h6>HR Management</h6>
                                        <span>
                                            <?php
                                            if ($detailReminder[0]->rel_type == 'goals-setting') {
                                                echo 'Please update your Performance Management';
                                            } elseif ($detailReminder[0]->rel_type == 'mid-year') {
                                                echo 'Mid Year evaluation has been started';
                                            } elseif ($detailReminder[0]->rel_type == 'end-year') {
                                                echo 'Final annual has been started';
                                            } elseif ($detailReminder[0]->rel_type == 'sendback') {
                                                echo 'The manager has been send back';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="timeline">
                                    <div class="left">
                                        <span>10 hours ago - Due <?= $dueDate->format('Y/m/d') ?></span>
                                    </div>
                                    <div class="right">
                                        <span><b>Period</b> <br> <?= $startDate->format('d/m/y') ?> - <?= $endDate->format('d/m/y') ?></span>
                                    </div>
                                </div>
                                <div class="goals-desc">
                                    <p>
                                        <?php
                                        if ($detailReminder[0]->rel_type == 'goals-setting') {
                                            echo 'Please update your Performance Management';
                                        } elseif ($detailReminder[0]->rel_type == 'mid-year') {
                                            echo 'Mid Year evaluation has been started';
                                        } elseif ($detailReminder[0]->rel_type == 'end-year') {
                                            echo 'Final annual has been started';
                                        } elseif ($detailReminder[0]->rel_type == 'sendback') {
                                            echo 'The manager has been send back';
                                        }
                                        ?>
                                        period <?= $startDate->format('d F Y') ?> - <?= $endDate->format('d F Y') ?> <br>

                                        <?php
                                        if ($detailReminder[0]->rel_type == 'mid-year') {
                                            echo 'Manager/Supervisor will meet with each employee to discuss SMART goals for the performance review period.';
                                        } elseif ($detailReminder[0]->rel_type == 'goals-setting') {
                                            echo 'Employees will input 3 to 5 SMART GOALS during the Goal Setting period.';
                                        } elseif ($detailReminder[0]->rel_type == 'end-year') {
                                            echo 'Manage/supervisor will meet with each employee to discuss SMART goals for the performance review period.';
                                        } elseif ($detailReminder[0]->rel_type == 'sendback') {
                                            echo 'Manage/supervisor has been send back your performance.';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="next-inbox">
                                    <img src="<?= base_url('assets/hrm/img/nav/next-inbox.svg') ?>" width="80px" alt="continue">
                                </div>
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary" onclick="openPage(this)" data-uniq="<?= $goalsExist[0] != '' ? $detailReminder[0]->uniq_code : '' ?>">Continue</button>
                                </div>
                            <?php else : ?>
                                <p align="center">No data avaible</p>
                            <?php endif ?>
                            <div class="history">
                                <h6>History</h6>
                                <div class="scrolled">
                                    <?php if (!empty($history)) : ?>
                                        <?php foreach ($history as $h) : ?>
                                            <div class="profile-info mt-3">
                                                <?= staff_profile_image($current_user->staffid, array('img', 'rounded-circle'), 'small', ['width' => '40px']); ?>
                                                <div class="profile-info-desc">
                                                    <h6><?= $h->full_name ?></h6>
                                                    <span>(<?= $h->date ?>)<?= ' ' . $h->description ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <span>You not have a history data</span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script>
        function openPage(e) {
            let url
            if (e.getAttribute('data-uniq') != '') {
                url = "<?= base_url('admin/testing/goals/') ?>" + e.getAttribute('data-uniq')
            } else {
                url = '<?= base_url('admin/testing/new-goals/') ?>' + '<?= $detailReminder[0]->uniq_code ?>'
            }
            window.location.href = url;
            // console.log(url)
        }
    </script>
</body>

</html>