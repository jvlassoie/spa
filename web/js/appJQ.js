$(function(){
	var hostname = window.location.hostname
	var protocol = window.location.protocol
	
	$('#datepicker').datepicker();
	$('#timepicker').timepicker({
		timeFormat: 'HH:mm',
		interval: 15,
		minTime: '7:00',
		maxTime: '19:00',
		defaultTime: '7:00',
		startTime: '7:00',
		dynamic: true,
		dropdown: true,
		scrollbar: true
	});

	$('#esp').on("click",function(){
		var idSpecie = $(this).val()
		var url = protocol + "//" + hostname + "/breed/response/" + idSpecie
		if (idSpecie != ''){
			$.ajax(url, {
				success: function(data){
					$('#selectRace').empty()
					$('#selectAnimal').empty()
					data = JSON.parse(data)
					var opt = null;
					$.each(data,function(i) {
						opt += '<option value='+ data[i].id + '>' + data[i].name + '</option>';
					})
					$('#selectRace').append('<option value="" >--Choisissez une Race</option>')
					$('#selectRace').append(opt)
				},
				error: function(){
					alert("error")
				}
			});
		}

	});

	$('#selectRace').on("click",function(){
		var idBreed = $(this).val()
		var url = protocol + "//" + hostname + "/animal/response/" + idBreed
		if (idBreed != ''){
			$.ajax(url, {
				success: function(data){

					$('#selectAnimal').empty()
					data = JSON.parse(data)
					var opt = null;
					$.each(data,function(i) {
						opt += '<tr>';
						opt += '<input type="hidden" value=' + data[i].id +'>';
						opt += '<td>' + data[i].name + '</td>';
						opt += '<td>' + data[i].description + '</td>';
						opt += '<td>' + data[i].age + '</td>';
						opt += '<td><button class="btn btn-success" id="AddAnimal" type="button">Add</button></td>';
						opt += '</tr>';
					})
					$('#selectAnimal').append(opt)
				},
				error: function(){
					alert("error")
				}
			});
		}
	});

	$('#selectAnimal').on("click","#AddAnimal",function() {
		var idAnimal = $(this).closest('tr').find('input').val()
		var url = protocol + "//" + hostname + "/animal/responseAnimal/" + idAnimal
		var bool = true
		$('input[name^="listAnimals"]').each(function(){
			bool = ($(this).val() == idAnimal)? false : true;
			if (bool == false) {
				return bool
			}

		})
		if (bool) {
			
			$('#addListAnimals').append("<input type='hidden' name='listAnimals[]' value="+ idAnimal + " />")

			$.ajax(url,{
				success: function(data){
					data = JSON.parse(data)
					$.each(data,function(i){
						var opt = null
						opt += '<tr>';
						opt += '<input type="hidden" value=' + data[i].AnimalsId +'>';
						opt += '<td>' + data[i].AnimalsName + '</td>';
						opt += '<td>' + data[i].AnimalsDescription + '</td>';
						opt += '<td>' + data[i].AnimalsAge + '</td>';
						opt += '<td><button class="btn btn-danger" id="RemoveAnimal" type="button">Remove</button></td>';
						opt += '</tr>';
						$('#selectedAnimals').append(opt)				
					})

				},
				error: function (msg){
					console.log(msg)
				}
			})

		}
	});

	$('#selectedAnimals').on("click","#RemoveAnimal",function() {

		var tr = $(this).closest('tr')
		var idAnimal = tr.find('input').val()
		var bool = true
		$('input[name^="listAnimals"]').each(function(){
			bool = ($(this).val() == idAnimal)? false : true;
			if (bool == false) {
				$(this).remove()
				tr.remove()	
				return bool
			}

		})	
	})	



})