<?php

namespace Everyglobe\Classes;

use Symfony\Component\DomCrawler\Crawler;
use EveryGlobe\Classes\AbstractClasses\TravelPageParser;

Class BudgetYourTripParser extends TravelPageParser {

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    /**
     * class constructor
     */
    public function __construct() {
        $this->crawler = new Crawler();
    }

    /**
     * Filter the list of countries present on the Country List page, and return all the countries listed on the page
     *
     * @param string $content
     *
     * @return array $country
     */
    public function filterCountryList($content) {
        $crawler = $this->crawler;
        $crawler->addHtmlContent($content);

        $countryList = $crawler->filterXPath("html/body/div[1]/div[3]/div[2]/div[2]/ul/li")->extract('_text', 'li');

        return $countryList;
    }

    /**
     * Filter the price present on each countries price page, and return the price
     *
     * @param string $content
     *
     * @return string $price
     */
    public function filterPrice($content) {
        $crawler = new Crawler();
        $crawler->addHtmlContent($content);

        $price  = $crawler->filterXPath("html/body/div[1]/div[3]/div/div/div[3]/div[4]/div/table/tr[1]/td[2]")->extract('_text', 'td');

        return trim($price[0]);
    }

    /**
     * Save the price to a .chf file
     *
     * @param  string $country     The country that the price is provided from
     * @param  string $priceLevel  The price level (Budget, Mid-Range, or luxury)
     * @param  string $price       The price of the price level for a specific country
     *
     */
    public function savePrice($country, $priceLevel, $price) {
        $filePAth = $_SERVER['DOCUMENT_ROOT'] . '/Country Prices/';
        $fileName = $filePath . $country . $priceLevel . '.chf';
        $fileContents = "Country: " . $country . ' ' . 'Price Level' . $priceLevel . ' ' . 'Price: ' . $price;
        if (!file_exists($filePath)) {
            mkdir('filePath', 0777, true);
        }

        file_put_contents($fileName, $fileContents);
    }
}
