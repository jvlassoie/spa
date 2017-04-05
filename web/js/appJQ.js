$(function(){

	$('#esp').click(function(){
		var idSpecie = $(this).val()
		var hostname = window.location.hostname
		var url = "http://" + window.location.hostname + "/breed/response/" + idSpecie
		$.ajax(url, {
			success: function(data){
				data = JSON.parse(data)
				var opt = null;
				$.each(data,function(i) {
					opt += '<option value='+ data[i].id + '>' + data[i].name + '</option>';
				})
				$('#selectRace').html(opt)
			},
			error: function(){
				alert("error")
			}
		});
	});
})