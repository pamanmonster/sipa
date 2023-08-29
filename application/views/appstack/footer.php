</div>
				</main>

				<footer class="footer">
					<div class="container-fluid">
						<div class="row text-muted">
							<div class="col-6 text-start">
								<ul class="list-inline">
									<li class="list-inline-item">
										<a class="text-muted" href="#">Support</a>
									</li>
									<li class="list-inline-item">
										<a class="text-muted" href="#">Help Center</a>
									</li>
									<li class="list-inline-item">
										<a class="text-muted" href="#">Privacy</a>
									</li>
									<li class="list-inline-item">
										<a class="text-muted" href="#">Terms of Service</a>
									</li>
								</ul>
							</div>
							<div class="col-6 text-end">
								<p class="mb-0">
									&copy; 2023 - <a href="index.html" class="text-muted">Admin OMI - Koperasi Pegawai Telkom Yogyakarta</a>
								</p>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>		

		<script src="<?= base_url('assets/appstack/js/app.js') ?>"></script>
		<script src="https://cdn.datatables.net/v/bs4/dt-1.12.1/fc-4.1.0/fh-3.2.4/datatables.min.js" type="text/javascript" ></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>
		<script src="<?= base_url('assets/vendor/jQuery-File-Upload/js/vendor/jquery.ui.widget.js') ?>"></script>
		<script src="<?= base_url('assets/vendor/jQuery-File-Upload/js/jquery.iframe-transport.js') ?>"></script>
		<script src="<?= base_url('assets/vendor/jQuery-File-Upload/js/jquery.fileupload.js') ?>"></script>
		<script src="<?= base_url('assets/vendor/select2/js/select2.min.js') ?>"></script>
		<script>const base_url = '<?php echo base_url() ?>';</script>
		<script src="<?= base_url('assets/js/sipa.js') ?>"></script>
		<?php 
			if (isset($view)) {
				$js = $view;
					// if(($pos = strpos($view, "/")) !== FALSE) {
					// 	$js = substr($view, $pos + 1);
					// }
 				?>				
				<script src="<?= base_url('assets/js/' . $js . '.js')?>"></script>
		<?php }?>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Bar chart
				new Chart(document.getElementById("chartjs-dashboard-bar"), {
					type: "bar",
					data: {
						labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
						datasets: [{
							label: "Last year",
							backgroundColor: window.theme.primary,
							borderColor: window.theme.primary,
							hoverBackgroundColor: window.theme.primary,
							hoverBorderColor: window.theme.primary,
							data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
							barPercentage: .325,
							categoryPercentage: .5
						}, {
							label: "This year",
							backgroundColor: window.theme["primary-light"],
							borderColor: window.theme["primary-light"],
							hoverBackgroundColor: window.theme["primary-light"],
							hoverBorderColor: window.theme["primary-light"],
							data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
							barPercentage: .325,
							categoryPercentage: .5
						}]
					},
					options: {
						maintainAspectRatio: false,
						cornerRadius: 15,
						legend: {
							display: false
						},
						scales: {
							yAxes: [{
								gridLines: {
									display: false
								},
								ticks: {
									stepSize: 20
								},
								stacked: true,
							}],
							xAxes: [{
								gridLines: {
									color: "transparent"
								},
								stacked: true,
							}]
						}
					}
				});
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				$("#datetimepicker-dashboard").datetimepicker({
					inline: true,
					sideBySide: false,
					format: "L"
				});
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Pie chart
				new Chart(document.getElementById("chartjs-dashboard-pie"), {
					type: "pie",
					data: {
						labels: ["Direct", "Affiliate", "E-mail", "Other"],
						datasets: [{
							data: [2602, 1253, 541, 1465],
							backgroundColor: [
								window.theme.primary,
								window.theme.warning,
								window.theme.danger,
								"#E8EAED"
							],
							borderWidth: 5,
							borderColor: window.theme.white
						}]
					},
					options: {
						responsive: !window.MSInputMethodContext,
						maintainAspectRatio: false,
						cutoutPercentage: 70,
						legend: {
							display: false
						}
					}
				});
			});
		</script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				$("#datatables-dashboard-projects").DataTable({
					pageLength: 6,
					lengthChange: false,
					bFilter: false,
					autoWidth: false
				});
			});
		</script>

	</body>


	<!-- Mirrored from appstack.bootlab.io/dashboard-default.html?theme=default by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Dec 2022 15:25:37 GMT -->

	</html>