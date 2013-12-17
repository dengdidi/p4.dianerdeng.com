<?php foreach($posts as $post): ?>

<div id= "article">
	<article>
	    <h2>"<?=$post['content']?>"</h2> 
	    <p>via <em><?=$post['first_name']?> <?=$post['last_name']?></em>
	    <small><time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
	        <?=Time::display($post['created'])?>
	    </time></small></p>
	</article>
</div>

<?php endforeach; ?>