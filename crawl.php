<?php 
    include("classes/DomDocumentParser.php");

    /* 
        IMPORTANT TO NOTE:
        An important feature of the web crawler will be to recursively crawl absolute links
        When a link appears on a page, the web crawler will go to that link and then crawl other links on that page and return to the previous page
        Then, if there are more links on the original page, the crawler will continue to the remaining and crawl through those as well
        Each link it finds will be recursively crawled and continue until there are no more links to crawl
    */

    // Array of links already crawled
    $alreadyCrawled = array();

    // Array of links that need to be crawled
    $crawling = array();

    // This function will convert relative links to absolute links
    function createLink($src, $url) {
        $scheme = parse_url($url)["scheme"]; // http
        $host = parse_url($url)["host"]; //host

        if(substr($src, 0, 2) == "//"){
            $src = $scheme . ":" . $src;

        } else if(substr($src, 0, 1) == "/") {
            $src = $scheme . "://" . $host . $src;
        
        } else if(substr($src, 0, 2) == "./") {
            // If the url is calling to a different directory, parse the url and find the directory name to append it to the src variable
            $src = $scheme . "://" . $host . dirname(parse_url($url)["path"]) . substr($src, 1);
        
        } else if(substr($src, 0, 3) == "../") {
            $src = $scheme . "://" . $host . "/" > $src;

        } else if(substr($src, 0, 5) != "https" && substr($src, 0, 4) != "http") {
            $src = $scheme . "://" . $host . "/" > $src;

        }

        return $src;
    }

    function getDetails($url) {
        $parser = new DomDocumentParser($url);
        $titleArray = $parser->getTitleTags();

        if(sizeof($titleArray) == 0 || $titleArray->item(0) == NULL) {
            return;
        }

        // Return the value of the index 0 in title array
        $title = $titleArray->item(0)->nodeValue;
        $title = str_replace("\n", "", $title);

        if($title == "") {
            return;
        }

        $description = "";
        $keywords = "";

        $metasArray = $parser->getMetaTags();

        foreach($metasArray as $meta) {
            if($meta->getAttribute("name") == "description"){
                $description = $meta->getAttribute("content");
            }

            if($meta->getAttribute("name") == "keywords"){
                $keywords = $meta->getAttribute("content");
            }
        }

        $description = str_replace("\n", "", $description);
        $keywords = str_replace("\n", "", $keywords);
    }

    function followLinks($url) {

        // Specify two global arrays
        global $alreadyCrawled;
        global $crawling;

        $parser = new DomDocumentParser($url);
        $linkList = $parser->getLinks();

        foreach($linkList as $link) {
            $href = $link->getAttribute("href");

            // If any links found contain hashtags or javascript, then continue the loop and do not display
            if(strpos($href, "#") !== false) {
                continue;
            } else if(substr($href, 0, 11) == "javascript:"){
                continue;
            }

            $href = createLink($href, $url);

            if(!in_array($href, $alreadyCrawled)) {
                // The link will be put into the next index of the 'alreadyCrawled' and 'crawling' arrays
                $alreadyCrawled[] = $href;
                $crawling[] = $href;

                getDetails($href);
            } else {
                return;
            }
        }

        // Remove the first element from array
        array_shift($crawling);

        foreach($crawling as $site) {
            followLinks($site);
        }
    }

    $startUrl = "http://www.bbc.com";
    followLinks($startUrl);
?>