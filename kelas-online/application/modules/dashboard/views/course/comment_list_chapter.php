
<ol class="breadcrumb">
    <li><a href="<?php echo dashboard_url() ?>">Dashboard</a></li>
    <li><a href="<?php echo site_url('dashboard') ?>">Kelas Online</a></li>
    <li><a href="<?php echo site_url('dashboard/course/edit/'.$course->id) ?>"><?php echo $course->name ?></a></li>
    <li class="active">Comment</li>
</ol>

<div class="kelas-main">
    <div class="card">
        <div class="card-header">
            Comment List
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($comments as $comment): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo $comment->avatar ?>" class="img img-circle img-fluid center-block">
                        </div>
                        <div class="col-md-6">
                            <strong><?php echo $comment->name ?></strong><br>
                            <small><?php echo $comment->email ?></small><br>
                            <small>Comment at <?php echo $comment->created_at->format('d F Y') ?> on <strong><a href="<?php echo site_url('course/showchapter/'.$comment->chapter->course->slug.'/chapter-'.$comment->chapter->order.'#comment-'.$comment->id) ?>">Chapter <?php echo $comment->chapter->order ?> : <?php echo $comment->chapter->name ?></a></strong></small>
                            <p><?php echo $comment->content ?></p>
                            
                            <?php echo $comment->status_label ?><br><br>
                        </div>
                        <div class="col-md-4">
                            <?php if ($comment->status == 'draft'): ?>
                                <a href="<?php echo site_url('dashboard/course/approve-comment/'.$course->id.'/'.$comment->id) ?>" class="btn btn-primary">Approve</a>
                            <?php endif ?>
                            <a href="<?php echo site_url('dashboard/course/delete-comment/'.$course->id.'/'.$comment->id) ?>" class="btn btn-delete-lg btn-danger btn-margin-btm">Delete</a>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="card-block">
            <?php echo $comments->render() ?>
        </div>
    </div>
</div>
