// filter project thumbnails on the home page

// define functions

function filtersActive() {
	for (let element of filterCheckboxes) {
		if (element.checked == true) {
			return true;
		}
	}
	return false;
}

function getFilterNameFromId(elementIdString) {
	return elementIdString.slice(7);
}

function containsOneOfManyClasses(classArray, tokenList) {
	for (const className of classArray) {
		if (tokenList.contains(className)) {
			return true;
		}
	}
	return false;
}

function updateFilter() {
	let filterShow = [];
	for (let checkbox of filterCheckboxes) {
		if (checkbox.checked == true) {
			filterShow.push(getFilterNameFromId(checkbox.id));
		}
	}
	console.log(filterShow);
	for (let thumbnail of projectThumbnails) {
		if (containsOneOfManyClasses(filterShow, thumbnail.classList)) {
			thumbnail.classList.remove("filter-hide");
		} else {
			thumbnail.classList.add("filter-hide");
		}
	}
}

function displayAll() {
	for (let thumbnail of projectThumbnails) {
		thumbnail.classList.remove("filter-hide");
	}
}

function clearFilters() {
	for (let checkbox of filterCheckboxes) {
		checkbox.checked = false;
	}
	displayAll();
	collapseButton.classList.remove("filters-active");
}


// create an array with all the available filters
const filterCheckboxes = document.getElementsByClassName('filter-checkbox');

// array of all thumbnails to filter
const projectThumbnails = document.getElementsByClassName("project-thumbnail");

// get the filter collapse button
const collapseButton = document.getElementById('collapse-label');

// add event listeners for checkbox changes
for (let checkbox of filterCheckboxes) {
	checkbox.addEventListener('change', (event) => {
		if (filtersActive()) {
			console.log("at least one filter is set");
			collapseButton.classList.add("filters-active");
			updateFilter();
		} else {
			console.log("no filters are set");
			collapseButton.classList.remove("filters-active");
			displayAll();
		}
	});
}