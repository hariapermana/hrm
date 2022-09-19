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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap');

        .swal-modal {
            text-align: left;
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>

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
                        <?php foreach ($inboxs as $inbox) : ?>
                            <?php if ($inbox->uniq_code == NULL) : ?>
                                <a href="<?= base_url('admin/home/inbox/' . $inbox->id . '/' . 'null') ?>">
                                <?php else : ?>
                                    <a href="<?= base_url('admin/home/inbox/' . $inbox->id . '/' . $inbox->uniq_code) ?>">
                                    <?php endif ?>
                                    <div class="card-body <?= $this->uri->segment(4) == $inbox->id ? 'active' : '' ?>">
                                        <div class="message">
                                            <h6><?= ucfirst($inbox->firstname) . ' ' . ucfirst($inbox->lastname) ?></h6>
                                            <span>KPI Goals period <?= $inbox->start_date ?> - <?= $inbox->end_date ?></span>
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
                            <h4>KPI Goals</h4>

                            <?php if (!empty($detailInbox)) : ?>
                                <?php foreach ($detailInbox as $key => $detail) : ?>
                                    <div class="mt-3 mb-3 main">
                                        <h6>Goals #<?= $key += 1 ?></h6>
                                        <table>
                                            <tr>
                                                <th>Goal</th>
                                                <td><?= $detail->subject ?></td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td><?= $detail->description ?></td>
                                            </tr>
                                            <tr>
                                                <th>Due Date</th>
                                                <td><?= $detail->end_date ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><?= $detail->status ? $detail->status : 'Not yet' ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                <?php endforeach ?>
                                <div class="mt-5 mb-3">
                                    <?php if ($goals[0]->status == 'approved') : ?>
                                        <a class="btn btn-sm btn-secondary text-light mr-2" data-toggle="modal" data-target="#meeting">Set Up a Meeting</a>
                                    <?php elseif ($goals[0]->status == 'sendback') : ?>
                                        <a class="btn btn-sm btn-warning text-light mr-2" onclick="approve('<?= $detailInbox[0]->uniq_code ?>')">Approve</a>
                                        <a class="btn btn-sm btn-secondary text-light mr-2" data-toggle="modal" data-target="#sendBack">Send Back</a>
                                    <?php elseif ($goals[0]->status == 'meet') : ?>
                                        <a class="btn btn-sm btn-secondary text-light mr-2" data-toggle="modal" data-target="#timeTable">See Timetable</a>
                                    <?php else : ?>
                                        <a class="btn btn-sm btn-warning text-light mr-2" onclick="approve('<?= $detailInbox[0]->uniq_code ?>')">Approve</a>
                                        <a class="btn btn-sm btn-secondary text-light mr-2" data-toggle="modal" data-target="#sendBack">Send Back</a>
                                    <?php endif ?>
                                </div>
                            <?php else : ?>
                                <span>No data avaible</span>
                            <?php endif ?>

                            <div class="history">
                                <h6>History</h6>
                                <div class="profile-info mt-3">
                                    <img src="<?= base_url('assets/hrm/img/profile.png') ?>" class="rounded-circle" width="40px" alt="hrd">
                                    <div class="profile-info-desc">
                                        <h6>HR Management</h6>
                                        <span>Updated performance management</span>
                                    </div>
                                </div>
                                <div class="profile-info mt-3">
                                    <img src="<?= base_url('assets/hrm/img/profile.png') ?>" class="rounded-circle" width="40px" alt="hrd">
                                    <div class="profile-info-desc">
                                        <h6>HR Management</h6>
                                        <span>Updated performance management</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="sendBack" tabindex="-1" role="dialog" aria-labelledby="sendBackLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendBackLabel">SEND BACK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formSendBack">
                    <div class="modal-body">
                        <input type="text" name="goalId" id="goalId" class="form-control" value="<?= $detailInbox[0]->uniq_code ?>" hidden>
                        <input type="text" name="to" id="to" class="form-control" value="<?= $staff[0]->staffid ?>" hidden>

                        <label for="to">To</label>
                        <input type="text" name="toPlaceholder" class="form-control" value="<?= ucfirst($staff[0]->firstname) . ' ' . ucfirst($staff[0]->lastname) ?>" readonly>

                        <label for="reason">Reason</label>
                        <textarea name="reason" id="reason" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="meeting" tabindex="-1" role="dialog" aria-labelledby="meetingLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meetingLabel">NEW MEETING</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formMeeting">
                    <div class="modal-body">
                        <input type="text" name="goalId" id="goalId" class="form-control" value="<?= $detailInbox[0]->uniq_code ?>" hidden>
                        <input type="text" name="to" id="to" class="form-control" value="<?= $staff[0]->staffid ?>" hidden>

                        <label for="to">To</label>
                        <input type="text" name="toPlaceholder" class="form-control" value="<?= ucfirst($staff[0]->firstname) . ' ' . ucfirst($staff[0]->lastname) ?>" readonly>

                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const formSendBack = $('#formSendBack')
        const sendBack = $('#sendBack')
        formSendBack.on('submit', (e) => {
            e.preventDefault()
            sendBack.modal('hide')

            const to = $('#to').val()
            const goal_id = $('#goalId').val()
            const reason = $('#reason').val()

            const form = new FormData()
            form.append('to', to)
            form.append('uniq_code', goal_id)
            form.append('reason', reason)
            form.append('status', 'sendback')

            axios.post('/api/goals_api', form)
                .then((resp) => {
                    swal({
                        title: "Success!",
                        text: "Goals has been sendback to employee!",
                        type: "success"
                    }).then(function() {
                        location.reload();
                    });
                }).catch((err) => {
                    console.log(err)
                })
        })

        const formMeeting = $('#formMeeting')
        const meeting = $('#meeting')
        formMeeting.on('submit', (e) => {
            e.preventDefault()
            meeting.modal('hide')

            const to = $('#to').val()
            const goal_id = $('#goalId').val()
            const desc = $('#desc').val()

            const form = new FormData()
            form.append('to', to)
            form.append('uniq_code', goal_id)
            form.append('desc', desc)
            form.append('status', 'meet')

            axios.post('/api/goals_api', form)
                .then((resp) => {
                    swal({
                        title: "Success!",
                        text: "The meeting has notified to employee!",
                        type: "success"
                    }).then(function() {
                        location.reload();
                    });
                }).catch((err) => {
                    console.log(err)
                })
        })

        function approve(uniq_code) {
            const form = new FormData()
            form.append('uniq_code', uniq_code)
            form.append('status', 'approved')

            axios.post('/api/goals_api', form)
                .then((res) => {
                    swal({
                        title: "Success!",
                        text: "Goals Approved!",
                        type: "success"
                    }).then(function() {
                        location.reload();
                    });
                })
                .catch((e) => {
                    console.log(e)
                })
            console.log(uniq_code)
        }
    </script>
</body>

</html>