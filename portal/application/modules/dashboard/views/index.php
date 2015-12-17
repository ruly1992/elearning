<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.css">
<div class="row">
    <div class="col-md-12">
        <div class="content-articles">
            <p>Untuk mempublish artikel, silahkan menggunakan link di bawah ini.</p>
            <a class="btn btn-primary" href="<?php echo site_url('dashboard/sendArticle') ?>"><i class="fa fa-send"></i> Buat Artikel</a>

            <hr>

            <p>Untuk upload library, silahkan menggunakan link di bawah ini.</p>
            <a class="btn btn-primary" href="<?php echo elib_url('media') ?>"><i class="fa fa-upload"></i> Upload Library</a>
        </div>
    </div>
</div>
<div class="row">    
    <div class="col-md-6">
        <!-- start:section content main articles -->
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Profile</h3>
            </div>
            <table class="table">
            <tbody>
                <tr>
                    <?php if (auth()->getUser()->profile->avatar): ?>
                        <img class="featured-preview" src="<?php echo base_url("portal/assets/upload/avatar/")."/".auth()->getUser()->profile->avatar ?>" width="100%">
                        <img class="featured-preview-default" src="<?php echo asset('images/default_avatar_male.jpg') ?>" style="display: none;">
                    <?php else: ?>
                        <img class="featured-preview" src="" width="100%" style="display: none;">
                        <img class="featured-preview-default" src="<?php echo asset('images/default_avatar_male.jpg') ?>">
                    <?php endif ?>
                    <input type="hidden" name="avatar" value="<?php echo auth()->getUser()->profile->avatar ?>">
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><?php echo auth()->getUser()->full_name ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?php echo auth()->getUser()->profile->gender ?></td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td><?php echo auth()->getUser()->profile->tempat_lahir ?>, <?php echo auth()->getUser()->profile->tanggal_lahir ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?php echo auth()->getUser()->profile->address ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo auth()->getUser()->email ?></td>
                </tr>
            </tbody>
          </table>
        </section>
        <!-- end:section content main articles -->
    </div>
   
</div>
<div class="row">
     <div class="col-md-12">
        <!-- start:section content main articles -->
        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Artikel Draft</h3>
            </div>
            <table class="table table-hover table-bordered" id="article">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Waktu Terbit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($drafts as $draft): ?>
                    <tr>
                        <td><?php echo $draft->id ?></td>
                        <td><?php echo $draft->title ?></td>
                        <td><?php echo $draft->getStatusLabel() ?></td>
                        <td><?php echo $draft->date ?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="<?php echo site_url('dashboard/editArticle/'. $draft->id) ?>"><i class="fa fa-save"></i> Update</a>
                            <a class="btn btn-sm btn-danger" href="<?php echo site_url('dashboard/delete/'. $draft->id) ?>"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
        </table>
        <?php echo $artikel->render() ?>
        </section> 

        <section class="content-articles">
            <div class="content-articles-heading">
                <h3>Artikel Submit</h3>
            </div>
            <table class="table table-hover table-bordered" id="publish">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Waktu Terbit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artikel as $row): ?>
                    <tr>
                        <td><?php echo $row->id ?></td>
                        <td><?php echo $row->title ?></td>
                        <td><?php echo $row->getStatusLabel() ?></td>
                        <td><?php echo $row->date ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
        </table>
        <?php echo $artikel->render() ?>
        </section>        
    </div>
</div>

<?php custom_script() ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#article').DataTable();
        } );

        $(document).ready(function() {
            $('#publish').DataTable();
        } );
    </script>
<?php endcustom_script() ?>
