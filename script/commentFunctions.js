//commentFunctions.js

/**
*	Funktionen verifyDeleteOfComment visar en dialogruta med "OK" och "Cancel".
*	Texten i dialogrutan består av tal + text i inkommande parametrar.
*	Funktionen returnerar sant vid tryck på "OK" och falskt vid tryck på "Cancel.
*	@param {Number} inId - Id (primärnyckel i databasen) för kommentaren som skall tas bort.
*	@param {String} inText - Texten i kommentaren som skall tas bort.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function verifyDeleteOfComment(inId, inText){
    return window.confirm("Delete " + inId + ": " + inText + "?");
}