<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/hrm/css/goals.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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
                    <a href="objectives">Objective</a>
                </li>
                <li class="mt-2">
                    <a href="behavior">Behavior</a>
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
                <div class="card-body">
                    <div id="accordion">
                        <form id="goalsForm">
                            <div class="card">
                                <div class="control-group after-add-more">
                                    <?php if (!empty($goals)) : ?>
                                        <?php foreach ($goals as $key => $g) : ?>
                                            <?php $key += 1 ?>
                                            <div class="card-header" id="heading">
                                                <h5 class="mb-0">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse">
                                                        Goals #<?= $key ?>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?= $key ?>" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
                                                <div class="card-body">
                                                    <label for="sasaran">Sasaran Strategis</label>
                                                    <input type="text" class="form-control sasaran-js" value="<?= $g->strategy ?>" name="sasaran[]">

                                                    <label for="kpi" class="mt-2">Key Performance Indicator</label>
                                                    <textarea name="kpi[]" class="form-control kpi-js"><?= $g->description ?></textarea>

                                                    <label for="bobot" class="mt-2">Bobot</label>
                                                    <input type="text" class="form-control bobot-js w-50" name="bobot[]" value="<?= $g->weight ?>">

                                                    <label for="target" class="mt-2">Target</label>
                                                    <input type="text" class="form-control target-js w-50" name="target[]" value="<?= $g->target ?>">

                                                    <label for="dueDate" class="mt-2">Due Date</label>
                                                    <input type="date" name="dueDate[]" class="form-control due-date-js w-25" value="<?= $g->end_date ?>">

                                                    <input type="text" name="uniqCode[]" class="form-control uniq-code-js w-25" value="<?= $g->uniq_code ?>" hidden>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <div class="card-header" id="heading">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                                    Goals #1
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapse" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
                                            <div class="card-body">
                                                <label for="sasaran">Sasaran Strategis</label>
                                                <input type="text" class="form-control sasaran-js" name="sasaran[]">

                                                <label for="kpi" class="mt-2">Key Performance Indicator</label>
                                                <textarea name="kpi[]" class="form-control kpi-js"></textarea>

                                                <label for="bobot" class="mt-2">Bobot</label>
                                                <input type="text" class="form-control bobot-js w-50" name="bobot[]">

                                                <label for="target" class="mt-2">Target</label>
                                                <input type="text" class="form-control target-js w-50" name="target[]">

                                                <label for="dueDate" class="mt-2">Due Date</label>
                                                <input type="date" name="dueDate[]" class="form-control due-date-js w-25">

                                                <input type="text" name="uniqCode[]" class="form-control uniq-code-js w-25" value="<?= $uCode ?>" hidden>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="container ml-3 collapse show">
                                    <button type="button" class="btn btn-sm btn-primary add-more mt-3">Add</button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-warning ml-4 mt-4">Go to Summary</button>

                            <div class="card copy d-none">
                                <div class="control-group">
                                    <div class="card-header" id="heading">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseCopy" aria-expanded="true" aria-controls="collapse">
                                                <span id="ini"></span>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseCopy" class="collapse show" aria-labelledby="heading" data-parent="#accordion">
                                        <div class="card-body">
                                            <label for="sasaran">Sasaran Strategis</label>
                                            <input type="text" class="form-control sasaran-js" name="sasaran[]">

                                            <label for="kpi" class="mt-2">Key Performance Indicator</label>
                                            <textarea name="kpi[]" class="form-control kpi-js"></textarea>

                                            <label for="bobot" class="mt-2">Bobot</label>
                                            <input type="text" class="form-control bobot-js w-50" name="bobot[]">

                                            <label for="target" class="mt-2">Target</label>
                                            <input type="text" class="form-control target-js w-50" name="target[]">

                                            <label for="dueDate" class="mt-2">Due Date</label>
                                            <input type="date" name="dueDate[]" class="form-control due-date-js w-25">

                                            <button type="button" class="btn btn-sm btn-primary add-more mt-3">Add</button>
                                            <button type="button" class="btn btn-sm btn-danger remove mt-3">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/hrm/js/main.js') ?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let i = <?= count($goals) ?>;
            // add form
            $("body").on("click", ".add-more", function(e) {
                i++
                $('#ini').text('Goals #' + i)

                let btn = $('.copy').find('[data-target="#collapseCopy"]')
                let card = $('.copy').find('#collapseCopy')
                btn.attr('data-target', `#collapseCopy${i}`)
                card.attr('id', `collapseCopy${i}`)

                let html = $(".copy").html();
                $(".after-add-more").after(html);
            })

            // remove form
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
                i--
            });
        });

        $('#goalsForm').on('submit', (e) => {
            e.preventDefault()

            const uniqCode = $('.uniq-code-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const sasaran = $('.sasaran-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const kpi = $('.kpi-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const bobot = $('.bobot-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const target = $('.target-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const dueDate = $('.due-date-js').map(function(idx, elem) {
                if ($(elem).val() != '') {
                    return $(elem).val();
                }
            }).get();

            const form = new FormData()
            form.append('uniqCode', uniqCode)
            form.append('sasaran', sasaran)
            form.append('kpi', kpi)
            form.append('bobot', bobot)
            form.append('target', target)
            form.append('dueDate', dueDate)
            form.append('requestType', 'temp')

            axios.post('/api/summary_api', form)
                .then((resp) => {
                    swal({
                        title: "Success!",
                        text: "You will be redirected to Summary Page!",
                        icon: "success"
                    }).then(function() {
                        const url = uniqCode[0]
                        window.location.href = "/admin/testing/summary/" + url
                    })
                })
                .catch((e) => {
                    swal({
                        title: "Kesalahan!",
                        text: "Please re-check your fill!",
                        icon: "error"
                    })
                })
        })
    </script>
</body>

</html>