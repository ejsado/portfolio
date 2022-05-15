// filter project thumbnails on the home page

// define functions

// return true if any filters are enabled
function filtersActive() {
	for (let element of filterCheckboxes) {
		if (element.checked == true) {
			return true;
		}
	}
	return false;
}

// remove first 7 chars from string ('filter-')
function getFilterNameFromId(elementIdString) {
	return elementIdString.slice(7);
}

// return true if any class names are found in tokenList
function containsOneOfManyClasses(classArray, tokenList) {
	for (const className of classArray) {
		if (tokenList.contains(className)) {
			return true;
		}
	}
	return false;
}

// iterate through filter checkboxes
// get class names of filters
// add 'filter-hide' class to thumbnails not containing filter classes
function updateFilter() {
	let filterShow = [];
	for (let checkbox of filterCheckboxes) {
		if (checkbox.checked == true) {
			filterShow.push(getFilterNameFromId(checkbox.id));
		}
	}
	for (let thumbnail of projectThumbnails) {
		if (containsOneOfManyClasses(filterShow, thumbnail.classList)) {
			thumbnail.classList.remove("filter-hide");
		} else {
			thumbnail.classList.add("filter-hide");
		}
	}
}

// remove all 'filter-hide' classes from thumbnails
function displayAll() {
	for (let thumbnail of projectThumbnails) {
		thumbnail.classList.remove("filter-hide");
	}
}

// reset all filters
// set all checkboxes to false
function clearFilters() {
	for (let checkbox of filterCheckboxes) {
		checkbox.checked = false;
	}
	displayAll();
	// remove star from filters button
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
		// if any filters are active, update the thumbnails
		if (filtersActive()) {
			// add star from filters button
			collapseButton.classList.add("filters-active");
			updateFilter();
		} else {
			// else display all thumbnails
			// remove star from filters button
			collapseButton.classList.remove("filters-active");
			displayAll();
		}
	});
}