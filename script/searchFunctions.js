//searchFunctions.js
$(document).ready(function(){

	//Visa/göm kommentarer
	$("div[data-comments='comments']").each(function(){
		$(this).css("display", "none");

		var commentsRef = $(this);

		var aRef = $("<a>", {"href":"#", "text": "Show comments"}).insertBefore(commentsRef);
		$("<br/>").insertAfter(aRef);

		aRef.on("click", function(theEvent){
			//Avbryt att vi ska gå dit länken visar
			theEvent.preventDefault();
			//Så att det bara klickas på länken, och klicken går inte vidare ut till föräldrar(body, html etc.)
			theEvent.stopPropagation();

			//Visa/göm <p> som ligger i länken
			commentsRef.slideToggle();
		});
	});

	//Visa/göm kommentarsfält
	$("fieldset > form").each(function(){
		$(this).css("display", "none");

		var formRef = $(this);

		var aRef = $("<a>", {"href":"#", "text": "Leave a comment"}).insertBefore(formRef);
		$("<br/>").insertAfter(aRef);

		aRef.on("click", function(theEvent){
			//Avbryt att vi ska gå dit länken visar
			theEvent.preventDefault();
			//Så att det bara klickas på länken, och klicken går inte vidare ut till föräldrar(body, html etc.)
			theEvent.stopPropagation();

			//Visa/göm <p> som ligger i länken
			formRef.slideToggle();
		});
	});
});

//AJAX
var oXMLHTTP;

function fetchCars() {
	oXMLHTTP = new XMLHttpRequest();
	oXMLHTTP.onreadystatechange = handleXMLHTTPData;
	oXMLHTTP.open("POST", "ajax/likesong.php", true);
	oXMLHTTP.send();
}

function handleXMLHTTPData() {

	if(oXMLHTTP.readyState == 4) {
		if(oXMLHTTP.status != 200) {
			window.alert("Webbserver svarar med: " + oXMLHTTP.status);
		} else {

			$("div[data-id='22']").each(function(){
				$(this).css("display", "none");
			});
			var divRef = document.getElementById("theCars");
			divRef.innerHTML = divRef.innerHTML + oXMLHTTP.responseText;
		}
	}
}