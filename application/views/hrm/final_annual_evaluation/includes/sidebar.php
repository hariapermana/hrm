<ul>
    <li>
        <a href="objective" class="<?php if ($this->uri->segment(4) == 'objective') {
                                        echo 'active';
                                    } ?>">Objective</a>
    </li>
    <li class="mt-2">
        <a href="behavior" class="<?php if ($this->uri->segment(4) == 'behavior') {
                                        echo 'active';
                                    } ?>">Behavior</a>
    </li>
    <li class="mt-2">
        <a href="overall-evaluation" class="<?php if ($this->uri->segment(4) == 'overall-evaluation') {
                                                echo 'active';
                                            } ?>">Overall Evaluation</a>
    </li>
    <li class="mt-2">
        <a href="summary" class="<?php if ($this->uri->segment(4) == 'summary') {
                                        echo 'active';
                                    } ?>">Summary</a>
    </li>
</ul>
<div class="d-flex justify-content-center">
    <hr style="width: 80%; background: #fff; position: absolute; bottom: 25px;">
</div>
<div class="go-back">
    <a href="#!">back</a>
</div>