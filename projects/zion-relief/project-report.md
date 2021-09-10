## Summary

Southern Utah is a gorgeous place to explore. Just outside of Zion National Park is plenty of public land, miles of dirt roads, and really fantastic mountain biking trails. Usually, when people visit a national park, they tend to miss the surrounding gems. I wanted to show the larger area where Zion resides and all of the beautiful topography of the area.

---

## Process

I used a combination of hillshades, aspect, and slope raster layers all blended together to make the shadows. I also exaggerated the 3D terrain by a factor of 1.5 to make the topography stand out. I tried to add 3D labels in ArcGIS Pro, but due to limitations I used Inkscape to add labels instead.

---

## Notes on ArcGIS Pro

This project highlighted some of the limitations of ArcGIS Pro. It does a great job with 2D maps, allowing complicated labels and blending layers to achieve whatever effects you desire. However, 3D scenes are a different matter. Rendering is much slower (understandably) and label support is basically nonexistent. You can label map elements, but you can’t put the labels where you want, defeating their purpose and any map usability/legibility. This [bug from 2016](https://support.esri.com/en/bugs/nimbus/QlVHLTAwMDA5MzcyNw==) explains that this has been a known issue for years. They do offer a [workaround](https://support.esri.com/en/technical-article/000021536)...

ArcGIS Pro also doesn't support extent indicators with 3D scenes. So, hopefully everyone knows where Utah is...