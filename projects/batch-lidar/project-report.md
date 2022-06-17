## Summary

While I was teaching myself about LIDAR, I thought it would be a good idea to automate some of the basic products that can be derived from LIDAR point clouds. The idea was to learn about the common file types involved and how they can be converted and processed with ArcPy. 

This automation script is very barebones and relies on a lot of default options. In a professional setting, I would make the script more robust to allow for unexpected errors and possible data imperfections. 

---

## Workflow

I developed this script based on LIDAR data from the [USGS LidarExplorer](https://prd-tnm.s3.amazonaws.com/LidarExplorer/index.html#/). From my understanding, this data is bare-earth, meaning it is already stripped of points pertaining to vegetation and other surface objects. Additional processing would be necessary for raw [LIDAR data](https://www.usgs.gov/faqs/what-lidar-data-and-where-can-i-download-it) gathered directly from the field.

There are a number of options which must be set for the script to work.

```python
import arcpy

# GENERAL OPTIONS

# environment settings
# set the geodatabase where the script will create items
arcpy.env.workspace = r"D:\Projects_Tower2019\GIS\Lidar\AutomateLidar.gdb"

# overwrite items in the workspace with items created by this script
# if this is false, an error will occur when an item already exists
arcpy.env.overwriteOutput = True

# show output of each geoprocessing tool
# https://pro.arcgis.com/en/pro-app/latest/arcpy/geoprocessing_and_python/using-tools-in-python.htm
verboseOutput = True


# GEOPROCESSING OPTIONS

# select which operations to perform
# set these values to False if you wish to skip certain steps
# convert a directory of lidar data files to .las
convertToLAS = False
# create a dataset containing a collection of .las files
createLasDataset = False
# create a digital elevation model raster
createDEM = True
# create contour lines
createContour = True
# create a triangulated irregular network
createTIN = True

# LAS/LAZ/ZLAS directory
# all matching files in the directory will be converted
convertFolder = r"D:\Projects_Tower2019\GIS\Lidar\data\LAZ"

# coordinate system for the input LAS/LAZ/ZLAS files
# https://pro.arcgis.com/en/pro-app/latest/arcpy/classes/spatialreference.htm
# all files in the above directory must be in the same CRS defined here
# (horizontal CRS, vertical CRS)
definedCRS = arcpy.SpatialReference(6342, 5703)

# output folder for files converted to LAS
outputFolder = r"D:\Projects_Tower2019\GIS\Lidar\data\LAS_output"

# folder containing LAS files for the LAS dataset
lasFolder = outputFolder

# LAS dataset name and location
# this file will be overwritten if it already exists
# must end in .lasd
lasDataset = r"D:\Projects_Tower2019\GIS\Lidar\data\wind_cave_lasd.lasd"

# product resolution/interval (units are based on definedCRS)
# used as the raster cell size for the DEM
# used as the contour interval
# used as the window size for thinning points in the TIN
resolution = 5

# DEM file name to be stored in the geodatabase
demRaster = arcpy.env.workspace + r"\wind_cave_LASD_DEM"

# contour feature class file name to be stored in the geodatabase
contourFeature = arcpy.env.workspace + r"\wind_cave_LASD_contour"

# TIN dataset name
# this will be a directory
tinDataset = r"D:\Projects_Tower2019\GIS\Lidar\data\wind_cave_LASD_TIN"

```

I downloaded the LIDAR data in LAZ format which is a compressed format. To make this data usable in ArcGIS Pro, it has to be converted to LAS format.

```python
# script to derive products from LIDAR data
# settings are found in options.py

import glob
import arcpy

from options import *

if __name__ == '__main__':
	print("Running batch_lidar")
	if convertToLAS:
		print("Converting files in " + convertFolder)
		# check if the output folder has LAS files already
		for las in glob.glob(outputFolder + r"\*.las", recursive=False):
			print("WARNING: The output folder " + outputFolder + " contains other LAS files.")
			print("Files in the output folder will not be overwritten, but there may be a file name conflict error.")
			break
		# run the conversion tool
		result = arcpy.conversion.ConvertLas(
			convertFolder,
			outputFolder,
			las_options=[],
			define_coordinate_system="ALL_FILES",
			in_coordinate_system=definedCRS
		)
		if verboseOutput: print(result)

```

Next, let’s combine the LAS files into a single dataset for easy reference.

```python
	if createLasDataset:
		print("Creating LAS Dataset")
		# combine the files into a single dataset
		result = arcpy.management.CreateLasDataset(
			lasFolder,
			lasDataset
		)
		if verboseOutput: print(result)

```

Now let’s generate a DEM. It will have a resolution of 5 meters.

```python
	if createDEM:
		print("Creating DEM")
		# generate a DEM from the LAS dataset
		result = arcpy.conversion.LasDatasetToRaster(
			lasDataset,
			demRaster,
			sampling_value=resolution
		)
		if verboseOutput: print(result)

```

Create contour lines from the LAS dataset and not the DEM. Always create new products from the original source to avoid introducing data inaccuracy. The contour interval will be 5 meters.

```python
	if createContour:
		print("Create Contour Lines")
		# generate contour lines from the LAS dataset
		result = arcpy.ddd.SurfaceContour(
			lasDataset,
			contourFeature,
			resolution
		)
		if verboseOutput: print(result)

```

Create a TIN by thinning the points. Every 5 meter square will be reduced to one point. ESRI recommends TINs should not have more than 5 million points to improve rendering times.

```python
	if createTIN:
		print("Creating TIN")
		# generate a TIN from the LAS dataset
		result = arcpy.ddd.LasDatasetToTin(
			lasDataset,
			tinDataset,
			thinning_type="WINDOW_SIZE",
			thinning_method="CLOSEST_TO_MEAN",
			thinning_value=resolution
		)
		if verboseOutput: print(result)

```

![Footprints and seamlines](automated-mosaic/lines.png)
<small>Green lines are footprints. Blue are seamlines.</small>

This entire script is [hosted on GitHub](https://github.com/ejsado/batch_lidar).

