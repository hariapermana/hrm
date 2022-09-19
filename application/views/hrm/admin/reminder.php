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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>Home</title>
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
                <li class="breadcrumb-item active">Reminder</li>
            </ol>
        </nav>

        <div class="container-fluid mainbox">
            <div class="card border-0">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reminderModal">
                        NEW REMINDER
                    </button>
                    <div class="card mt-3 border-0">
                        <div class="card-body">
                            <table id="listed" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Assigned To</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Added By</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                    <h5 class="modal-title" id="reminderModalLabel">NEW REMINDER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-reminder" style="font-size: 14px;">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date">* Due Date</label>
                                <input type="date" id="dueDate" name="dueDate" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="assign">* Assign to</label>
                                <select name="assign" id="assign" class="form-control">
                                    <option class="text-center">-- Choose Assigned --</option>
                                    <?php foreach ($staff as $s) : ?>
                                        <option value="<?= $s['staffid'] ?>"><?= ucfirst($s['firstname']) . ' ' . ucfirst($s['lastname']) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="from_date">* From Date</label>
                                <input type="date" class="form-control" name="fromDate" id="fromDate">
                            </div>
                            <div class="col-md-6">
                                <label for="to_date">* To Date</label>
                                <input type="date" class="form-control" name="toDate" id="toDate">
                            </div>
                        </div>

                        <label for="type">* Type Reminder</label>
                        <select name="type" id="type" class="form-control">
                            <option class="text-center">-- Choose Type --</option>
                            <option value="goals-setting">Goals Setting</option>
                            <option value="midyear-evaluation">Mid Year Evaluation</option>
                            <option value="final-annual">Final Annual_user</option>
                        </select>

                        <label for="subject">* Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control">

                        <label for="desc">* Description</label>
                        <textarea name="desc" id="desc" class="form-control"></textarea>

                        <div class="d-flex align-items-center" style="gap: 5px">
                            <input type="checkbox" name="reminder" id="reminder">
                            <label for="reminder">Email reminder to Employee</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        var table;
        $(document).ready(function() {
            //datatables
            table = $('#listed').DataTable({
                "processing": false,
                "searching": false,
                "serverSide": true,
                "order": [],
                "ajax": {
                    //panggil method ajax list dengan ajax
                    "url": 'reminder/get-data',
                    "type": "GET",
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
            });
        });

        $('#form-reminder').on('submit', (e) => {
            e.preventDefault()
            const dueDate = $('#dueDate').val()
            const assignTo = $('#assign').val()
            const fromDate = $('#fromDate').val()
            const toDate = $('#toDate').val()
            const type = $('#type').val()
            const subject = $('#subject').val()
            const desc = $('#desc').val()
            const reminder = $('#reminder').is(':checked')

            const form = new FormData()
            form.append('dueDate', dueDate)
            form.append('assignTo', assignTo)
            form.append('fromDate', fromDate)
            form.append('toDate', toDate)
            form.append('type', type)
            form.append('subject', subject)
            form.append('reminder', reminder)
            form.append('desc', desc)

            axios.post('/api/reminders_api', form)
                .then((res) => {
                    swal({
                        title: "Wow!",
                        text: "Message!",
                        type: "success"
                    }).then(function() {
                        location.reload();
                    });
                })
                .catch((err) => {
                    console.log(err)
                })
        })
    </script>
</body>

</html>