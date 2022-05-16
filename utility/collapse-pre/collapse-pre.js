// collapse all pre elements (code snippets)
// add a button to show/hide the snippet

// return a new html input checkbox with specified ID
function createNewCheckbox(id) {
	const checkbox = document.createElement("input");
	checkbox.type = "checkbox";
    checkbox.id = id;
	checkbox.className = "collapse-pre-checkbox";
    checkbox.name = "collapse-pre";
	checkbox.checked = true;
	return checkbox;
}

// return a new label for the specified input ID and add text pertaining to the code language
function createNewLabel(forId, codeLanguage) {
	const label = document.createElement("label");
	label.htmlFor = forId;
	label.className = "collapse-pre-label";
    label.appendChild(document.createTextNode(codeLanguage + " code"));
	return label;
}

// get the specified language of the code snippet
function getPreLanguage(preElement) {
	// code language is supplied by class name on the code element within the pre element
	const codeElement = preElement.getElementsByTagName("code").item(0);
	for (let classValue of codeElement.classList.entries()) {
		const className = classValue[1];
		if (className.startsWith("language-")) {
			// get the language name without the prefix
			const codeLanguage = className.slice(9);
			if (codeLanguage == "none") {
				return "";
			} else {
				return codeLanguage;
			}
		}
	}
	return "";
}

// get the parent element of all the pre elements
const preParent = document.getElementById("project-report");

// get all the the pre elements within the parent
const allPreElements = preParent.getElementsByTagName("pre");

// loop through all the pre elements
for (let i = 0; i < allPreElements.length; i++) {
	// get current element
	const currentPre = allPreElements.item(i);
	// define unique id for input and label
	const inputId = "collapse-pre-" + i;
	// get the language of the code snippet to display text
	const codeLanguage = getPreLanguage(currentPre);
	// add the checkbox before the pre
	preParent.insertBefore(	createNewCheckbox(inputId),
							currentPre);
	// add the label after the checkbox but before the pre
	preParent.insertBefore(	createNewLabel(inputId, codeLanguage),
							currentPre);
}