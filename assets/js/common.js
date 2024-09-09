function dateThToISO(dateStr) {
	myArray = dateStr.split("/");
	year = parseInt(myArray[2]) - 543;
	month = myArray[1];
	day = myArray[0];
	dateISO = "" + year + "-" + month + "-" + day;
	return dateISO;
}

function dateISOToTh(dateStr) {
	myArray = dateStr.split("-");
	year = parseInt(myArray[0]) + 543;
	month = myArray[1];
	day = myArray[2];
	dateISO = "" + day  + "/" + month + "/" + year;
	return dateISO;
}

function getLocalDate(val, full = true) {
    options = {
        year: 'numeric', month: '2-digit', day: '2-digit'
    };
    val = val.replace(" ", 'T');
	const d = new Date(val);
	str = new Intl.DateTimeFormat('th-TH', options).format(d);
	return str;
}

function getLocalDateTime(val, full = true) {
	let isMobile = window.screen.width <= 1024 ? true : false; // for mobile
    isMobile = false;
	let time = " น.";
	options = {
		year: 'numeric', month: '2-digit', day: '2-digit',
		hour: '2-digit', minute: '2-digit', second: '2-digit',
		hour12: false
	};

	if (isMobile) {
		options = {
			year: 'numeric', month: '2-digit', day: '2-digit'
		};
		time = "";
	}

    val = val.replace(" ", 'T');
	const d = new Date(val);
	str = new Intl.DateTimeFormat('th-TH', options).format(d);
	// str = new Intl.DateTimeFormat('th-TH', options).format(d) + time;
	return str;
}

function confirmLogout() {
	event.preventDefault();
	//alert("logout");
	Swal.fire({
		text: "คุณแน่ใจหรือไม่...ที่จะออกจากการทำงานนี้?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		cancelButtonColor: '#8a8a8a',
		confirmButtonText: 'ใช่! ออกเลย',
		cancelButtonText: 'ไม่! ยกเลิก'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = "../logout.php";
		}
	});
	// $("#logout").style("text-decoration:none;");
	// $('#logout').css('text-decoration','none !important;');
	// style="text-decoration:none;
}

function changeDarkMode(elem) {
	if(elem.checked) {
		$("body").removeClass("dark-mode");
	}
	else {
		$("body").addClass("dark-mode");
	}
	localStorage.setItem("DarkMode", JSON.stringify(elem.checked))
}

function loadDark() {
	//default is light mode
	let dark = JSON.parse(localStorage.getItem("DarkMode"));
	if (dark === null) {
		localStorage.setItem("DarkMode", JSON.stringify(false))
		$("body").removeClass("dark-mode");
	} else if (dark === false) {
		$("body").addClass("dark-mode");
		$('#darkMode').removeAttr('checked');
		// $('#darkMode').prop('checked', false);
	} else if (dark === true) {
		$("body").removeClass("dark-mode");
		$('#darkMode').prop('checked');
	}
}

function loaderScreen(value) {
	if( value === "show" )
		$('#loaderScreen').show();
	else
		$('#loaderScreen').hide();

}
// $("body").removeClass("dark-mode");
// $('#darkMode').prop('checked');
// loadDark();
