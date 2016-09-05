<h1>Delete Post by Id</h1>
<p>
    <?php echo $this->res == 1 ? "Post with id = " . $this->id . " has beend deleted." : "Cannot delete post with id = " . $this->id . "." ?>
    Go to the <a href='<?php echo \mini\Mini::getUrl('post/index') ?>'>Posts page</a>
</p>