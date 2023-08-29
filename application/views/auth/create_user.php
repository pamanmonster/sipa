<div class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title"><?php echo lang('create_user_heading'); ?></h5>
				<h6 class="card-subtitle text-muted"><?php echo lang('create_user_subheading'); ?></h6>
			</div>
			<div id="infoMessage"><?php echo $message; ?></div>
			<div class="card-body">
				<?php echo form_open("auth/create_user"); ?>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_fname_label', 'first_name'); ?></label>
					<?php echo form_input($first_name); ?>
				</div>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_lname_label', 'last_name'); ?></label>
					<?php echo form_input($last_name); ?>
				</div>
				<?php if ($identity_column !== 'email') { ?>
					<div class="mb-3">
						<label class="form-label">Username</label>
						<?php echo form_input($identity); ?>
					</div>
				<?php } ?>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_company_label', 'company'); ?></label>
					<?php echo form_input($company); ?>
				</div>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_email_label', 'email'); ?></label>
					<?php echo form_input($email); ?>
				</div>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_phone_label', 'phone'); ?></label>
					<?php echo form_input($phone); ?>
				</div>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_password_label', 'password'); ?></label>
					<?php echo form_input($password); ?>
				</div>
				<div class="mb-3">
					<label class="form-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?></label>
					<?php echo form_input($password_confirm); ?>
				</div>
				<div class="text-right">
					<input type="submit" class="btn btn-pill btn-primary" value="Simpan"/>
					<input type="reset" class="btn btn-pill btn-danger" value="Reset">
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
