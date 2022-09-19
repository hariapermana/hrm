<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                     <?php if(has_permission('goals','','create')){ ?>
                     <div class="_buttons">
                        <a href="<?php echo admin_url('performance/goal'); ?>" class="btn btn-info pull-left display-block"><?php echo _l('add goal'); ?></a>
                    </div>
                    <div class="clearfix"></div>
                    <hr class="hr-panel-heading" />
                    <?php } ?>
                    <?php render_datatable(array(
                        _l('staff_member'),
                        _l('Target Strategy'),
                        _l('Key Performance Indicators'),
                        _l('Due Date'),
                        _l('Weight'),
                        _l('Target'),
                        _l('goal_progress'),
                        ),'goals'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script>
    $(function(){
        initDataTable('.table-goals', window.location.href, [6], [6]);
        $('.table-goals').DataTable().on('draw', function() {
            var rows = $('.table-goals').find('tr');
            $.each(rows, function() {
                var td = $(this).find('td').eq(6);
                var percent = $(td).find('input[name="percent"]').val();
                $(td).find('.goal-progress').circleProgress({
                    value: percent,
                    size: 45,
                    animation: false,
                    fill: {
                        gradient: ["#28b8da", "#059DC1"]
                    }
                })
            })
        })
    });
</script>
</body>
</html>
