//searchFunctions.js
$(document).ready(function(){

	//Visa/göm kommentarer
	$("div[data-comments='comments']").each(function(){
		$(this).css("display", "none");

		var commentsRef = $(this);

		var aRef = $("<a>", {"href":"#", "text": "Show comments"}).insertBefore(commentsRef);
		$("<br/>").insertAfter(aRef);

		aRef.on("click", function(theEvent){
			theEvent.preventDefault();
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
			theEvent.preventDefault();
			theEvent.stopPropagation();

			//Visa/göm <p> som ligger i länken
			formRef.slideToggle();
		});
	});

	// Lägg till likes med AJAX
	$("a[data-id]").each(function(){
		var lank = $(this);
		$(this).on("click", function(theEvent){
			theEvent.preventDefault();
			theEvent.stopPropagation();
			
			var count = $("span[data-id="+lank.attr("data-id")+"]").text();
			var latid = lank.attr("data-id");

			$.ajax({
				timeout: 5000,
				dataType: "json",
				type: "post",
				data: { "count": count, "latid": latid },
				url: "ajax/likesong.php",
				success: function(ajaxReturnData){
					// Stoppa in data på sidan här, med hjälp av jQuery					
					$("span[data-id="+lank.attr("data-id")+"]").text(ajaxReturnData.like);
				},
				error: function(xhr, status, error){
					alert(xhr.responseText + " : " + status + " : " + error);
				},
				complete: function(xhr, status){}
			});
		});
	});

	// Lägg till kommentar med AJAX
	$("form[name='frmcomment']").each(function(){
		var form = $(this);
		$(this).on("submit", function(theEvent){
			theEvent.preventDefault();
			theEvent.stopPropagation();

			//Skapa variabler
			var id = $(form).find($("input[name='hidId']")).val();
			var text = $(form).find($("textarea")).val();

			$.ajax({
				timeout: 5000,
				dataType: "json",
				type: "post",
				data: { "id" : id , "text" : text },
				url: "ajax/savecomment.php",
				success: function(ajaxReturnData){
					//JSON
					// Stoppa in data på sidan här, med hjälp av jQuery
					var kommentar = "<p><b>"+ ajaxReturnData.date +":</b> ";
					kommentar += "<i>"+ ajaxReturnData.comment +"</i></p>";

					$("div[data-id="+form.attr("data-id")+"]").append(kommentar);
				},
				error: function(xhr, status, error){
					alert(xhr.responseText + " : " + status + " : " + error);
				},
				complete: function(xhr, status){
					// Töm textarean
					$(form).find($("textarea")).val("");
				}
			});
		});
	});
});