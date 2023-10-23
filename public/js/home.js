const flagsElement = document.getElementById("flags");
const textToChange = document.querySelectorAll("[data-section]");

const changeLanguage = async (language) => {
	const requestJson = await fetch(`./lang/${language}.json`);
	const texts = await requestJson.json();

	textToChange.forEach((element) => {
		const section = element.dataset.section;
		const value = element.dataset.value;

		element.innerHTML = texts[section][value];
	});
};

flagsElement.addEventListener("click", (e) => {
	changeLanguage(e.target.dataset.language);
});
