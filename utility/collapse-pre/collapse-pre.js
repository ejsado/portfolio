// collapse all pre elements (code snippets)
// add a button to show/hide the snippet

function createNewCheckbox(id) {
	const checkbox = document.createElement("input");
	checkbox.type = "checkbox";
    checkbox.id = id;
	checkbox.class = "collapse-pre-checkbox";
    checkbox.name = "collapse-pre";
	return checkbox;
}

function createNewLabel(forId, codeLanguage) {
	const label = document.createElement("label");
	label.htmlFor = forId;
    label.appendChild(document.createTextNode(codeLanguage + " code"));
	return label;
}

function getPreLanguage(preElement) {
	preElement.classList.forEach(className => {
		if (className.startsWith("language-")) {
			return className.slice(9);
		}
	});
	return false;
}

const allPreElements = document.getElementsByTagName("pre");

const preParent = document.getElementById("project-report");

for (let i = 0; i < allPreElements.length; i++) {
	const currentPre = allPreElements.item(i);
	const inputId = "collapse-pre-" + i;
	const codeLanguage = getPreLanguage(currentPre);
	preParent.insertBefore(	createNewCheckbox(inputId),
							createNewLabel(inputId, getPreLanguage(currentPre)));
}