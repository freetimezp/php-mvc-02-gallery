<?php $this->view('includes/header', $data); ?>

<div class="p-4">
    <h3>Gallery (Photos)</h3>
</div>

<div class="row my-3 p-4 justify-content-center">

    <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
            <?php $this->view('includes/photo-card', ['row' => $row, 'image' => $image]); ?>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="my-4 p-2 text-center">
            No images found!
        </div>
    <?php endif; ?>

</div>

<div>
    <?php $pager->display(); ?>
</div>

<?php $this->view('includes/footer', $data); ?>

<script>
    var post = {
        posting: false,
        like: function(post_id) {
            //alert(post_id);
            let obj = {
                post_id: post_id,
                data_type: 'like',
            };

            post.send_data(obj);
        },
        send_data: function(obj) {
            if (post.posting) return;
            let xhr = new XMLHttpRequest();

            post.posting = true;

            xhr.addEventListener('readystatechange', function() {
                if (xhr.readyState == 4) {
                    post.posting = false;
                    //alert(xhr.responseText);
                }
            });

            let myform = new FormData();
            for (key in obj) {
                myform.append(key, obj[key]);
            }

            xhr.open('post', '<?= ROOT; ?>/ajax');
            xhr.send(myform);
        },
    };
</script>