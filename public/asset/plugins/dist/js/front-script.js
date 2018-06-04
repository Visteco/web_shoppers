jQuery(document).ready(function(){
// 	// $('#recent_users').click(function(){
// 		$.ajax({
// 			type: 'POST',
// 			url: base_url()+'getUserDetails',
// 			success:function(data){

// 			}
// 		});
// 	// });
});

function get_all_user(login_role,class_name,all_class){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$.ajax({
		type: 'POST',
		url: base_url()+'getUserDetails',
		data:{'login_role':login_role},
		success:function(response){
			var response_html='';
			$.each(response.data,function(key,response_val){
				response_html += '<div class="company simple_border_red">';
				var vertical1 = (response_val.login_role == 'usrpr')?'vertical1':'';
				var vertical2 = (response_val.login_role == 'usrpr')?'vertical2':'';
                response_html += '<div class="company_logo '+vertical1+'">';
                if(response_val.img != '' && response_val.img != null){
                	response_html += '<img class ="company_logo '+vertical1+' home-company-img" src="'+base_url()+'public/userimages/user_'+response_val.id+'/medium/'+response_val.img+'" alt="#" />';
                }else{
                    if(response_val.login_role=='cmppr'){
                        response_html += '<img class="company_logo '+vertical1+'" src="'+base_url()+'public/asset/plugins/dist/images/webapplisoft.png" alt="#" />';
                    }else{
                        response_html += '<img class="company_logo '+vertical1+'" src="'+base_url()+'public/asset/plugins/dist/images/people.png" alt="#" />';
                    }
                }
                if(response_val.login_role=='usrpr'){
                	response_html += '<a href="javascript:void(0)" class="button_red">follow</a>' 
            	}
                response_html += '</div>';
                response_html += '<div class="company_content '+vertical2+'">';
               	response_html += '<div class="company_content_left">';
               	if(response_val.login_role=='cmppr'){
               		response_html += '<h3>'+((response_val.company_name != null && response_val.company_name!='')?response_val.company_name:'')+'</h3>';
               		response_html += '<p>'+((response_val.company_city != null && response_val.company_city!='')?response_val.company_city:'')+'&nbsp;'+((response_val.company_state != null && response_val.company_state !='')?response_val.company_state:'')+'</p>';
               	}else{
               		response_html += '<h3>'+((response_val.user_name != null && response_val.user_name !='')?response_val.user_name:'')+'</h3>';
               	}
                response_html += '</div>';
                response_html += '<div class="company_content_right">';
                if(response_val.login_role=='cmppr'){
                	response_html += '<ul>';
	                response_html += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
	                response_html += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
	                response_html += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
	                response_html += '<li><i class="fa fa-star" aria-hidden="true"></i></li>';
	                response_html += '<li><i class="fa fa-star-half-o" aria-hidden="true"></i></li>';
	                response_html += '</ul>'
	                response_html += '<a href="javascript:void(0)" class="button_red">follow</a>';
                }else{
                	response_html += '<h4>'+((response_val.pres_desg != null && response_val.pres_desg !='')?response_val.pres_desg:'')+'</h4>';
	                response_html += '<h5>'+((response_val.pres_org != null && response_val.pres_org !='')?response_val.pres_org:'')+'</h5>';
	                response_html += '<p>'+((response_val.city !=null && response_val.city !='')?response_val.city:'')+', '+((response_val.state != null && response_val.state !='')?response_val.state:'')+'</p>';
                }
                response_html += '</div>';
                response_html += '</div>';
                response_html += '</div>';
			});
			$('.'+class_name).html(response_html);
			$('.'+all_class).remove();
		}
	});
}
// base url
function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
    }else{
        var url = location.origin+'/'; // http://stackoverflow.com
    }
    return url;
}