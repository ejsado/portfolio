## Summary

Trees provide shade, sound buffering, wind protection, wildlife habitat, and privacy. But, not all forests are created equal. Many forested areas in the United States are split by farmland or urban development. So, **where are the densest forests in the US?**

---

## How is forest density measured?

There are a few ways of determining this, but I used the basal area. [Basal area](https://en.wikipedia.org/wiki/Basal_area) is the cross-sectional area of trees at breast height (1.3m or 4.5 ft above ground).

![Example of basal area](us-forest-density/basal-area.png)

---

## Analysis

The densest forests in the contiguous US exist in the Pacific Northwest.

![Zoom to Olympic National Park](us-forest-density/olympic.png)
<small>Olympic National Park and the Hoh Rain Forest certainly stand out.</small>

![Zoom to the Cascades](us-forest-density/northcalif.png)
<small>The Cascade mountain range and northern California contain some of the largest trees in the world.</small>

![Zoom to the Rockies](us-forest-density/rockies.png)
<small>The Rocky Mountains have lush sections of forest at specific elevations.</small>

![Zoom to the South](us-forest-density/deltas.png)
<small>River deltas in the South produce pockets of greenery.</small>

### Introduced Error

To produce a more visually appealing map, I “blurred” the data slightly by averaging raster cells with their nearest neighbors. This was to smooth the raster data and make it less spotty.

---

## Data Sources

The US Forest Service provides data on individual tree species and tree totals for the contiguous US. The data I used was from 2012.  
https://www.fs.fed.us/foresthealth/applied-sciences/mapping-reporting/indiv-tree-parameter-maps.shtml

