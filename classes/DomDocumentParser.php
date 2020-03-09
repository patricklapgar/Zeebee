<?php 
    class DomDocumentParser {

        private $doc;
        public function __construct($url) {
                /*
                    The array below gives some options to be used when a request is made to a web page
                    The options I'm specifying are:
                        - The method which to retrieve the data
                        - The header of the request
                        - The User-Agent is how a website knows who visited a websites
                            - Contains a name and version
                */
            $options = array(
                'http'=>array('method'=>"GET", 'header'=>"User-Agent: zeebeebot/0.1\n")
            );

            $context = stream_context_create($options);

            $this->doc = new DomDocument();
            @$this->doc->loadHTML(file_get_contents($url, false, $context)); 
        }

        public function getLinks() {
            return $this->doc->getElementsByTagName("a");
        }

        public function getTitleTags() {
            return $this->doc->getElementsByTagName("title");
        }

        public function getMetaTags() {
            return $this->doc->getElementsByTagName("meta");
        }

        public function getImages() {
            return $this->doc->getElementsByTagName("img");
        }
    }
?>