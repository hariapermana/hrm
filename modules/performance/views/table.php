<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    'CONCAT(firstname," ", lastname)',
    'strategy',
    'description',
    'end_date',
    'weight',
    'target',
];

$sIndexColumn = 'id';
$sTable       = db_prefix() . 'goals';

$join = ['LEFT JOIN ' . db_prefix() . 'staff ON ' . db_prefix() . 'staff.staffid = ' . db_prefix() . 'goals.staff_id'];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, [], ['id']);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'CONCAT(firstname," ", lastname)') {
            $_data = '<a href="' . admin_url('performance/goal/' . $aRow['id']) . '">' . $_data . '</a>';
            $_data .= '<div class="row-options">';
            $_data .= '<a href="' . admin_url('performance/goal/' . $aRow['id']) . '">' . _l('view') . '</a>';

            if (has_permission('performance', '', 'delete')) {
                $_data .= ' | <a href="' . admin_url('performance/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
            }
            $_data .= '</div>';
        } elseif ($aColumns[$i] == 'start_date' || $aColumns[$i] == 'end_date') {
            $_data = _d($_data);
        } elseif ($aColumns[$i] == 'goal_type') {
            $_data = format_goal_type($_data);
        }
        $row[] = $_data;
    }
    ob_start();
    $achievement          = $this->ci->goals_model->calculate_goal_achievement($aRow['id']);
    $percent              = $achievement['percent'];
    $progress_bar_percent = $achievement['progress_bar_percent']; ?>
    <input type="hidden" value="<?php
    echo $progress_bar_percent; ?>" name="percent">
    <div class="goal-progress" data-reverse="true">
       <strong class="goal-percent"><?php
        echo $percent; ?>%</strong>
    </div>
    <?php
    $progress = ob_get_contents();
    ob_end_clean();
    $row[]              = $progress;
    $row['DT_RowClass'] = 'has-row-options';
    $output['aaData'][] = $row;
}
