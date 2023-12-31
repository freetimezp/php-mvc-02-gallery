var post = {
    posting: false,
    liked_element: null,
    root: root,
    like: function (post_id, ele) {
        //alert(post_id);
        post.liked_element = ele;
        let obj = {
            post_id: post_id,
            data_type: 'like',
        };

        //console.log(ele);

        post.send_data(obj);
    },
    send_data: function (obj) {
        if (post.posting) return;
        let xhr = new XMLHttpRequest();

        post.posting = true;

        xhr.addEventListener('readystatechange', function () {
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

        xhr.open('post', post.root + '/ajax');
        xhr.send(myform);
    },
    handle_result: function (result) {
        //alert(result);
        let obj = JSON.parse(result);
        if (obj.data_type == 'like') {
            if (obj.error != '') {
                alert(obj.error);
                return;
            }

            let svg = post.liked_element.querySelector('svg');
            //console.log(svg);
            let color = obj.liked ? '#fd0dd8' : '#0d6efd';
            svg.setAttribute('fill', color);

            if (obj.likes == 0) {
                obj.likes = "";
            }

            post.liked_element.querySelector('.js-likes-count').innerHTML = obj.likes;
        }
    },
};