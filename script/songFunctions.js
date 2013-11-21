//songFunctions.js

/**
*	Funktionen resetSongFormData rensar inmatad data i formuläret "frmNewUpdateSong".
*	@version 1.0
*	@author Peter Bellström
*/
function resetSongFormData() {

	var theForm = document.getElementById("frmNewUpdateSong");
	
    theForm.hidId.value = "";
    theForm.hidSoundFileName.value = "";
    theForm.reset();
}

/**
*	Funktionen copySongFormData kopierar inkommande parametrar till formuläret "frmNewUpdateSong".
*	@param {Number} inId - Id (primärnyckel i databasen) för sången som skall redigeras.
*	@param {String} inFileName - Filnamn för sången som skall redigeras.
*	@param {Number} inArtistId - Id (främmandenyckel i databasen) för artisten sången knyts till.
*	@param {String} inTitle - Sångtitel för sången som skall redigeras.
*	@param {Number} inCount - Antal "gilla" får sången som skall redigeras.
*	@version 1.0
*	@author Peter Bellström
*/
function copySongFormData(inId, inFileName, inArtistId, inTitle, inCount) {

	var theForm = document.getElementById("frmNewUpdateSong");
	
    theForm.hidId.value = inId;
    theForm.hidSoundFileName.value = inFileName;
    theForm.selArtistId.value = inArtistId;
	theForm.txtTitle.value = inTitle;
    theForm.txtCount.value = inCount;
}

/**
*	Funktionen verifyDeleteOfSong visar en dialogruta med "OK" och "Cancel".
*	Texten i dialogrutan består av tal + text i inkommande parametrar.
*	Funktionen returnerar sant vid tryck på "OK" och falskt vid tryck på "Cancel.
*	@param {Number} inId - Id (primärnyckel i databasen) för sången som skall tas bort.
*	@param {String} inTitle - Sångtitel för sången som skall tas bort.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function verifyDeleteOfSong(inId, inTitle) {
   return window.confirm("Delete " + inId + " " + inTitle + "?");
}

/**
*	Funktionen checkFileExtension kontrollerar filändelsen för inkommande parameter och
*	returnerar sant om det är "ogg" annars falskt.
*	@param {String} inFileName - Filnamn för filen som skall kontrolleras.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function checkFileExtension(inFileName) {

    var fileExtension = inFileName.substring(inFileName.length - 3);
	fileExtension = fileExtension.toLowerCase();

    if(fileExtension != 'ogg'){
        return false;
    }
    return true;
}

/**
*	Funktionen validateSongFormData kontrollerar att indata i formuläret "frmNewUpdateSong" uppfyller
*	givna villkor. Om alla villkor uppfylls returneras sant om inte visas en dialogruta med "felet" och
*	därefter returneras falskt.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellström
*/
function validateSongFormData(theForm) {
	var theForm = document.getElementById("frmNewUpdateSong");
	
  	try {
		if(theForm.selArtistId.selectedIndex == 0) {
			throw new Error("Artist is missing!");
		}
		
		if(theForm.txtTitle.value == "") {
			throw new Error("Songtitle is missing!");
		}
		
		if(theForm.hidId.value == ""){
			if(theForm.fileSoundFileName.value == "") {
                throw new Error("Soundname is missing!");
            }
            else {
                if(checkFileExtension(theForm.fileSoundFileName.value) == false) {
					throw new Error('Only ogg files are valid!');
				}
            }
			
		}
	
		if(theForm.hidId.value !== "") {
			if(theForm.hidSoundFileName.value !== null || theForm.hidSoundFileName.value !== "") {
                if(checkFileExtension(theForm.hidSoundFileName.value) == false) {
					throw new Error("Only ogg files are valid!");
				}
            }
		}
		
		if(theForm.txtCount.value == "") {
			throw new Error("Count is missing!");
		}
		
		return true;
	}
	catch(oException)
	{
		window.alert(oException.message);
		return false;
	}
}

$(document).ready(function(){
	//Klicka på reset i formuläret
	$("form#frmNewUpdateSong .btnReset").on("click", function(){
		resetSongFormData();
	});

	//Klicka på Delete
	$(".accordion form").each(function(){
		$(this).on("submit", function(theEvent){
			theEvent.preventDefault();
			theEvent.stopPropagation();

			var id = $(this).find("input[name='hidId']").val();
			var title = $(this).find("input[name='hidTitle']").val();

			var tabort = verifyDeleteOfSong( id, title );

			if(tabort){
				alert("True");
			}
		});
	});

	//Klicka på Edit
	$(".accordion form").each(function(){
		formRef = $(this);

		var id = $(formRef).find("input[name='hidId']").val();
		var filnamn = $(formRef).find("input[name='hidSoundFileName']").val();
		var artistId = $(formRef).find("input[name='hidArtistId']").val();
		var title = $(formRef).find("input[name='hidTitle']").val();
		var count = $(formRef).find("input[name='hidCount']").val();
		

		$(formRef).find("input[name='btnEdit']").on("click", function(theEvent){
			theEvent.preventDefault();
			theEvent.stopPropagation();

			copySongFormData( id, filnamn , artistId, title, count );
		});
	});
});

