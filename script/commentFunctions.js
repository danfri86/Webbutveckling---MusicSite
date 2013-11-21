//commentFunctions.js

/**
*	Funktionen verifyDeleteOfComment visar en dialogruta med "OK" och "Cancel".
*	Texten i dialogrutan best�r av tal + text i inkommande parametrar.
*	Funktionen returnerar sant vid tryck p� "OK" och falskt vid tryck p� "Cancel.
*	@param {Number} inId - Id (prim�rnyckel i databasen) f�r kommentaren som skall tas bort.
*	@param {String} inText - Texten i kommentaren som skall tas bort.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellstr�m
*/
function verifyDeleteOfComment(inId, inText){
	return window.confirm("Delete " + inId + ": " + inText + "?");
}

$(document).ready(function(){
	//Klicka p� Delete
	$("form").each(function(){
		$(this).on("submit", function(theEvent){
			theEvent.preventDefault();
			theEvent.stopPropagation();

			var id = $(this).find("input[name='hidId']").val();
			var text = $(this).find("input[name='hidText']").val();

			var tabort = verifyDeleteOfComment( id, text );

			if(tabort){
				alert("True");
			}
		});
	});
});