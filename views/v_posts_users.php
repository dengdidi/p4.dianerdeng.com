<?php foreach($users as $user): ?>
    <div id="userslist">
        <!-- Print this user's name -->
        <h3><?=$user['first_name']?> <?=$user['last_name']?></h3>

        <!-- If there exists a connection with this user, show a unfollow link -->
        <small>
        <?php if(isset($connections[$user['user_id']])): ?>
            <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

        <!-- Otherwise, show the follow link -->
        <?php else: ?>
            <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
        <?php endif; ?>
        </small>
    </div>
<br>

<?php endforeach; ?>