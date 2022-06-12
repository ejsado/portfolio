<?php
	$metadata = [
		'delaware-parks' => [
			'title' => "Where are all of Delaware's parks?",
			'dateAdded' => strtotime("27 June 2021"),
			'dateUpdated' => strtotime("9 October 2021"),
			'tools' => ["ArcGIS Pro", "Image Editor"],
			'category' => "Analysis",
			'tags' => ["arcgis-pro", "image-editor", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "DelPublicLandsFullV2.png",
			'codeProduct' => ""
		],
		'florida-sea-levels' => [
			'title' => "How will Florida be affected by rising sea levels?",
			'dateAdded' => strtotime("20 May 2021"),
			'dateUpdated' => strtotime("15 July 2021"),
			'tools' => ["ArcMap", "ArcGIS Pro", "ArcGIS Online"],
			'category' => "Analysis",
			'tags' => ["arcmap", "arcgis-pro", "arcgis-online", "analysis"],
			'interactiveProduct' => "/webmaps/florida-sea-levels/",
			'staticProduct' => "florida-sea-levels.pdf",
			'codeProduct' => ""
		],
		'us-forest-density' => [
			'title' => "Where are the densest forests in the United States?",
			'dateAdded' => strtotime("29 June 2021"),
			'dateUpdated' => strtotime("29 June 2021"),
			'tools' => ["ArcGIS Pro", "Image Editor"],
			'category' => "Analysis",
			'tags' => ["arcgis-pro", "image-editor", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "USTreeDensityFull.png",
			'codeProduct' => ""
		],
		'us-temperate-days' => [
			'title' => "Which area in the US has the most temperate days?",
			'dateAdded' => strtotime("2 Sept 2021"),
			'dateUpdated' => strtotime("24 May 2022"),
			'tools' => ["QGIS"],
			'category' => "Analysis",
			'tags' => ["qgis", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "Temperate_Months_Contig_US.pdf",
			'codeProduct' => ""
		],
		'us-wildfires-2020' => [
			'title' => "Where were the largest wildfires of 2020 in the United States?",
			'dateAdded' => strtotime("12 July 2021"),
			'dateUpdated' => strtotime("26 July 2021"),
			'tools' => ["ArcGIS Pro", "ArcGIS Online", "Image Editor"],
			'category' => "Analysis",
			'tags' => ["arcgis-pro", "arcgis-online", "image-editor", "analysis"],
			'interactiveProduct' => "/webmaps/us-wildfires-2020/",
			'staticProduct' => "BurnArea2020.png",
			'codeProduct' => ""
		],
		'zion-relief' => [
			'title' => "3D Relief: Zion National Park, Utah",
			'dateAdded' => strtotime("9 Sept 2021"),
			'dateUpdated' => strtotime("9 Sept 2021"),
			'tools' => ["ArcGIS Pro", "Image Editor"],
			'category' => "Cartography",
			'tags' => ["arcgis-pro", "image-editor", "cartography"],
			'interactiveProduct' => "",
			'staticProduct' => "ZionRelief3DMap.png",
			'codeProduct' => ""
		],
		'us-toll-booths' => [
			'title' => "Where are all of the tolls in the US?",
			'dateAdded' => strtotime("23 Sept 2021"),
			'dateUpdated' => strtotime("13 Apr 2022"),
			'tools' => ["ArcGIS Pro", "QGIS", "ArcGIS Online"],
			'category' => "Analysis",
			'tags' => ["arcgis-pro", "qgis", "arcgis-online", "analysis"],
			'interactiveProduct' => "/webmaps/us-toll-booths/",
			'staticProduct' => "TollBoothsUSA.pdf",
			'codeProduct' => ""
		],
		'canadian-rockies-relief' => [
			'title' => "3D Relief: National Parks in the Canadian Rockies",
			'dateAdded' => strtotime("29 Sept 2021"),
			'dateUpdated' => strtotime("29 Sept 2021"),
			'tools' => ["ArcGIS Pro", "Image Editor"],
			'category' => "Cartography",
			'tags' => ["arcgis-pro", "image-editor", "cartography"],
			'interactiveProduct' => "",
			'staticProduct' => "CanadianRockiesFullImage.png",
			'codeProduct' => ""
		],
		'us-bike-paths' => [
			'title' => "Where in the US has the most bike paths?",
			'dateAdded' => strtotime("1 Oct 2021"),
			'dateUpdated' => strtotime("16 Dec 2021"),
			'tools' => ["QGIS"],
			'category' => "Analysis",
			'tags' => ["qgis", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "Bike_Path_Heat_Map.pdf",
			'codeProduct' => ""
		],
		'nevada-land-ownership' => [
			'title' => "Who owns the land in Nevada?",
			'dateAdded' => strtotime("12 Jan 2022"),
			'dateUpdated' => strtotime("12 Jan 2022"),
			'tools' => ["ArcGIS Pro", "Python"],
			'category' => "Analysis",
			'tags' => ["arcgis-pro", "python", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "NevadaLandOwnership.pdf",
			'codeProduct' => ""
		],
		'automated-mosaic' => [
			'title' => "Automated: Landsat Imagery Mosaic",
			'dateAdded' => strtotime("12 Apr 2022"),
			'dateUpdated' => strtotime("12 Apr 2022"),
			'tools' => ["ArcGIS Pro", "Python"],
			'category' => "Automation",
			'tags' => ["arcgis-pro", "python", "automation"],
			'interactiveProduct' => "",
			'staticProduct' => "",
			'codeProduct' => "https://github.com/ejsado/landsat_mtl_bands"
		],
		'nyc-trees' => [
			'title' => "How has New York City's tree population changed over time?",
			'dateAdded' => strtotime("9 May 2022"),
			'dateUpdated' => strtotime("9 May 2022"),
			'tools' => ["R", "SQL", "Python"],
			'category' => "Analysis",
			'tags' => ["r", "sql", "python", "analysis"],
			'interactiveProduct' => "",
			'staticProduct' => "",
			'codeProduct' => "https://github.com/ejsado/nyc_trees_r"
		],
		'cape-henlopen-trails' => [
			'title' => "Trail Map: Cape Henlopen Region",
			'dateAdded' => strtotime("9 June 2022"),
			'dateUpdated' => strtotime("9 June 2022"),
			'tools' => ["ArcGIS Online", "ArcGIS Pro", "ArcGIS Field Maps", "ArcGIS Dashboards"],
			'category' => "Cartography",
			'tags' => ["arcgis-pro", "arcgis-online", "data-collection", "cartography"],
			'interactiveProduct' => "https://ejs.maps.arcgis.com/apps/dashboards/3f0ffd2544214a74905cb7bdbbb8afe8",
			'staticProduct' => "",
			'codeProduct' => ""
		]
	];
?>