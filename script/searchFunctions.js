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

	// Lägg till likes med AJAX
	$("a[data-id]").each(function(){
		var lank = $(this);
		$(this).on("click", function(){
			$.ajax({
				timeout: 5000,
				dataType: "json",
				type: "post",
				url: "ajax/likesong.php",
				success: function(ajaxReturnData){
					//alert(ajaxReturnData);

					// Stoppa in data på sidan här, med hjälp av jQuery					
					$("span[data-id="+lank.attr("data-id")+"]").text(ajaxReturnData.like);
				},
				error: function(xhr, status, error){
					alert(xhr.satusText + " : " + status + " : " + error);
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

			$.ajax({
				timeout: 5000,
				dataType: "json",
				type: "post",
				url: "ajax/savecomment.php",
				success: function(ajaxReturnData){
					alert(ajaxReturnData);

					/*
					// XML
					var kommentar = "<p><b>"+ $(ajaxReturnData).find("date").text() +":</b> ";
					kommentar += "<i>"+ $(ajaxReturnData).find("comment").text() +"</i></p>";
					*/

					//JSON
					// Stoppa in data på sidan här, med hjälp av jQuery
					var kommentar = "<p><b>"+ ajaxReturnData.date +":</b> ";
					kommentar += "<i>"+ ajaxReturnData.comment +"</i></p>";

					$("div[data-id="+form.attr("data-id")+"]").append(kommentar);
				},
				error: function(xhr, status, error){
					alert(xhr.satusText + " : " + status + " : " + error);
				},
				complete: function(xhr, status){}
			});
		});
	});
});