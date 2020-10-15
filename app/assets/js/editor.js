$("[contenteditable=true]").keypress(function (e) {
	"use strict";
	return e.which != 13;
});

function update(jscolor) {
	"use strict";
	document.getElementsByClassName('accentApply')[0].style.backgroundColor = '#' + jscolor;
	document.getElementsByClassName('accentApply')[1].style.backgroundColor = '#' + jscolor;
	document.getElementsByClassName('lw-active')[0].style.backgroundColor = '#' + jscolor;
};

document.getElementById('titleFiller').oninput = (e) => {
	document.getElementById('titleTextarea').value = document.getElementById('titleFiller').innerText;
};
document.getElementById('subtitleFiller').oninput = (e) => {
	document.getElementById('subtitleTextarea').value = document.getElementById('subtitleFiller').innerText;
};
document.getElementById('tyTitleFiller').oninput = (e) => {
	document.getElementById('tyTitleTextarea').value = document.getElementById('tyTitleFiller').innerText;
};
document.getElementById('tySubtitleFiller').oninput = (e) => {
	document.getElementById('tySubtitleTextarea').value = document.getElementById('tySubtitleFiller').innerText;
};

function myFunction() {
	"use strict";
	var x = document.getElementById("emojiContainer");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

$("#buttonDefault").addClass("btn-dark text-white");
$("#thank-you").hide();

$("#buttonDefault").click(function () {
	"use strict";
	$("#default").show();
	$("#thank-you").hide();
	$("#buttonDefault").addClass("btn-dark text-white");
	$("#buttonThankyou").removeClass("btn-dark text-white");
});

$("#buttonThankyou").click(function () {
	"use strict";
	$("#default").hide();
	$("#thank-you").show();
	$("#buttonThankyou").addClass("btn-dark text-white");
	$("#buttonDefault").removeClass("btn-dark text-white");
});

$(function () {
	"use strict";
	var request;

	$("#editorForm").on("submit", function (event) {

		event.preventDefault();

		if (request) {
			request.abort();
		}
		var $form = $(this);

		var serializedData = $form.serialize();

		$("#saveBtn").addClass("btn-loading disabled");

		request = $.ajax({
			url: "../../../functions/pages/editor.php",
			type: "post",
			data: serializedData,
			crossDomain: true
		});

		request.done(function (response, textStatus, jqXHR) {

			$("#saveBtn").removeClass("btn-loading disabled");

			$("#response").html('<div id="alertSlide" class="alert bg-success text-white text-center rounded-0"><i class="far fa-check mr-3"></i> Success, your changes have been saved.</div>')

			$("#alertSlide").fadeTo(2000, 500).slideUp(500, function () {
				"use strict";
				$("#alertSlide").slideUp(500);
			});

		});

		request.fail(function (jqXHR, textStatus, errorThrown) {
			console.error(
				"The following error occurred: " +
				textStatus, errorThrown
			);
		});

	});
});
