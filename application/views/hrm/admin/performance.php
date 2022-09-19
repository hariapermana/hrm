<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/pmanagement.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>My Team Performance</title>
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
                <li class="breadcrumb-item active">My Team Performance</li>
            </ol>
        </nav>

        <div class="container-fluid content mt-3">
            <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary mb-3" data-target="#kpiModal" data-toggle="modal">NEW KPI GOAL</button>
                <form id="filter">
                    <select name="filter" class="form-control">
                        <option value="">Choose Filter</option>
                        <option value="goals">KPI Goals</option>
                        <option value="midyear">Mid Year Review</option>
                        <option value="endyear">Final Annual Review</option>
                    </select>
                </form>
            </div>
            <table id="listed" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Worker</th>
                        <th>Goals</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>completed On</th>
                        <th class="midyear d-none">Mid Year Review</th>
                        <th class="endyear d-none">End Year Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    for ($i; $i <= 6; $i++) :
                    ?>
                        <tr>
                            <td>Zakia Marrit</td>
                            <td>Goal #<?= $i ?> - (Pending Approve)</td>
                            <td>Testing</td>
                            <td>Not Started</td>
                            <td>2011-04-25</td>
                            <td></td>
                            <td class="midyear d-none"></td>
                            <td class="endyear d-none"></td>
                        </tr>
                    <?php endfor ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="kpiModal" tabindex="-1" role="dialog" aria-labelledby="kpiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kpiModalLabel">NEW KPI GOAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="date">Period</label>
                        <div class="d-flex text-center align-items-center">
                            <input type="date" id="date" name="date" class="form-control" style="width: 45%;">
                            <span style="width: 10%;">To</span>
                            <input type="date" id="date" name="date" class="form-control" style="width: 45%;">
                        </div>

                        <label for="assign">Assign to</label>
                        <select name="assign" id="assign" class="form-control">
                            <option value="">--</option>
                        </select>

                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" class="form-control"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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

        $('#filter').on('change', 'select', function(e) {
            var val = $(e.target).val();

            if (val == 'midyear') {
                $('.midyear').removeClass('d-none')
                $('.endyear').addClass('d-none')
            } else if (val == 'endyear') {
                $('.midyear').removeClass('d-none')
                $('.endyear').removeClass('d-none')
            } else {
                $('.midyear').addClass('d-none')
                $('.endyear').addClass('d-none')
            }
        })
    </script>
</body>

</html>