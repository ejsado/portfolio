## Summary

I generally try to avoid tolls when I’m travelling, unless that route saves a significant amount of time. Driving out West, it was much easier to avoid tolls, and it got me wondering, **where are all of the tolls in the US?**

---

## Data Acquisition

I used OpenStreetMap data to build this map. 

> OpenStreetMap is a free, editable map of the whole world that is being built by volunteers largely from scratch and released with an open-content license.  
> [OpenStreetMap Wiki](https://wiki.openstreetmap.org/wiki/About_OpenStreetMap)

OpenStreetMap uses three simple elements to store map entities: nodes (points), ways (lines), and relations (objects or areas). I was only interested in nodes (toll booths) and ways (highways). Every element is tagged as defined by [OpenStreetMap’s list of map features](https://wiki.openstreetmap.org/wiki/Map_features).

I started by downloading the entire [United States as a PBF](https://download.geofabrik.de/north-america/us.html).

OSM uses its own data storage format called PBF or Protocolbuffer Binary Format (using the file extension .pbf or .osm.pbf).

> It is about half of the size of a gzipped planet and about 30% smaller than a bzipped planet. It is also about 5x faster to write than a gzipped planet and 6x faster to read than a gzipped planet.  
> [OpenStreetMap Wiki](https://wiki.openstreetmap.org/wiki/PBF_Format)

PBF is not natively supported by ArcGIS Pro but it is (mostly) supported by QGIS. However, importing a 7 gigabyte file into QGIS basically grinds it to a halt. Instead, I attempted to use a web tool to gather the data I needed.

### Overpass

[Overpass Turbo](https://overpass-turbo.eu/) is a web-based tool that runs Overpass API queries and displays the results in the browser on an interactive web map. 

> The Overpass API (formerly known as OSM Server Side Scripting, or OSM3S before 2011) is a read-only API that serves up custom selected parts of the OSM map data. It acts as a database over the web: the client sends a query to the API and gets back the data set that corresponds to the query.  
> [OpenStreetMap Wiki](https://wiki.openstreetmap.org/wiki/Overpass_API)

To find all the toll booths, I simply filtered the nodes by the [“toll_booth”](https://wiki.openstreetmap.org/wiki/Tag:barrier%3Dtoll_booth) tag. However, some road tolls are entirely electronic, so I had to include [“toll_gantry”](https://wiki.openstreetmap.org/wiki/Tag:highway%3Dtoll_gantry) in the filter as well. A toll gantry is simply an overhead structure that collects tolls electronically without a physical barrier to stop traffic flow.

Here are the queries I used to gather data:

```overpass
/*
get toll booths in DE
*/

rel(162110);
map_to_area;
out;

node[barrier=toll_booth](area);
out;
```
```overpass
/*
get toll gantries in PA
*/

rel(162109);
map_to_area;
out;

node[highway=toll_gantry](area);
out;
```

Each query is targeted at a specific area defined in the `rel()` statement. To find any relation ID, use [OSM’s official map](https://www.openstreetmap.org/#map=5/39.298/-95.142).

<aside>
<p>Overpass Turbo Limitations</p>
<p>Overpass Turbo is a free web tool and therefore limits how often users can run queries. As of writing this article, they limit you to two "slots" at a time (one per Overpass Turbo instance). Each query you make will have a cooldown after the job is finished to prevent overloading of the instance. More complicated queries (longer run times) will have a longer cooldown time.</p>
<p><a href="https://dev.overpass-api.de/overpass-doc/en/preface/commons.html">Read more about the limitations</a> or <a href="https://overpass-api.de/api/status">check the status of your cooldown timers</a></p>
</aside>

Although it did take a while, I was able to retrieve all of the toll booths and toll gantries in the USA as KML files. However, it turns out that a large number of toll booths are not on highways. Many toll booths are marked on OpenStreetMap near parks, ports, parking lots, and other secure facilities. 

OpenStreetMap defines all roads and paths as “highways” and offers more detailed tags to further define these ways. A “motorway” is a restricted access divided highway for vehicular traffic and a “motorway_link” simply an entrance or exit ramp to a motorway. These are the most common types of road where tolls are used. To highlight the toll booths associated with highways, I filtered the data for the “motorway” and “motorway_link” tags. 

Unfortunately, because of Overpass Turbo’s limitations it was infeasible to retrieve all of America's motorways and motorway ramps from the cloud. I opted to use an entirely different tool to filter my data on my own PC.

### Osmosis

Osmosis is a Java-based command line application for processing OSM data. You can [download it](https://github.com/openstreetmap/osmosis/releases/latest) for yourself.

I used this command to filter that 7 gigabyte USA snapshot I downloaded earlier:

```osmosis
osmosis ^
--read-pbf-fast "C:\path\to\pbf\us-latest.osm.pbf" ^
--log-progress ^
--tag-filter reject-relations ^
--tag-filter accept-ways highway=motorway,motorway_link ^
--used-node ^
--write-pbf motorways.osm.pbf
```

In short, here is what this command does:
1. Read the PBF file quickly
2. Output every few seconds to show progress
3. Ignore relations (areas)
4. Return all ways that are tagged with “motorway” or “motorway_link”
5. Include all of the nodes associated with those ways
6. Write (or overwrite) to “motorways.osm.pbf”

The carrots (`^`) simply allow the command to split multiple lines for readability.

---

## Data Conversion and Processing

Because the file size was much smaller (45 megabytes vs. 7 gigabytes), I successfully loaded my “motorways.osm.pbf” into QGIS. From there I saved it as a Geopackage, which can be imported to ArcGIS Pro. ArcGIS Pro already supports KML files (from Overpass Turbo).

In ArcGIS Pro, I buffered the motorways by 12 meters and highlighted any toll booths within that area. This was to visibly discern highway toll booths from other booths mentioned above. If you open the [interactive web map](/webmaps/us-toll-booths/), you can hide individual layers and visualize each toll type separately.


