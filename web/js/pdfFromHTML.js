function HTMLtoPDF(){
var pdf = new jsPDF('p', 'pt', 'letter');
source = $('#HTMLtoPDF')[0];
specialElementHandlers = {
	'#bypassme': function(element, renderer){
		return true
	}
}
margins = {
    top: 50,
    left: 60,
    width: 545
  };
pdf.fromHTML(
  	source 
  	, margins.left
  	, margins.top 
  	, {
  		'width': margins.width
  		, 'elementHandlers': specialElementHandlers
  	},
  	function (dispose) {
        pdf.save('statistiqueAnimals.pdf');
      }
  )		
}