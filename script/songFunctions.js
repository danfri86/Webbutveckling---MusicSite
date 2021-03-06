//songFunctions.js

/**
*	Funktionen resetSongFormData rensar inmatad data i formul�ret "frmNewUpdateSong".
*	@version 1.0
*	@author Peter Bellstr�m
*/
function resetSongFormData() {

	var theForm = document.getElementById("frmNewUpdateSong");
	
    theForm.hidId.value = "";
    theForm.hidSoundFileName.value = "";
    theForm.reset();
}

/**
*	Funktionen copySongFormData kopierar inkommande parametrar till formul�ret "frmNewUpdateSong".
*	@param {Number} inId - Id (prim�rnyckel i databasen) f�r s�ngen som skall redigeras.
*	@param {String} inFileName - Filnamn f�r s�ngen som skall redigeras.
*	@param {Number} inArtistId - Id (fr�mmandenyckel i databasen) f�r artisten s�ngen knyts till.
*	@param {String} inTitle - S�ngtitel f�r s�ngen som skall redigeras.
*	@param {Number} inCount - Antal "gilla" f�r s�ngen som skall redigeras.
*	@version 1.0
*	@author Peter Bellstr�m
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
*	Texten i dialogrutan best�r av tal + text i inkommande parametrar.
*	Funktionen returnerar sant vid tryck p� "OK" och falskt vid tryck p� "Cancel.
*	@param {Number} inId - Id (prim�rnyckel i databasen) f�r s�ngen som skall tas bort.
*	@param {String} inTitle - S�ngtitel f�r s�ngen som skall tas bort.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellstr�m
*/
function verifyDeleteOfSong(inId, inTitle) {
   return window.confirm("Delete " + inId + " " + inTitle + "?");
}

/**
*	Funktionen checkFileExtension kontrollerar fil�ndelsen f�r inkommande parameter och
*	returnerar sant om det �r "ogg" annars falskt.
*	@param {String} inFileName - Filnamn f�r filen som skall kontrolleras.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellstr�m
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
*	Funktionen validateSongFormData kontrollerar att indata i formul�ret "frmNewUpdateSong" uppfyller
*	givna villkor. Om alla villkor uppfylls returneras sant om inte visas en dialogruta med "felet" och
*	d�refter returneras falskt.
*	@returns {Boolean}
*	@version 1.0
*	@author Peter Bellstr�m
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
	//Klicka p� save i formul�ret
	$("form#frmNewUpdateSong").on("submit", function(theEvent){
		validateSongFormData();

		if( validateSongFormData() == false ){
			theEvent.preventDefault();
			theEvent.stopPropagation();
		}
	});

	//Klicka p� reset i formul�ret
	$("form#frmNewUpdateSong .btnReset").on("click", function(){
		resetSongFormData();
	});

	//Klicka p� Delete
	$(".accordion form").each(function(){
		$(this).on("submit", function(theEvent){
			var id = $(this).find("input[name='hidId']").val();
			var title = $(this).find("input[name='hidTitle']").val();


			if( verifyDeleteOfSong(id, title) == false ){
				theEvent.preventDefault();
				theEvent.stopPropagation();
			}
		});
	});

	//Klicka p� Edit
	$(".accordion form").each(function(){
		formRef = $(this);

		var id = $(formRef).find("input[name='hidId']").val();
		var filnamn = $(formRef).find("input[name='hidSoundFileName']").val();
		var artistId = $(formRef).find("input[name='hidArtistId']").val();
		var title = $(formRef).find("input[name='hidTitle']").val();
		var count = $(formRef).find("input[name='hidCount']").val();
		

		$(formRef).find("input[name='btnEdit']").on("click", function(){
			copySongFormData( id, filnamn , artistId, title, count );
		});
	});
});

