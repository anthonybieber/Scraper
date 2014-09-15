<?php

ini_set('max_execution_time', 300);
ini_set('memory_limit','500M');

require __DIR__ . '/vendor/autoload.php';
require 'autoload.php';

use Everyglobe\Classes\PageHandler;
use Everyglobe\Classes\Translations;
use Everyglobe\Classes\BudgetYourTripParser;

$pageHandler = new PageHandler();
$parser      = new BudgetYourTripParser();
$translate   = new Translations();

$content      = $pageHandler->getPage('http://www.budgetyourtrip.com/countrylist.php');
$countryList  = $parser     ->filterCountryList($content);

foreach($countryList as $country) {
    $country              = trim($country);
    $countryCode          = $translate->getCountryCodeFromCountry($country);

    $countryBudgetContent = $pageHandler->getPage("http://www.budgetyourtrip.com/budgetreportadv.php?geonameid=&countrysearch=&country_code=$countryCode&categoryid=0&budgettype=1&triptype=0&startdate=&enddate=&travelerno=0");
    $price                = $parser->filterPrice($countryBudgetContent);

    $parser->savePrice($country, 'Budget', $price);
}


