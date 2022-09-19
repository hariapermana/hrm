<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal fade" id="reminderAddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <span class="edit-title"><?php echo (isset($reminderData))?_l('reminder_edit'):_l('reminder_new'); ?></span>
                </h4>
            </div>
            <?php echo form_open_multipart(admin_url().'reminder/reminder_new/',array('id'=>'reminder-form','class'=>'_transaction_form_reminder reminder-form new_items_table','id'=>'reminder-form')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning affect-warning hide">
                            <?php echo _l('changing_items_affect_warning'); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel_s">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php $value = (isset($reminderData) ? _d($reminderData->date) : '') ?>
                                                <?php echo render_date_input('date','Due Date',$value,array('data-date-min-date'=>_d(date('Y-m-d')))); ?>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <?php 
                                                $i = 0; $selected = '';
                                                foreach($staff as $member)
                                                {
                                                    if(isset($reminderData))
                                                    {
                                                        if($reminderData->assigned_to == $member['staffid']) 
                                                        {
                                                            $selected = $member['staffid'];
                                                        }
                                                    }
                                                    $i++;
                                                }
                                                echo render_select('assigned_to',$staff,array('staffid',array('firstname','lastname')),'reminder_assigned',$selected);
                                                ?>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <div class="row">
                                                    <div class="form-group select-placeholder">
                                                        <label for="customer" class="control-label"><?php echo _l('reminder_customer'); ?></label>
                            <div class="flexer">
                                <select name="customer" id="customer"class="selectpicker" data-width="100%" data-live-search="true" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" >
                                    <option value="" <?php if((isset($proposal) &&  $proposal->rel_type == 'customer') || $this->input->get('rel_type') || !empty($rel_type)){if($rel_type == 'customer'){echo 'selected';}} ?>>
                                    </option>
                                    <?php if($customers)
                                    {
                                        foreach ($customers as $key => $v) 
                                        {
                                            $chkCust=(isset($reminderData))?$reminderData->customer:0;
                                            $val=($chkCust==$v['userid'])?'selected':'';
                                            echo "<option value='".$v['userid']."'".$val.">".$v['company']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                                                    </div> 
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-12">
                                                <div class="proposal_to_wrap">
                                                    <?php $value = (isset($reminderData) ? $reminderData->contact : '');
                                                    if(isset($reminderData) && !empty($reminderData->contact)) 
                                                    {
                                                        echo render_select('contact', $contacts, ['id', 'name'], 'contact', $reminderData->contact);
                                                    } 
                                                    ?>
                                                </div>
                                            </div> -->
                                         
                                            <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="rel_type" class="control-label"><?php echo _l('Periode'); ?></label> <br>

                                            <div class="col-md-6 start_time">

          <?php echo render_date_input('start_periode_date', 'From_Date', _d(date('Y-m-d'))) ?>
        </div>
        <div class="col-md-6 end_time">
          <?php echo render_date_input('end_periode_date', 'To_Date', _d(date('Y-m-d'))) ?>
        </div>
                                            </div>
</div>
                                          <div class="col-md-12">
                                                <div class="form-group select-placeholder">
                                                    <label for="rel_type" class="control-label"><?php echo _l('Type Reminder'); ?></label>
                                                    <select name="rel_type" id="rel_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" >
                                                        <option value=""></option>
                                                        <option value="Goals Settings" ><?php echo _l('Goals Setting'); ?></option>
                                                        <option value="Mid Year Evaluation"><?php echo _l('Mid Year Evaluation'); ?></option>
                                                        <option value="End Year Evaluation"><?php echo _l('End Year Evaluation'); ?></option>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <div class="relidwrap">
                                                    <div class="form-group select-placeholder">
                                                        <label for="rel_id" class="control-label"><?php echo _l('reminder_related_document'); ?></label>
                                                        <select name="rel_id" id="rel_id" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" >
                                                            <option></option>
                                                            <?php 
                                                            $chkRelType=(isset($reminderData))?$reminderData->rel_id:0;
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-12">
                                                <div id="otheridwrap"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="other_attachment"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="relidwrap">
                                                    <div class="form-group">
                                                    <label for="rel_type" class="control-label"><?php echo _l('Subject'); ?></label>
                                                        <?php echo render_input('subject','','','text',array('required'=>'true')); ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <?php
                                                $value = (isset($reminderData) ? _d($reminderData->description) : '');
                                                echo render_textarea('description','reminder_description',$value); ?>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-6">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" name="notify_by_sms_client" id="notify_by_sms_client">
                                                            <label for="notify_by_sms_client" value="2"><?php echo _l('rm_reminder_notify_me_by_sms_client'); ?></label>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group col-md-6">
                                                        <div class="checkbox checkbox-primary">
                                                            <input type="checkbox" name="notify_by_email_client" id="notify_by_email_client">
                                                            <label for="notify_by_email_client" value="2"><?php echo _l('rm_reminder_notify_me_by_email_client'); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo (isset($reminderData))?$reminderData->id:''; ?>">
                                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                                <button class="btn btn-info mleft5 proposal-form-submit transaction-submit-proposal" type="submit">
                                                    <?php echo _l('save_and_exit'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>