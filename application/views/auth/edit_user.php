<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?php echo lang('edit_user_heading'); ?></h5>
                <h6 class="card-subtitle text-muted"><?php echo lang('edit_user_subheading'); ?></h6>
            </div>
            <div id="infoMessage"><?php echo $message; ?></div>
            <div class="card-body">
                <?php echo form_open(uri_string()); ?>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_fname_label', 'first_name'); ?></label>
                    <?php echo form_input($first_name); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_lname_label', 'last_name'); ?></label>
                    <?php echo form_input($last_name); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_company_label', 'company'); ?></label>
                    <?php echo form_input($company); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_phone_label', 'phone'); ?></label>
                    <?php echo form_input($phone); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_password_label', 'password'); ?></label>
                    <?php echo form_input($password); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?></label>
                    <?php echo form_input($password_confirm); ?>
                </div>
                <?php if ($this->ion_auth->is_admin()) : ?>
                    <div class="mb-3">
                        <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                        <?php foreach ($groups as $group) : ?>
                            <div>
                                <label class="checkbox">
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <?php echo form_hidden('id', $user->id); ?>
                <?php echo form_hidden($csrf); ?>
                <div class="text-right">
                    <input type="submit" class="btn btn-pill btn-primary" value="Simpan" />
                    <input type="reset" class="btn btn-pill btn-danger" value="Reset">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>