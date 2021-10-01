## Summary

I generally try to avoid tolls when I’m travelling, unless that route saves a significant amount of time. Driving out West, it was much easier to avoid tolls, and it got me wondering, **where are all of the tolls in the US?**

---

## Data Acquisition and Preparation

I used a snapshot of OpenStreetMap data to build this map. 

> OpenStreetMap is a free, editable map of the whole world that is being built by volunteers largely from scratch and released with an open-content license.
> 
> https://wiki.openstreetmap.org/wiki/About_OpenStreetMap

OpenStreetMap uses three simple elements to store map entities: nodes (points), ways (lines), and relations (objects). I was only interested in nodes (toll booths) and ways (highways). Every element is tagged as defined by OpenStreetMap’s list of map features.

https://wiki.openstreetmap.org/wiki/Map_features

To find all the toll booths, I simply filtered the nodes by the “toll_booth” tag. However, some road tolls are entirely electronic, so I had to include “toll_gantry” in the filter as well. A toll gantry is simply an overhead structure that collects tolls electronically without a physical barrier to stop traffic flow.

It turns out that a large number of toll booths are not on highways. Many toll booths are marked on OpenStreetMap near parks, ports, parking lots, and other secure facilities. To highlight the toll booths associated with highways, I filtered the data for the “motorway” tag. OpenStreetMap defines all roads and paths as “highways” and offers more detailed tags to further define these ways. A “motorway” is a restricted access divided highway for vehicular traffic. This is the most common type of road where tolls are used. 

I highlighted all of the toll booths within 12 meters of any motorway to help discern the road tolls from the other toll booths. 


