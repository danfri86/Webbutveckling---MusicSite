//artistFunctions.js

/**
*	Funktionen resetArtistFormData rensar inmatad data i formuläret "frmNewUpdateArtist".
*	@version 1.0
*	@author Peter Bellström
*/
function resetArtistFormData() {
	var theForm = document.getElementById("frmNewUpdateArtist");
    theForm.hidId.value = "";
    theForm.hidPictureFileName.value = "";
    theForm.reset();
}

/**
*	Funktionen copyArtistFormData kopierar inkommande parametrar till formuläret "frmNewUpdateArtist".
*	@param {Number} inId - Id (primärnyckel i databasen) för artisten som skall redigeras.
*	@param {String} inFileName - Filnamn för artisten som skall redigeras.
*	@param {String} inArtist - Artistnamn för artisten som skall redigeras.
*	@version 1.0
*	@author Peter Bellström
*/
function copyArtistFormData(inId, inFileName, inArtist) {
	var theForm = document.getElementById("frmNewUpdateArtist");
    theForm.hidId.value = inId;
    theForm.hidPictureFileName.value = inFileName;
    theForm.txtArtist.value = inArtist;
}

/**
*	Funktionen verifyDeleteOfArtist visar en dialogruta med "OK" och "Cancel".
*	Texten i dialogrutan består av tal + text i inkommande parametrar.
*	Funktionen returnerar sant vid tryck på "OK" och falskt vid tryck på "Cancel.
*	@param {Number} inId - Id (primärnyckel i databasen) för artisten som skall tas bort.
*	@param {String} inArtist - Artistnamn för artisten som skall tas bort.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function verifyDeleteOfArtist(inId, inArtist) {
		return window.confirm("Delete " + inId + " " + inArtist + "?");
}

/**
*	Funktionen checkFileExtension kontrollerar filändelsen för inkommande parameter och
*	returnerar sant om det är "jpg" annars falskt.
*	@param {String} inFileName - Filnamn för filen som skall kontrolleras.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function checkFileExtension(inFileName) {
    var fileExtension = inFileName.substring(inFileName.length - 3);
	
	fileExtension = fileExtension.toLowerCase();

    if(fileExtension != "jpg")
    {
        return false;
    }

    return true;

}

/**
*	Funktionen validateArtistFormData kontrollerar att indata i formuläret "frmNewUpdateArtist" uppfyller
*	givna villkor. Om alla villkor uppfylls returneras sant om inte visas en dialogruta med "felet" och
*	därefter returneras falskt.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function validateArtistFormData() {
	var theForm = document.getElementById("frmNewUpdateArtist");
	try
	{
		if(theForm.txtArtist.value == "")
		{
			throw new Error("Artistname is missing!");
		}
		
		if(theForm.hidId.value == "")
		{
			if(theForm.filePictureFileName.value == "")
            {
                throw new Error("Picturename is missing!");
            }
            else
            {
                if(checkFileExtension(theForm.filePictureFileName.value) == false)
				{
					throw new Error("Only jpg files are valid!");
				}
            }
			
		}
	
		if(theForm.hidId.value != "")
		{
			if(theForm.filePictureFileName.value != "")
            {
                if(checkFileExtension(theForm.filePictureFileName.value) == false)
				{
					throw new Error("Only jpg files are valid!");
				}
            }
			
		}
		
		return true;
	
	}
	catch(oException)
	{
		window.alert(oException.message);
		return false;
	}
}







