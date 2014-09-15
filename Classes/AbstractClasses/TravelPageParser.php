<?php

namespace Everyglobe\Classes\AbstractClasses;

Abstract Class TravelPageParser {

    /**
     * Parse the page to retrieve an array of countries
     *
     * @return array An array of countries to parse further
     */
    abstract public function filterCountryList($pageContents);

}
