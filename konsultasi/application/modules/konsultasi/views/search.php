<!-- start:content -->
<div class="container content content-single content-dashboard content-konsultasi">
    <section id="content">

        <!-- start:content -->
        <div class="content-konsultasi-main">
            <div class="content-konsultasi-title">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Konsultasi <small>Anda bisa membuka atau melihat tiket konsultasi yang pernah anda kirim disini...</small></h2>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-heading">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="content-konsultasi-heading-left">
                            <form action="<?php echo site_url('konsultasi/search') ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for..." name="search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit" value="cari">Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                        <div class="content-konsultasi-heading-right pull-right">
                            <a href="<?php echo site_url('konsultasi/create') ?>" class="btn btn-open-tiket">Mulai Konsultasi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-konsultasi-table">
                <p>10 Data ditemukan, Halaman 1 dari 1</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Kategori</th>
                          <th>Konsultasi Title</th>
                          <th>Tanggal Konsultasi</th>
                          <th>Update Terakhir</th>
                          <th>Status</th>
                          <th>Lihat Konsultasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row) : ?>
                        <tr>
                            <th scope="row"><?php echo $row->id ?></th>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->subjek ?></td>
                            <td><?php echo $row->created_at ?></td>
                            <td><?php echo $row->updated_at ?></td>
                            <td>
                            	<?php  $checked = ($row->status == "open") ? 'checked' : ''; ?>
		                        <p><input id="switch-size" type="checkbox" <?php echo $checked?> data-size="mini" data-taskid="<?php echo $row->id; ?>" name="my-checkbox" class="switch-status"></p>                         
                            	<input id="result" type="hidden">
                            </td>
                            <td class="text-xs-center">
                                <a href="<?php echo site_url('konsultasi/detail/'. $row->id) ?>"><span class="label label-default">Lihat</span></a>
                                <a href="<?php echo site_url('konsultasi/update/'. $row->id) ?>"><span class="label label-primary">Update</span></a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <form method="post" action="<?php echo site_url('konsultasi/setLimit') ?>">
                    <select class="c-select" name="limit" onchange="this.form.submit()">
                        <option selected>Hasil perhalaman</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </form>
                <nav>
                    <ul class="pager">
                        <?php echo $results->render() ?>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- end:content -->

    </section>

</div>
<!-- emd:content -->
<?php custom_stylesheet() ?>
	<link rel="stylesheet" href="<?php echo asset('plugins/bootstrap-switch/css/bootstrap-switch.css') ?>">
<?php endcustom_stylesheet() ?>

<?php custom_script() ?>
<!-- start:switch -->
    <script src="<?php echo asset('plugins/bootstrap-switch/js/highlight.js') ?>"></script>
    <script src="<?php echo asset('plugins/bootstrap-switch/js/bootstrap-switch.js') ?>"></script>
    <script src="<?php echo asset('plugins/bootstrap-switch/js/main.js') ?>"></script>
<!-- end:switch -->

<script type="text/javascript">
	$(document).ready(function () {
		$('.switch-status').on('switchChange.bootstrapSwitch', function (event, state) {
			var id = $(this).attr("data-taskid")
			var status = state ? "open" : "close"

			$.ajax({
                url: '<?php echo site_url("konsultasi/check"); ?>',
                data: {
                    id: id,
                    status: status,
                },
                success: function (response) {
                    alert('konsultasi telah di '+status)
                }
            });
		})
	})
</script>

<?php endcustom_script() ?>
