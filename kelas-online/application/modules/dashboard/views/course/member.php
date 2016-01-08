
<ol class="breadcrumb">
    <li><a href="<?php echo dashboard_url() ?>">Dashboard</a></li>
    <li><a href="<?php echo site_url('dashboard') ?>">Kelas Online</a></li>
    <li><a href="<?php echo site_url('dashboard/course/edit/'.$course->id) ?>"><?php echo $course->name ?></a></li>
    <li class="active">Member</li>
</ol>

<div class="kelas-main">
    <div class="card">
        <div class="card-header">
            Member
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($members as $user): ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo $user->avatar ?>" class="img img-circle img-fluid">
                        </div>
                        <div class="col-md-5">
                            <?php echo $user->full_name ?><br>
                            <small><?php echo $user->email ?></small><br>
                            <small>Joined at <?php echo date('d F Y H:i', strtotime($user->pivot->joined_at)) ?></small><br>
                            
                            <?php if ($user->pivot->status == 'active'): ?>
                                <span class="label label-info">Active</span>
                            <?php elseif ($user->pivot->status == 'pending'): ?>
                                <span class="label label-warning">Pending</span>
                            <?php elseif ($user->pivot->status == 'finished'): ?>
                                <span class="label label-success">Finished</span>
                            <?php endif ?>
                        </div>
                        <div class="col-md-5">
                            <?php if ($user->pivot->status == 'pending'): ?>
                                <a href="<?php echo site_url('dashboard/course/approve-member/'.$course->id.'/'.$user->id) ?>" class="btn btn-primary">Approve</a>
                            <?php endif ?>
                            <a href="<?php echo site_url('dashboard/course/kick-member/'.$course->id.'/'.$user->id) ?>" class="btn btn-delete btn-danger">Kick</a>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="card-block">
            <?php echo $members->render() ?>
        </div>
    </div>
</div>