<?php

use mini\Mini;
?>
<h1>Edit Post</h1>
<?php if (isset($this->res) && $this->res === true) { ?>
    <div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        New Post has been edited successfully.
    </div>
    <?php }
?>
<?php if (!is_null($this->model)) { ?>
<form method="post" action="<?php echo Mini::getUrl('post/edit/' . $this->model->id) ?>">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $this->model->title ?>">
    </div>
    <div class="form-group">
        <label for="title">Content</label>
        <textarea class="form-control" rows="3" id="content" name="content"><?php echo $this->model->content ?></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php } else { ?>
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    This post doesn't exit.
</div>
<?php } ?>
