var clickedIssue = '';
jQuery(function($){
	var loader = '<div id="tekserve_faq_loading" style="text-align:center; display:none;">\
    	<img src="' + tekserveFaqData[0] + 'images/ajax-loader.gif" />\
    </div>';
	var page = 1;
    var loading = true;
    var postType;
    if( tekserveFaqData[1] == "tekserve_faq_device") {
    	postType = "device";
    }
    if( tekserveFaqData[1] == "tekserve_faq_os") {
    	postType = "os";
    }
	$('.tekserve-faq-'+postType+'-issue').click(function(){
			clickedIssue = this.id;
			$('body #content #tekserve-faq-questions').empty();
			load_posts();
		});

    var $content = $('body #content #tekserve-faq-questions');
    var load_posts = function(){
		$.ajax({
			type		: "GET",
			data		: {numPosts : 20, pageNumber: page, issue : clickedIssue, type : postType},
			dataType	: "html",
			timeout		: 10000,
			url			: tekserveFaqData[0]+"questionSorter.php",
			beforeSend	: function(){
				$content.append(loader);
				$('#tekserve_faq_loading').fadeIn(250);
			},
			success    : function(data){
				$data = $(data);
				if($data.length){
					$data.hide();
					$content.append($data);
					$data.fadeIn(500, function(){
						$("#tekserve_faq_loading").fadeOut(250);
						loading = false;
					});
				}
				else {
					$('#tekserve_faq_loading').fadeOut(250);
					console.log(data);
				}
			},
			error     : function(jqXHR, textStatus, errorThrown) {
				$('#tekserve_faq_loading').fadeOut(250);
				alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
    }
});