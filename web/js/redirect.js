(function(){
	var link = document.querySelector("#link").value

	var redirect = function(link,timer){
		setTimeout(function(){
			window.location.assign('http://'+ link);
		},timer)
	}

	redirect(link,3000)
})()