/*


	swCV script.js file
	Hppsrc 2026
	Based on version 0.2.0-alpha
	? General usage Javascript
*/

let overlay = document.getElementById("overlay");

// used for "dashboard/*.php" views
function ajax(obj) {
	overlay.style.position = "fixed";
	fetch("?v=api&a=ajax&r=" + obj.id + "&d=" + obj.checked, {
		method: "POST",
	})
		.then((data) => data.json())
		.then((json) => {
			if (json.error) {
				alert("Error: " + json.error);
				console.error(json.details);
			}

			if (json.ok) {
				alert(json.response);
			}

			if (json) {
				switch (json.update) {
					case "set_checked":
						obj.checked = true;
						break;

					case "set_unchecked":
						obj.checked = false;
						break;

					case "set_disabled":
						obj.checked = false;
						obj.disabled = "true";
						break;
				}
			}

			return;
		});
	overlay.style.position = "unset";
}

function ajax_lang(obj) {
	overlay.style.position = "fixed";
	fetch("?v=api&a=ajax&r=system_language&d=" + obj.value, {
		method: "POST",
	})
		.then((data) => data.json())
		.then((json) => {
			if (json.error) {
				alert("Error: " + json.error);
				console.error(json.details);
			}

			if (json.ok) {
				alert(json.response);
				location.reload();
			}

			return;
		});
	overlay.style.position = "unset";
}
