## Summary

East of the Mississippi River, wildfires are a rarity. Our main concerns are hurricanes and tornadoes. But in the West, millions of acres of land are destroyed by wildfires every year. In fact, 2020 was the worst year on record in terms of total acres burned. **Where were the largest wildfires of 2020?**

Deanna Conners wrote an article summarizing the data for 2020’s wildfires here:  
https://earthsky.org/earth/us-2020-wildfire-season-record-bad/

---

## Data Preparation

Sourcing burn area data for the US in 2020 was surprisingly difficult. Most available data is either current (ongoing for 2021) or historical. The most recent historical data I could find was for 2019 from the National Interagency Fire Center (NIFC). I did find operational data for 2020, meaning that it contains a lot of redundant and draft data. I’m guessing the NIFC still has to clean up the 2020 data before adding it to the archive for public distribution.

I started by filtering out all of the features that were not marked for approval. I also removed any features that were not labelled as a wildfire. Many of the fires in the US are prescribed burns to help manage wild areas. Even with all of these unnecessary items gone, there was still a huge amount of data, most of it overlapping daily fire perimeters. Because this is not an interactive map, I simply dissolved the overlapping polygons. 

---

## Data Sources

The National Interagency Fire Center holds the most comprehensive data on fires across the country. I used their Operational Data Archive 2020:  
https://data-nifc.opendata.arcgis.com/datasets/operational-data-archive-2020/about

