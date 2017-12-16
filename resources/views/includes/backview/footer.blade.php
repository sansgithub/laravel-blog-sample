</div><!--div #app end-->
<!-- Scripts -->
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>    
    <script>

        var token = '{{ Session::token() }}';
        var userId = '{{ Auth::user()->id }}';
        var urlEdit = "{{ route('qedit') }}";


        $('.post-div').find('.interaction').find('.edit').on('click',function(event){
            event.preventDefault();
            postTitleElement=event.target.parentNode.parentNode.childNodes[0];
            postDetailElement=event.target.parentNode.parentNode.childNodes[2];
            var postTitle = postTitleElement.textContent;
            var postDetail = postDetailElement.textContent;
            postId = event.target.parentNode.parentNode.dataset['postid'];
            $('#post_title').val(postTitle);
            $('#post_details').val(postDetail);
            $('#post-insert-modal').modal();
        });

        $('#modal-save').on('click', function () {
            $.ajax({
                        method : 'POST',
                        url: urlEdit,
                        data: {
                            postTitle : $('#post_title').val(),
                            postDetail : $('#post_details').val(),
                            postId : postId,
                            _token : token
                        }
                    })
                    .done(function (msg) {
                         $(postTitleElement).text(msg['new_title']);
                         $(postDetailElement).text(msg['new_details']);
                         $('#post-insert-modal').modal('hide');
                         toastr.success('Successfully edited Post!', 'Success Alert', {timeOut: 5000});
                    });
        });


        $('.post-div').find('.interaction').find('.delete').on('click',function(event){

            event.preventDefault();
            deletePostId = event.target.parentNode.parentNode.dataset['postid'];
            var postTitleElement = event.target.parentNode.parentNode.childNodes[0];
            var postTitle = postTitleElement.textContent;
            $('#delete-post_title').val(postTitle);
            $('#delete-modal').modal();
        });

        $('.modal-footer').on('click','#modal-delete', function () {
            $.ajax({
                        type : 'DELETE',
                        url: 'post/' + deletePostId,
                        data: {
                            _token : token
                        },
                        success : function (data) {
                            $('#delete-modal').modal('hide');
                            articleToRemove = $('#post-div-' + data['id']);
                            articleToRemove.remove();
                            hrToRemove = $('#post-hr-' + data['id']);
                            hrToRemove.remove();
                            toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});

                        }
                    });
        });

        $('.post-div').find('.interaction').find('.comment').on('click',function(event) {
            event.preventDefault();
            commentOnId = event.target.parentNode.parentNode.dataset['postid'];
            selected = document.getElementById('show-'+commentOnId);
            if(selected.className == 'hide'){
                selected.style.display = 'block';
                selected.className = 'show';
                var commentDetailElement = selected.children[0].childNodes[0];
                var commentDetail = commentDetailElement.textContent;
                $('#comment_details').val(commentDetail);
            }
        });
        

        function postComment()
        {
                $.ajax({
                    type: 'POST',
                    url: 'comment/'+commentOnId,
                    data: {
                        _token: token,
                        comment_details: $('#comment_details').val(),
                        userId : userId,
                        commentOnId: commentOnId
                    },
                    success: function (data) {
                        selected.style.display = 'none';
                        selected.className = 'hide';
                        toastr.success('Your comment has been posted!', 'Success Alert', {timeOut: 5000});
                    }
                });
        }
    </script>
    </body>
</html>