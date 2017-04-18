$(function(){
	$('#verifPassword').on('keyup',function(){
		var firstPass = $('#enterPassword').val()
		var secondPass = $(this).val()
		if (firstPass != secondPass && secondPass.length > 0) {
			$('#msgPass').html("<div class='alert alert-dismissible alert-danger'><p>les deux mots de passe sont différents</p></div>")
			
		}else if(firstPass == secondPass && secondPass.length > 0){
			$('#msgPass').html("<div class='alert alert-dismissible alert-success'><p>les deux mots de passe sont les mêmes</p></div>")

		}
	})

})