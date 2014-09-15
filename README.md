Scraper
=======
*In the given time limit (just over 3 hours) I was able to extract the budget cost information for each country. The example .chf files can be found in the SamplePriceOutputs directory.

Main Script:<br>
------------
-BudgetYourScriptCrawler.php

Classes:
--
-BudgetYourTripParser.php - Used for parsing budgetyourtrip.com pages. This class extends an abstract class that would be meant to implement other parser classes for other sites.

-PageHandler.php - Deals strictly with retrieving the pages, currently only has one method but will be added on in the future.

-Translations.php - A class only intended to translate country names into country id's. This was necessary to navigate to each page, as only country id's are supplied in the url. For example to get to a the budget price page for Italy the url is as follows: 
  
  http://www.budgetyourtrip.com/budgetreportadv.php?geonameid=&countrysearch=&country_code=IT&categoryid=0&budgettype=1&triptype=0&startdate=&enddate=&travelerno=0

Within the main script each country is translated into its equivalent country code and the country code is passed to the url to navigate through each countries page.

Abstract Class:
-
-TravelPageParser.php - An abstract class was implemented to ensure that future pages will follow a similar outline to BudgetYourTripParser.php. An interface was not used because different methods will be introduced depending on a site DOM structure.

Future Considerations:
--
- Create a many to one relationship instead of one to many for much better overall performance.
- Implement Guzzle to consume web services if other sites provide them.
- Implement last 2 pay methods to complete the business criteria.


