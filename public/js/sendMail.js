let form = document.getElementById("contactForm");

// form.addEventListener("submit", function (e) {
// 	e.preventDefault();

// 	// Containers requireds
// 	let requiredName = document.getElementById("requiredName");
// 	let requiredEmail = document.getElementById("requiredEmail");
// 	let validEmail = document.getElementById("validEmail");
// 	let requiredPhone = document.getElementById("requiredPhone");
// 	let requiredMessage = document.getElementById("requiredMessage");

// 	requiredName.style.display = "none";
// 	requiredEmail.style.display = "none";
// 	validEmail.style.display = "none";
// 	requiredPhone.style.display = "none";
// 	requiredMessage.style.display = "none";

// 	let name = document.getElementById("name").value;
// 	let email = document.getElementById("email").value;
// 	let phone = document.getElementById("phone").value;
// 	let message = document.getElementById("message").value;

// 	if (name == "") {
// 		requiredName.style.display = "block";
// 		return false;
// 	}

// 	if (email == "") {
// 		requiredEmail.style.display = "block";
// 		return false;
// 	}

// 	if (phone == "") {
// 		requiredPhone.style.display = "block";
// 		return false;
// 	}

// 	if (message == "") {
// 		requiredMessage.style.display = "block";
// 		return false;
// 	}

// 	var validEmailRegex = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

// 	if (!validEmailRegex.test(email)) {
// 		validEmail.style.display = "block";
// 		return false;
// 	}

// 	sendDataForm(name, email, phone, message);
// });

function sendDataForm(name, email, phone, message) {
	let json = {
		name: name,
		email: email,
		phone: phone,
		message: message,
	};

	fetch("./controller/sendMailController.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		muteHttpExceptions: "true",
		body: JSON.stringify(json),
	})
		.then((response) => response.json())
		.then((data) => {
			console.log(data);
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}
