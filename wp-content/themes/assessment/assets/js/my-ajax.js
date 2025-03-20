jQuery(document).ready(function ($) {
    function fetchPosts() {
        jQuery.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: { action: 'fetch_demo_api_data' },
            beforeSend: function () {
                jQuery('#api_container').html('<p Style="width:100%;text-align:center;">Loading...</p>');
            },
            success: function (response) {
              
                if (response.success) {
                    let posts = response.data.quotes;
					//console.log(posts); 
					//alert(JSON.stringify(posts, null, 2)); 
                    let output = '';
                    posts.forEach(post => {
                        output +=  `<div class="col-lg-4 col-sm-6 col-xs-12 mb-4">
						<div class="card service-card text-center pt-4 pb-4">
							<div class="card-body">
								<h4>${post.author}</h4>
								<p>${post.quote}</p>
							</div>
						</div>				
					</div>`;
                  });
                    jQuery('#api_container').html(output);
                }
            },
            error: function () {
               // alert(2);
                jQuery('#api_container').html('<p>Failed to load posts.</p>');
            }
        });
    }

    fetchPosts();
});
