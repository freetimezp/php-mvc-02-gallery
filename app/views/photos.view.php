<?php $this->view('includes/header', $data); ?>

<div class="p-4">
    <h3>Gallery (Photos)</h3>
</div>

<div class="row my-3 p-4 justify-content-center">

    <?php if (!empty($rows)) : ?>
        <?php foreach ($rows as $row) : ?>
            <?php $this->view('includes/photo-card', ['row' => $row, 'image' => $image, 'like' => $like]); ?>
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
        liked_element: null,
        like: function(post_id, ele) {
            //alert(post_id);
            post.liked_element = ele;
            let obj = {
                post_id: post_id,
                data_type: 'like',
            };

            //console.log(ele);

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
                    post.handle_result(xhr.responseText);
                }
            });

            let myform = new FormData();
            for (key in obj) {
                myform.append(key, obj[key]);
            }

            xhr.open('post', '<?= ROOT; ?>/ajax');
            xhr.send(myform);
        },
        handle_result: function(result) {
            alert(result);
            let obj = JSON.parse(result);
            if (obj.data_type == 'like') {
                let svg = post.liked_element.querySelector('svg');
                //console.log(svg);
                let color = obj.liked ? '#fd0dd8' : '#0d6efd';
                svg.setAttribute('fill', color);
            }
        },
    };
</script>