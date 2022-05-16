## Summary

A majority of our federally public land is west of the Mississippi River, but it is not distributed equally. Certain states contain much more federal land than the others. In terms of percentage covered by federal land, Nevada is first by a large margin.

1. **84.9%** - Nevada
2. **64.9%** - Utah
3. **61.6%** - Idaho
4. **61.2%** - Alaska
5. **52.9%** - Oregon

> [Federal land ownership by state - Ballotpedia](https://ballotpedia.org/Federal_land_ownership_by_state)

With such a small percentage not covered by federal land, **what does land ownership look like in Nevada?**

---

## Data Acquisition

I downloaded the Surface Management Agency shapefile from the BLM website under the section labeled "Lands (Ownership)."

> [Nevada GIS Data - Bureau of Land Management](https://www.blm.gov/services/geospatial/GISData/nevada)  
> Surface Management Agency (SMA)  
> Published: 11/10/2021  
> The Surface Management Agency (SMA) dataset — often referred to as land ownership — was created to display the management status of the land through the BLM Administrative State of Nevada. In 2010 it was updated to be coincident with GCDB lines from Premier data. The ownership for each smallest division was identified by the previous land status layer. In areas of confusion or pieces that were divided in areas smaller then GCDB, the MTP was referenced as the final authoritative source. This project was completed 8/10/10, and is updated as necessary. Updates have not occurred to bring the dataset into alignment with the most current CadNSDI PLSS data and there are known alignment errors.

This dataset lists divides known land owners into the following categories. I have further simplified their categorization into four groups, noted in parenthesis.

- Bureau of Indian Affairs (Indian)
- Private (Private)
- City of Las Vegas (State)
- Clark County, NV (State)
- Nevada State (State)
- Regional Park (State)
- Bureau of Land Management (Federal)
- Bureau of Reclamation (Federal)
- Department of Defense (Federal)
- Department of Energy (Federal)
- Forest Service (Federal)
- Fish and Wildlife Service (Federal)
- National Park Service (Federal)

Note that there are several areas in this dataset that are uncategorized. This may account for the discrepancy between my statistical calculations and the data summarized by [Ballotpedia](https://ballotpedia.org/Federal_land_ownership_by_state) as seen above.

---

## Process

Although I only need to symbolize a singular dataset, I tried to do as much with `arcpy` as I could. `Arcpy` is ESRI’s python library for desktop geoprocessing. It allows you to automate workflows with code rather than a user interface.

Unfortunately, `arcpy` does not allow the automation of every ArcGIS Pro function. For this project, I wanted to create four maps, but I could not do this with code. I had to create new empty maps manually (with the UI) and I used `arcpy` to add data and manipulate symbology within each map. This makes it especially easy to update all of the maps with new colors if needed. 

```python
import arcpy

# open project
aprx = arcpy.mp.ArcGISProject(r"D:\path\to\arcgispro\project.aprx")
# list the maps (5 total)
mapList = aprx.listMaps()

# define colors for symbology
federalLandColor = {"RGB" : [55,112,175,100]}
stateLandColor = {"RGB" : [112,173,55,100]}
privateLandColor = {"RGB" : [175,110,55,100]}
indianLandColor = {"RGB" : [175,55,100,100]}

# search the input map list for a specific layer name
def getLandLayer(mapLayerList):
	for mapLayer in mapLayerList:
		if mapLayer.name == "BLM_NV_SMA":
			return mapLayer
	# return false if the layer is not found
	return False

# iterate through each map in the map list
for currentMap in mapList:
	# get the layers in the map
	mapLayers = currentMap.listLayers()
	# find the layer with the land data
	landLayer = getLandLayer(mapLayers)
	# if the layer doesn't exist, add it
	if landLayer == False:
		landLayer = currentMap.addDataFromPath(r"D:\path\to\shapefile.shp")
	print(landLayer.name)
	# get the symbology of the land data layer
	sym = landLayer.symbology
	# set the type of symbology to display
	# in this case, use unique values to 
	# show specific areas as specific colors
	sym.updateRenderer('UniqueValueRenderer')
	# iterate through the symbology groups, there is likely only 1
	for grp in sym.renderer.groups:
		print("remove all items from " + grp.heading)
		# remove all symbology values from each group
		if len(grp.items) > 0:
			sym.renderer.removeValues({grp.heading : grp.items})
	# apply the symbology
	landLayer.symbology = sym

	# apply different colors depending the map name
	# apply rules for federal lands
	if currentMap.name == "Nevada Federal Lands":
		print("configure " + currentMap.name)
		# add these values as unique values to the 
		# symbology group called NAME
		# NAME is the field of the attribute table that 
		# contains these values to be symbolized
		sym.renderer.addValues({"NAME" : [
			"Bureau of Land Management",
			"Bureau of Reclamation",
			"Department of Defense",
			"Department of Energy",
			"Forest Service",
			"Fish and Wildlife Service",
			"National Park Service"
		]})
		# apply the symbology
		landLayer.symbology = sym
		# for each group (1)
		for grp in sym.renderer.groups:
			# make sure we are operating in the NAME group
			if grp.heading == "NAME":
				# for each item that we added above
				for itm in grp.items:
					# set the color to the defined values (above)
					itm.symbol.color = federalLandColor
					# set the size of the outline to 0
					itm.symbol.size = 0
	
	# apply rules for state lands
	if currentMap.name == "Nevada State Lands":
		print("configure " + currentMap.name)
		# add these values as unique values to the 
		# symbology group called NAME
		# NAME is the field of the attribute table that 
		# contains these values to be symbolized
		sym.renderer.addValues({"NAME" : [
			"City of Las Vegas",
			"Clark County, NV",
			"Nevada State",
			"Regional Park"
		]})
		# apply the symbology
		landLayer.symbology = sym
		# for each group (1)
		for grp in sym.renderer.groups:
			# make sure we are operating in the NAME group
			if grp.heading == "NAME":
				# for each item, apply a color and set the 
				# size of the outline to 0
				for itm in grp.items:
					itm.symbol.color = stateLandColor
					itm.symbol.size = 0
	
	# apply similar rules for private lands
	if currentMap.name == "Nevada Private Lands":
		print("configure " + currentMap.name)
		sym.renderer.addValues({"NAME" : [
			"Private"
		]})
		landLayer.symbology = sym
		for grp in sym.renderer.groups:
			if grp.heading == "NAME":
				for itm in grp.items:
					itm.symbol.color = privateLandColor
					itm.symbol.size = 0
	
	# apply similar rules for indian lands
	if currentMap.name == "Nevada Indian Lands":
		print("configure " + currentMap.name)
		sym.renderer.addValues({"NAME" : [
			"Bureau of Indian Affairs"
		]})
		landLayer.symbology = sym
		for grp in sym.renderer.groups:
			if grp.heading == "NAME":
				for itm in grp.items:
					itm.symbol.color = indianLandColor
					itm.symbol.size = 0
	
	# apply similar rules for an overview map (not shown in map image)
	if currentMap.name == "Nevada Land Ownership":
		print("configure " + currentMap.name)
		sym.renderer.addValues({"NAME" : [
			"Bureau of Indian Affairs",
			"Private",
			"City of Las Vegas",
			"Clark County, NV",
			"Nevada State",
			"Regional Park",
			"Bureau of Land Management",
			"Bureau of Reclamation",
			"Department of Defense",
			"Department of Energy",
			"Forest Service",
			"Fish and Wildlife Service",
			"National Park Service"
		]})
		landLayer.symbology = sym
		for grp in sym.renderer.groups:
			if grp.heading == "NAME":
				for itm in grp.items:
					# it looks silly, but this version of 
					# python doesn't have a switch case...
					if itm.label == "Bureau of Indian Affairs":
						itm.symbol.color = indianLandColor
						itm.symbol.size = 0
					if itm.label == "Private":
						itm.symbol.color = privateLandColor
						itm.symbol.size = 0
					if (   itm.label == "City of Las Vegas" 
						or itm.label == "Clark County, NV" 
						or itm.label == "Nevada State" 
						or itm.label == "Regional Park"):
						itm.symbol.color = stateLandColor
						itm.symbol.size = 0
					if (   itm.label == "Bureau of Land Management" 
						or itm.label == "Bureau of Reclamation" 
						or itm.label == "Department of Defense" 
						or itm.label == "Department of Energy" 
						or itm.label == "Forest Service" 
						or itm.label == "Fish and Wildlife Service" 
						or itm.label == "National Park Service"):
						itm.symbol.color = federalLandColor
						itm.symbol.size = 0
	# apply the symbology
	landLayer.symbology = sym

# write the changes to the project file on disk
aprx.save()

```

