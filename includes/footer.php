<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h5 class="call-us">Questions? <strong>Appler 0850-380-6444</strong></h5>
				<div class="language"> <i class="lni lni-world"></i>
					<select>
						<option>Français</option>
						<option>English</option>
					</select>
				</div>
				<!-- end language -->
			</div>
			<!-- end col-4 -->
			<div class="col-lg-2 offset-lg-1 col-md-4">
				<h6 class="widget-title">Contact</h6>
				<ul class="footer-menu">
					<li><a href="#">Nous contacter</a></li>
					<li><a href="#">Promotions</a></li>
				</ul>
			</div>
			<!-- end col-4 -->
			<div class="col-lg-2 col-md-4">
				<h6 class="widget-title">SUPPORT</h6>
				<ul class="footer-menu">
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Assistance</a></li>
					<li><a href="#">Support technique</a></li>
				</ul>
			</div>
			<!-- end col-4 -->
			<div class="col-lg-2 col-md-4">
				<h6 class="widget-title">Termes et conditions</h6>
				<ul class="footer-menu">
					<li><a href="#">Confidentialité</a></li>
					<li><a href="#">Termes&nbsp;et&nbsp;conditions</a></li>
					<li><a href="#">Mentions légales</a></li>
				</ul>
			</div>
			<!-- end col-4 -->
		</div>
		<!-- end row -->
	</div>
	<!-- end container -->
	<div class="bottom-bar">
		<div class="container"> <span>© <?php echo date("Y") ?> DFilm | Streaming de vidéos en ligne</span>
		</div>
		<!-- end container -->
	</div>
	<!-- end bottom-bar -->
</footer>
<!-- end footer -->
</main>

<!-- JS FILES -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/bootstrap-datepicker.fr.min.js"></script>
<script src="assets/js/swiper.min.js"></script>
<script src="assets/js/fancybox.min.js"></script>
<script src="assets/js/scripts.js"></script>
<?php
$current_file = $_SERVER["REQUEST_URI"];
if (preg_match("/catalogue/", $current_file)) {
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>';
	echo '<script src="assets/js/jquery.dfilm.js"></script>';
	echo '<script>
		jQuery.dfilm.init();
	</script>';
}
?>
</body>

</html>