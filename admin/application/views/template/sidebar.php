<!-- start: Main Menu -->
<div class="sidebar">

	<div class="sidebar-collapse">

		<div class="sidebar-header">

			<img src="<?php echo auth()->getUser()->avatar ?>">

			<h2><?php echo auth()->getUser()->full_name ?></h2>
			<h3><?php echo auth()->getUser()->email ?></h3>

		</div>

		<div class="sidebar-menu">	
			<ul class="nav nav-sidebar">
				<li><a href="<?php echo site_url() ?>"><i class="icon-home "></i><span class="text">Statistik</span></a></li>	
				<li>
					<a href="#"><i class="icon-note"></i><span class="text">Artikel</span> <span class="indicator"></span></a>
					<ul>
						<li><a href="<?php echo site_url('article') ?>"><i class="icon-note"></i><span class="text">Terbit</span></a></li>
						<li><a href="<?php echo site_url('article?status=draft') ?>"><i class="icon-note"></i><span class="text">Draft</span></a></li>
						<li><a href="<?php echo site_url('kategori') ?>"><i class="icon-calculator"></i><span class="text">Kategori</span></a></li>
					</ul>
				</li>
				<li><a href="<?php echo site_url('pages') ?>"><i class="fa fa-book"></i><span class="text">Page</span></a></li>
				<li><a href="<?php echo site_url('comment') ?>"><i class="fa fa-comment"></i><span class="text">Komentar</span></a></li>
				<li><a href="<?php echo site_url('media') ?>"><i class="icon-picture"></i><span class="text">Media</span></a></li>
				<li>
					<a href="#"><i class="fa fa-upload"></i><span class="text">Elibrary</span> <span class="indicator"></span></a>
					<ul>
						<li><a href="<?php echo site_url('elibrary') ?>"><i class="icon-note"></i><span class="text">Terbit</span></a></li>
						<li><a href="<?php echo site_url('elibrary?status=draft') ?>"><i class="icon-note"></i><span class="text">Draft</span></a></li>
						<li><a href="<?php echo site_url('elibrary/category') ?>"><i class="icon-calculator"></i><span class="text">Kategori</span></a></li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-book"></i><span class="text">Konsultasi</span> <span class="indicator"></span></a>
					<ul>
						<li><a href="<?php echo site_url('konsultasi') ?>"><i class="icon-note"></i><span class="text">Konsultasi</span></a></li>
						<li><a href="<?php echo site_url('konsultasi/kategori') ?>"><i class="icon-note"></i><span class="text">Kategori Konsultasi</span></a></li>
						<li><a href="<?php echo site_url('konsultasi/pengampu') ?>"><i class="icon-note"></i><span class="text">Pengampu Konsultasi</span></a></li>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-book"></i><span class="text">Forum</span> <span class="indicator"></span></a>
					<ul>
						<li><a href="<?php echo site_url('forum/pengampu') ?>"><i class="icon-note"></i><span class="text">Moderator</span></a></li>
						<li><a href="<?php echo site_url('forum/kategori') ?>"><i class="icon-note"></i><span class="text">Kategori Forum</span></a></li>
					</ul>
				</li>
				<li><a href="<?php echo site_url('user') ?>"><i class="icon-users"></i><span class="text">Pengguna</span></a></li>
				<li><a href="<?php echo site_url('link') ?>"><i class="fa fa-link"></i><span class="text">Link Informasi Desa</span></a></li>
				<li><a href="<?php echo site_url('settings') ?>"><i class="icon-settings"></i><span class="text">Setting</span></a></li>

			</ul>
		</div>					
	</div>
	<div class="sidebar-footer">
		
	</div>	
</div>
<!-- end: Main Menu -->