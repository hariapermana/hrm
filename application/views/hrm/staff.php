<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/reminder.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>Staff</title>
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

    <section id="inbox">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Staff</li>
            </ol>
        </nav>

        <div class="container-fluid mainbox">
            <div class="card border-0">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reminderModal">
                        NEW STAFF
                    </button>
                    <div class="card mt-3 border-0">
                        <div class="card-body">
                            <table id="listed" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>Join Date</th>
                                        <th>Status</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $name = array('Hari Agus', 'Rizki Maulana', 'Gilang Zens');
                                    for ($i; $i < 3; $i++) :
                                    ?>
                                        <tr>
                                            <td><?= $name[$i] ?></td>
                                            <td>IT Management</td>
                                            <td>20/09/2002</td>
                                            <td>Active</td>
                                            <td>20/09/2020</td>
                                            <td>
                                                <a href="#!">Click here for more information</a>
                                            </td>
                                        </tr>
                                    <?php endfor ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="reminderModal" tabindex="-1" role="dialog" aria-labelledby="reminderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reminderModalLabel">NEW STAFF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="fname">Full Name</label>
                        <input type="text" id="fname" name="fname" class="form-control">

                        <label for="position">Position</label>
                        <select name="position" id="position" class="form-control">
                            <option value="">--</option>
                        </select>

                        <div class="d-flex">
                            <div class="mr-3">
                                <label for="joinDate">Join Date</label>
                                <input type="date" class="form-control" name="jDate">
                            </div>
                            <div class="">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control" name="eDate">
                            </div>
                        </div>

                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">--</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#listed').DataTable();
        });
    </script>
</body>

</html>