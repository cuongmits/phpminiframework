<?php
use mini\Mini;
$post = $this->model; ?>
<h1>View Post with ID = <?php echo $post->id?></h1>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <?php
            echo "<tr>";
            echo    "<td>ID: </td>";
            echo    "<td>" . $post->id . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo    "<td>Title: </td>";
            echo    "<td>" . $post->title . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo    "<td>Content: </td>";
            echo    "<td>" . $post->content . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo    "<td></td>";
            echo    "<td>"
                    . "<a class='btn btn-default' href='" . Mini::getUrl('post/index/') . "'>All Post</a>"
                    . "<a class='btn btn-default' href='" . Mini::getUrl('post/deleteById/' . $post->id) . "'>Usual Delete</a>"
                    . "</td>";
            echo "</tr>";
        ?>
    </table>
</div>