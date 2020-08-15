<div class="page-header">
				<nav class="navbar navbar-expand">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<ul class="navbar-nav">
						<li class="nav-item small-screens-sidebar-link">
							<a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
						</li>
						<li class="nav-item nav-profile dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php if($this->session->userdata('role') == 'sales') { 
									if($this->session->userdata('foto') == null) {
									?>
										<img src="<?= base_url() ?>assets/images/avatars/user.svg" alt="profile image">
								<?php 
									} else { ?>
										<img src="<?= base_url() ?>upload/sales/<?= $this->session->userdata('foto') ?>" alt="profile image">
								<?php	}} else if($this->session->userdata('role') == 'admin') { 
									if($this->session->userdata('foto') == null) {
									?>
									<img src="<?= base_url() ?>assets/images/avatars/user.svg" alt="profile image">
								<?php 
									} else { ?>
									<img src="<?= base_url() ?>upload/admin/<?= $this->session->userdata('foto') ?>" alt="profile image">
								<?php }} ?>
								<span><?= $this->session->userdata('nama') ?></span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php if($this->session->userdata('role') == 'sales') { ?>
								<a class="dropdown-item" href="<?= base_url('setting') ?>">Settings</a>
								<?php } else if($this->session->userdata('role') == 'admin') { ?>
								<a class="dropdown-item" href="<?= base_url('admin/setting') ?>">Settings Admin</a>
								<?php } ?>
								<div class="dropdown-divider"></div>
								<?php if($this->session->userdata('role') == 'admin') { ?>
									<a class="dropdown-item" href="<?= base_url('admin/login/aksi_logout') ?>">Log out</a>
									<?php } else { ?>
								<a class="dropdown-item" href="<?= base_url('login/aksi_logout') ?>">Log out</a>
								<?php } ?>
							</div>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link" id="dark-theme-toggle"><i
									class="material-icons-outlined">brightness_2</i><i
									class="material-icons">brightness_2</i></a>
						</li>
					</ul>
					
					<!-- <div class="navbar-search">
						<form>
							<div class="form-group">
								<input type="text" name="search" id="nav-search" placeholder="Search...">
							</div>
						</form>
					</div> -->
				</nav>
			</div>