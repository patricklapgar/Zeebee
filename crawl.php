<?php 
    include("classes/DomDocumentParser.php");

    function createLink($src, $url) {
        
    }

    function followLinks($url) {
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

            createLink($href, $url);

            // echo $href . "<br>";
        }
    }

    $startUrl = "http://www.bbc.com";
    followLinks($startUrl);
?>