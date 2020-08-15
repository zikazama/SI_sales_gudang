<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('_partials/header'); ?>

<body>
	<div class='loader'>
		<div class='spinner-grow text-primary' role='status'>
			<span class='sr-only'>Loading...</span>
		</div>
	</div>
	<div class="connect-container align-content-stretch d-flex flex-wrap">
		<?php $this->load->view('_partials/sidebar'); ?>
		<div class="page-container">
			<?php $this->load->view('_partials/navbar'); ?>
			<?php $this->load->view($konten); ?>
			<?php $this->load->view('_partials/footer'); ?>
		</div>

	</div>

	<?php $this->load->view('_partials/js'); ?>
	<?php if(isset($js)) {
		$this->load->view($js); 
	} ?>
</body>

</html>
