<?php

//Only used for testing purposes
ini_set('max_execution_time', 300);
ini_set('memory_limit','300M');

//Autoload files will be merged so both do not have to be included
require __DIR__ . '/vendor/autoload.php';
require 'autoload.php';

use Everyglobe\Classes\PageHandler;
use Everyglobe\Classes\Translations;
use Everyglobe\Classes\BudgetYourTripParser;

$pageHandler = new PageHandler();
$parser      = new BudgetYourTripParser();
$translate   = new Translations();

//Get The country list page and parse the countries from it
$content      = $pageHandler->getPage('http://www.budgetyourtrip.com/countrylist.php');
$countryList  = $parser     ->filterCountryList($content);

//Iterate through each country, translate country name to country code, and get page to parse price
foreach($countryList as $country) {
    $country              = trim($country);
    $countryCode          = $translate->getCountryCodeFromCountry($country);

    //This process is for the budget price only, the same would be repeated for mid range and luxury
    $countryBudgetContent = $pageHandler->getPage("http://www.budgetyourtrip.com/budgetreportadv.php?geonameid=&countrysearch=&country_code=$countryCode&categoryid=0&budgettype=1&triptype=0&startdate=&enddate=&travelerno=0");
    $price                = $parser->filterPrice($countryBudgetContent);
    $parser->savePrice($country, 'Budget', $price);
}


