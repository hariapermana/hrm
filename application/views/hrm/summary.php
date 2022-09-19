<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/summary.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/hrm/js/bootstrap.bundle.min.js"></script>

    <title>Summary</title>
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
                            <img src="<?= base_url() ?>assets/hrm/img/nav/grid.svg" width="24px" alt="nav" />
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <div class="notification">
                                <img src="<?= base_url() ?>assets/hrm/img/nav/bell.svg" width="24px" alt="nav" />
                                <span>1</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="inbox">
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

    <div class="d-flex">
        <div class="sidebar">
            <ul>
                <li>
                    <a href="#!">Objective</a>
                </li>
                <li class="mt-2">
                    <a href="#!">Behavior</a>
                </li>
            </ul>
            <div class="d-flex justify-content-center">
                <hr style="width: 80%; background: #fff; position: absolute; bottom: 25px;">
            </div>
            <div class="go-back">
                <a href="#!">back</i></a>
            </div>
        </div>

        <div class="main">
            <div class="card border-0">
                <div class="card-body m-4">
                    <h5 class="kpi-title">KPI Goals</h5>
                    <?php foreach ($goals as $key => $g) : ?>
                        <div class="mt-3 mb-3">
                            <h6>Goals #<?= $key += 1 ?></h6>
                            <table>
                                <tr>
                                    <th>Goal</th>
                                    <td><?= $g->subject ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?= $g->description ?></td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td><?= $g->end_date ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>xxx</td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach ?>
                    <button class="btn btn-sm btn-warning mt-4" onclick="submit(this)" uniq-code="<?= $goals[0]->uniq_code ?>">Submit</button>
                    <button class="btn btn-sm btn-secondary mt-4" onclick="draft(this)" uniq-code="<?= $goals[0]->uniq_code ?>">Save for Later</button>
                    <button onclick="hapus(this)" uniqcode="<?= $goals[0]->uniq_code ?>" class="btn btn-sm btn-secondary mt-4">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function hapus(data)
        {
            const uniqCode = data.getAttribute('uniqcode')
            const form = new FormData()
            form.append('uniqCode', uniqCode)
            form.append('requestType', 'delete')

            axios.post('/api/summary_api', form)
            .then((res) => {
                window.location.href = '/admin/testing/inbox'
            })
            .catch((err) => {
                console.log(err)
            })
        }

        function submit(data) 
        {
            const uniqCode = data.getAttribute('uniq-code')
            const form = new FormData()

            form.append('uniqCode', uniqCode)
            form.append('requestType', 'approve')

            axios.post('/api/summary_api', form)
            .then((res) => {
                console.log(res.data)
            })
            .catch((err) => {
                console.log(err)
            })   
        }

        function draft(data)
        {
            const uniqCode = data.getAttribute('uniq-code')
            const form = new FormData()
            form.append('uniqCode', uniqCode)
            form.append('requestType', 'draft')

            axios.post('/api/summary_api', form)
            .then((res) => {
                console.log(res.data)
            })
            .catch((err) => {
                console.log(err)
            })
        }
    </script>
</body>

</html>