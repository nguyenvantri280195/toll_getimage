$(document).ready(function(){
	$("#sortBy").on('change',function(){
		var url = 'http://project.dev:8080/admin/getlink';
		var link = $(this).parent().find('option').attr('link');
		var name = $(this).val();
		$.ajax({
			url:url,
			type:'GET',
			cache:false,
			data:{'name':name,'link':link},
			success: function(data){
				$('#link1').remove();
				var i = 'abc';
				$('#abc').remove();
				$("#link2").append('<input type="text" id="abc" name="link" value="'+data+'" class="form-control col-md-7 col-xs-12">');
			}
		});
	});
});