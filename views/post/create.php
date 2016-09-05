<?php

use mini\Mini;
?>
<h1>Create New Post</h1>
<?php if (isset($this->res) && $this->res === true) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        New Post has been created successfully.
    </div>
    <?php }
?>
<form method="post" action="<?php echo Mini::getUrl('post/create') ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="">
    </div>
    <div class="form-group">
        <label for="title">Content</label>
        <textarea class="form-control" rows="3" id="content" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>