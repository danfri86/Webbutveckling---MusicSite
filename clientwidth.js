/*
*
* client.js
* @author Alexander Hansson
* @twitter @hejhansson
* @uri http://alxndr.se
* @version 0.1
*
*/


window.onload = function() {

    // Creating our <p> before the interval. 
    var el = document.createElement("p");

    // Style that <p>.
    el.style.padding = "8px 12px";
    el.style.backgroundColor = "#34495e";
    el.style.display = "inline-block";
    el.style.color = "white";
    el.style.position = "fixed";
    el.style.bottom = "5px";
    el.style.right = "15px";
    el.style.fontFamily = "sans-serif";
    el.style.textAlign = "center";
    el.style.borderRadius = "3px";
    el.style.opacity = ".8";

	setInterval(function() {	

		// Get width of browser.
		var offsetWidth = document.documentElement.clientWidth;

		// Get height if browser.
		var offseHeight = document.documentElement.clientHeight;

		// Append <p> to <body>.
		document.body.appendChild(el);
        
        var pixelRatio = window.devicePixelRatio;

		var device = "Desktops and laptops";

        if (pixelRatio == 2) {
            offsetWidth = offsetWidth * 2;
        }

		if (offsetWidth < 1024) {
			var device = "Tablet";
		}

		if (offsetWidth < 600) {
			device = "Mobile";
		}
        
            if (offsetWidth > 1824) {
                device = "Larger screen";
            }

            // Fill our <p> with the data.
            el.innerHTML = offsetWidth + " x " + offseHeight + "<br>" + device + "<br>" + "devicePixelRatio: " + pixelRatio;

	}, 100);
};


