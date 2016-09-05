<?php
use mini\Mini;
?>
<h1>All Posts Page</h1>
<p>
    <a class='btn btn-info' href='<?php echo Mini::getUrl('post/create') ?>'>New Post</a>
</p>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <?php
        foreach ($this->posts as $key => $post) {
            echo "<tr>";
            echo "<td>" . $post->id . "</td>";
            echo "<td>" . $post->title . "</td>";
            echo "<td>" . $post->content . "</td>";
            echo "<td><a class='post_item' href='#' post_id='" . $post->id . "'>Ajax Delete</a></td>";
            echo "<td><a href='" . Mini::getUrl('post/deleteById/' . $post->id) . "'>Usual Delete</a></td>";
            echo "<td><a href='" . Mini::getUrl('post/view/' . $post->id) . "'>View</a></td>";
            echo "<td><a href='" . Mini::getUrl('post/edit/' . $post->id) . "'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<script>
    //TO-DO: Programmatically move every js code to the very last place of page, before <body> tag
    document.addEventListener("DOMContentLoaded", function(event) { 
        $(document).on('click', '.post_item', function(){
            var tr = $(this).parents().eq(1);
            $.ajax({
                type: "POST",
                data: {
                    id: $(this).attr('post_id'),
                },
                url: "<?php echo Mini::getUrl('post/deleteByIdAjax') ?>",
                success: function(response) {
                    if (response  == 'true') {
                        tr.remove();
                    }
                },
            });
        });
    });
</script>
