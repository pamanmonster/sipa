<?php $this->load->view("appstack/header.php") ?>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
  <div class="main d-flex justify-content-center w-100">
    <main class="content d-flex p-0">
      <div class="container d-flex flex-column">
        <div class="row h-100">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

              <div class="text-center mt-4">
                <h1 class="h2"><?php echo lang('login_heading'); ?></h1>
                <p class="lead">
                  <?php echo lang('login_subheading'); ?>
                </p>
              </div>

              <div class="card">
                <div class="card-body">
                  <div class="m-sm-4">
                    <div class="text-center">
                      <img src="<?= base_url('assets/img/logo.png')?>" alt="SIPA" class="img-fluid rounded-circle" width="80" height="80" />
                    </div>
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open("auth/login"); ?>
                      <div class="mb-3">
                        <label class="form-label"><?php echo lang('login_identity_label', 'identity'); ?></label>
                        <?php echo form_input($identity); ?>
                      </div>
                      <div class="mb-3">
                        <label class="form-label"><?php echo lang('login_password_label', 'password'); ?></label>
                        <?php echo form_input($password); ?>
                        <small>
                          <a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>
                        </small>
                      </div>
                      <div>
                        <div class="form-check align-items-center">
                          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                          <label class="form-check-label text-small" for="customControlInline"><?php echo lang('login_remember_label', 'remember'); ?></label>
                        </div>
                      </div>
                      <div class="text-center mt-3">
                        <!-- <a href="dashboard-default.html" class="btn btn-lg btn-primary">Sign in</a> -->
                        <?php echo form_submit('submit', lang('login_submit_btn'), array("class"=>"btn btn-lg btn-primary")); ?>
                      </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="<?= base_url('assets/appstack/js/app.js') ?>"></script>
</body>
</html>