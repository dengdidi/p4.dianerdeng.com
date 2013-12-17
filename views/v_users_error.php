<?php if($user): ?>
        <h2>Sorry, You're here by mistake <?=$user->first_name;?>!</h2>
        <img src="http://cdn.memegenerator.net/instances/500x/43847019.jpg" alt="skeptical couponer meme"
<?php else: ?>
        <h2>You Reap What You Clip! Sign Up Today & Become a ChipperClipper</h2>
        <img src="http://cdn.memegenerator.net/instances/500x/43846880.jpg" alt="Y U NO coupon MEME">
<?php endif; ?>