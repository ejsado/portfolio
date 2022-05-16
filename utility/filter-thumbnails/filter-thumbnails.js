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

// return true if all project thumbnails are hidden
function allHidden() {
	for (let element of projectThumbnails) {
		if (!element.classList.contains("filter-hide")) {
			return false;
		}
	}
	return true;
}

// remove first 7 chars from string ('filter-')
function getFilterNameFromId(elementIdString) {
	return elementIdString.slice(7);
}

// return true if ANY ONE of these class names are found in tokenList
function containsOneOfManyClasses(classArray, tokenList) {
	// no required filters are set, this is accepted
	if (classArray.length == 0) {
		return true;
	}
	for (const className of classArray) {
		if (tokenList.contains(className)) {
			return true;
		}
	}
	return false;
}

// return true if ALL class names are found in tokenList
function containsAllClasses(classArray, tokenList) {
	// no required filters are set, this is accepted
	if (classArray.length == 0) {
		return true;
	}
	for (const className of classArray) {
		if (!tokenList.contains(className)) {
			return false;
		}
	}
	return true;
}

// create an array of class names from checkboxes that are checked
function classNameArray(checkboxGroup) {
	let filterShow = [];
	for (let checkbox of checkboxGroup) {
		if (checkbox.checked == true) {
			filterShow.push(getFilterNameFromId(checkbox.id));
		}
	}
	return filterShow;
}

// iterate through filter checkboxes
// get class names of filters
// add 'filter-hide' class to thumbnails not containing filter classes
function updateFilter(allArray, anyArray) {
	for (let thumbnail of projectThumbnails) {
		if (containsAllClasses(allArray, thumbnail.classList) && 
			containsOneOfManyClasses(anyArray, thumbnail.classList)) {
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
	// remove star from filters button
	collapseButton.classList.remove("filters-active");
	noResults.classList.remove("filter-show");
}

// reset all filters
// set all checkboxes to false
function clearFilters() {
	for (let checkbox of filterCheckboxes) {
		checkbox.checked = false;
	}
	displayAll();
}

// only allow one category to be selected
function deselectOthers(checkbox, selectedGroup) {
	const checkboxGroup = document.getElementsByName(selectedGroup);
	for (let element of checkboxGroup) {
		if (element.id != checkbox.id && element.type == "checkbox") {
			element.checked = false;
		}
	}
}


// create an array with all the available filters
const filterCheckboxes = document.getElementsByClassName('filter-checkbox');

// array of all thumbnails to filter
const projectThumbnails = document.getElementsByClassName("project-thumbnail");

// get the filter collapse button
const collapseButton = document.getElementById('collapse-label');

// filters operating with AND
const filterAnd = document.getElementsByName("category");

// filters operating with OR
const filterOr = document.getElementsByName("tool");

// no results message 
const noResults = document.getElementById("filter-no-results");

// add event listeners for checkbox changes
for (let checkbox of filterCheckboxes) {
	checkbox.addEventListener('change', (event) => {
		// if any filters are active, update the thumbnails
		if (filtersActive()) {
			// add star from filters button
			collapseButton.classList.add("filters-active");
			if (event.currentTarget.name == "category") {
				deselectOthers(event.currentTarget, event.currentTarget.name);
			}
			updateFilter(classNameArray(filterCheckboxes), []);
			if (allHidden()) {
				noResults.classList.add("filter-show");
			} else {
				noResults.classList.remove("filter-show");
			}
		} else {
			// else display all thumbnails
			displayAll();
		}
	});
}