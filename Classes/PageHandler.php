<?php

namespace Everyglobe\Classes;

Class PageHandler {

    /**
     * string $page
     */
    private $pageContents;

    /**
     * Get the file of the web page we wish to parse
     *
     * @param  string $page location of the file
     *
     * @return string
     */
    public function getPage($page) {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 0);
        curl_setopt($curl, CURLOPT_URL, $page);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $content= curl_exec($curl);

        curl_close($curl);

        if(!$content) {
            echo "Could not get page contents ....";
        }

        $this->pageContents = $content;

        return $this->pageContents;
    }
}
