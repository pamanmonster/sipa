<body data-theme="colored" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
        <?php if ($this->session->flashdata('flash')): ?>
			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
		<?php endif; ?>
		<div class="wrapper">
            <!-- Sidebar -->
            <?php $this->load->view("appstack/sidebar.php", $menus) ?>
            <!-- End of Sidebar -->
			<div class="main">
                <!-- Navbar -->
                <?php $this->load->view("appstack/navbar.php") ?>
                <!-- End of Navbar -->
                <main class="content">
					<div class="container-fluid p-0">