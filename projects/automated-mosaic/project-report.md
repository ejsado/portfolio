## Summary

In my attempt to gather Landsat imagery for another project, the place I wanted to focus on happened to be at the edge of 3 different scene captures. I wanted to create a Mosaic Dataset in ArcGIS Pro to merge these 3 scenes into one seamless mosaic so the area I want to analyze is completely covered by imagery. 

---

## Workflow

I acquired my Landsat scenes from [USGS Earth Explorer](https://earthexplorer.usgs.gov/). I used Collection 2 Level 2 imagery which is processed to a higher degree than Collection 1 or Level 1. Each scene includes TIF image bands and metadata files with MTL in their filenames.

First, define the options and which operations should be executed. It is assumed a geodatabase exists.

```python
import arcpy

# environment settings
# set the geodatabase where the script will create items
arcpy.env.workspace = r"D:\path\to\geodatabase.gdb"
# overwrite items in the workspace with items created by this script
# if this is false, an error will occur when an item already exists
arcpy.env.overwriteOutput = True

# script settings

# show output of each geoprocessing tool
# https://pro.arcgis.com/en/pro-app/2.8/arcpy/geoprocessing_and_python/using-tools-in-python.htm
verboseOutput = True

# imagery type
# must be one of the following:
#   LANDSAT_6BANDS - Create a 6-band mosaic dataset using the Landsat 5 and 7 wavelength ranges from the TM and ETM+ sensors.
#   LANDSAT_8BANDS - Create an 8-band mosaic dataset using the LANDSAT 8 wavelength ranges.
# based off product_definition values:
#   https://pro.arcgis.com/en/pro-app/latest/tool-reference/data-management/create-mosaic-dataset.htm
# other types could be supported by adding logic to find and organize other file naming structures
imageryType = "LANDSAT_8BANDS"

# select which operations to perform
createRasterComposites = True
createMosaicDataset = True
addRastersToMosaic = True
buildFootprints = True
buildSeamlines = True

# text to append to raster composites
compositeText = "_composite"

# full path to directory where the images are stored
imagesFolder = r"D:\path\to\Landsat\scenes"

# name of the mosaic to be edited
mosaicName = "Landsat8Mosaic"

```

Find and catalog the Landsat scenes in the directory based on the MTL text files.

```python
# scan a directory for MTL text files and TIF files
# return a list of dictionaries with the scene name, MTL file, list of TIFs, and associated raster composite
# scenes can be in subfolders, but related MTL and TIF files must be in the same directory
def find_landsat_scenes(directory):
	# scene dictionary will have pairs (key: value)
	# (name: scene name)
	# (mtl: path to mtl file)
	# (images: [list of TIF files])
	# (composite: path to composite raster)
	landsatScenes = []
	# iterate through the MTL text files
	for mtl in glob.glob(directory + r"\**\*_MTL.txt", recursive=True):
		splitPath = mtl.split("\\")
		# get the scene name from the MTL file
		sceneName = splitPath[-1][:-8]
		print("found scene: " + sceneName)
		# get the path to the containing folder
		sceneDir = "\\".join(splitPath[:-1])
		tifList = []
		# find all TIFs in that containing folder
		allTifs = glob.glob(sceneDir + r"\*.TIF")
		# find any related TIFs and add them to the image list
		for tif in allTifs:
			if sceneName in tif:
				tifList.append(tif)
		# check if the composite raster already exists for this scene
		compName = sceneName + compositeText
		compositePath = None
		if arcpy.Exists(compName):
			# if it exists, set it to the full path
			compositePath = arcpy.env.workspace + "\\" + compName
		# if related TIFs were found, add the scene to the list
		if len(tifList) > 0:
			landsatScenes.append(
				{
					"name": sceneName,
					"mtl": mtl,
					"images": tifList,
					"composite": compositePath
				}
			)
	return landsatScenes

```

It is possible to add each MTL text file directly into the Mosaic Dataset; ArcGIS Pro will recognize and add the appropriate image bands automatically. But, through trial and error I found that creating a raster composite of each scene and adding that to the mosaic provides a much more consistent color scheme across scenes from different dates. 

```python
	# index all MTL and related files
	sceneList = find_landsat_scenes(imagesFolder)
	# exit if no scenes (MTLs) were found
	if len(sceneList) == 0:
		sys.exit("No scenes found.")
	if createRasterComposites:
		print("creating composite rasters")
		for scene in sceneList:
			compositeName = scene["name"] + compositeText
			print("create composite: " + compositeName)
			# run the geoprocessing tool to create each composite raster
			result = arcpy.CompositeBands_management(scene["mtl"], compositeName)
			if verboseOutput: print(result)
			# set the index to the composite in the scene list
			scene["composite"] = arcpy.env.workspace + "\\" + compositeName
```

Create the empty Mosaic Dataset using the spatial reference from the first image in the catalog. This assumes each scene uses the same spatial reference or is at least in the same vicinity. However, this script could be easily modified to accept a user-defined spatial reference.

```python
	if createMosaicDataset:
		print("creating mosaic dataset: " + mosaicName)
		# creating a mosaic dataset requires a spatial reference
		# this tool assumes all rasters are in the same area
		# and simply gets the spatial reference of the first TIF found
		describeRaster = arcpy.Describe(sceneList[0]["images"][0])
		# set the spatial reference of the raster
		rasterSpatialRef = describeRaster.spatialReference
		# run the geoprocessing tool
		result = arcpy.CreateMosaicDataset_management(
			arcpy.env.workspace,
			mosaicName,
			rasterSpatialRef,
			product_definition=imageryType
		)
		if verboseOutput: print(result)
```

Add the recently created raster composites to the Mosaic Dataset.

```python
	if addRastersToMosaic:
		print("add rasters to mosaic: " + mosaicName)
		# build a list of composite rasters
		compList = []
		for scene in sceneList:
			if scene["composite"]:
				compList.append(scene["composite"])
		# exit if no composites are found
		if len(compList) == 0:
			sys.exit("No raster composites found.")
		# run the geoprocessing tool
		result = arcpy.AddRastersToMosaicDataset_management(
			mosaicName,
			"Raster Dataset",
			compList,
			update_overviews="UPDATE_OVERVIEWS",
			build_pyramids="BUILD_PYRAMIDS",
			calculate_statistics="CALCULATE_STATISTICS",
			duplicate_items_action="OVERWRITE_DUPLICATES"
		)
		if verboseOutput: print(result)
```

Build footprints and seamlines for the mosaic. Footprints will determine which areas are actually covered by image data and seamlines will help images to overlap more naturally. 

```python
	if buildFootprints:
		print("building footprints for: " + mosaicName)
		result = arcpy.BuildFootprints_management(mosaicName)
		if verboseOutput: print(result)
	if buildSeamlines:
		print("building seamlines for: " + mosaicName)
		result = arcpy.BuildSeamlines_management(mosaicName)
		if verboseOutput: print(result)
```

![Footprints and seamlines](automated-mosaic/lines.png)
<small>Green lines are footprints. Blue are seamlines.</small>

This entire script is hosted [on GitHub](https://github.com/ejsado/landsat_mtl_bands).

