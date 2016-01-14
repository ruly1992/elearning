<!-- start: Content -->
<div class="myflot flot-visitor">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Visitor</h3>
            <div id="daterange" class="flot-daterange selectbox pull-right hidden-xs">
                <i class="icon-calendar"></i>
                <span><?php echo Carbon\Carbon::today()->format('F d, Y') ?> - <?php echo Carbon\Carbon::today()->format('F d, Y') ?></span> <b class="caret"></b>
            </div>
        </div>
        <div class="panel-body">
            <div id="chart-visitor" class="flot-content center" style="height:300px;" data-json="<?php echo site_url('api/visitor') ?>"></div>
        </div>
    </div>
</div>

<div class="myflot flot-post">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Post</h3>
            <div id="daterange" class="flot-daterange selectbox pull-right hidden-xs">
                <i class="icon-calendar"></i>
                <span><?php echo Carbon\Carbon::today()->format('F d, Y') ?> - <?php echo Carbon\Carbon::today()->format('F d, Y') ?></span> <b class="caret"></b>
            </div>
        </div>
        <div class="panel-body">
            <div id="chart-post" class="flot-content center" style="height:300px;" data-json="<?php echo site_url('api/post') ?>"></div>
        </div>
    </div>
</div>

<ul class="statistics">
    <li>
        <i class="icon-users"></i>
        <div class="number"><?php echo $visitor_today ?></div>
        <div class="title">Visitors Today</div>
        <div class="progress thin">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                <span class="sr-only">73% Complete (success)</span>
            </div>
        </div>
    </li>
    <li>
        <i class="icon-user-follow"></i>
        <div class="number"><?php echo $new_visitor_unique ?></div>
        <div class="title">New Visitor Unique</div>
        <div class="progress thin">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                <span class="sr-only">73% Complete (success)</span>
            </div>
        </div>
    </li>
    <li>
        <i class="icon-speech"></i>
        <div class="number">972</div>
        <div class="title">New comments</div>
        <div class="progress thin">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
                <span class="sr-only">73% Complete (success)</span>
            </div>
        </div>
    </li>
</ul>

<div class="panel panel-default">
    <div class="panel-body">
        <ul>
            <li>Visitor Today : <?php echo $visitor_today ?></li>
            <li>Visitor this Week : <?php echo $visitor_week ?></li>
            <li>Visitor this Month : <?php echo $visitor_month ?></li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="icon-check"></i>Popular Article</h2>
                <div class="panel-actions">
                    <a href="#" class="btn-minimize"><i class="icon-arrow-up"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered" id="article">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Dibaca</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($popular_post as $row): ?>
                        <tr>
                            <td><?php echo $row->id ?></td>
                            <td><a href="<?php echo site_url('article/edit/' . $row->id) ?>"><?php echo $row->title ?></a></td>
                            <td><?php echo $row->getStatusLabel() ?></td>
                            <td><span class="label label-info"><?php echo $row->visitor ?> kali</span></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="icon-check"></i>Latest Comment</h2>
                <div class="panel-actions">
                    <a href="#" class="btn-minimize"><i class="icon-arrow-up"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Komentar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($latest_comment as $comment): ?>
                        <tr>
                            <td><?php echo $comment->content ?><br>
                            <small><span title="<?php echo $comment->date->format('d F Y H:i') ?>"><?php echo $comment->date->diffForHumans() ?></span> - oleh <strong><?php echo $comment->nama ?></strong> di <?php echo anchor($comment->article->link, $comment->article->title) ?></small></td>
                        </tr>                            
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end: Content -->


