<!DOCTYPE html>
<html>
    <head>
        <title>Zeebie</title>

        <meta charset="UTF-8">
        <meta name="description" content="Search the web for websites and images">
        <meta name="keywords" content="Search engine, Zeebee">
        <meta name="author" content="Patrick Apgar">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    </head>
    <body>
        <div class="wrapper indexPage">
            <div class="mainSection">
                <div class="logoContainer">
                    <img src="assets/images/zeebeeLogo.png" alt="">
                </div>

                <div class="searchContainer">
                    <form action="search.php" method="GET">
                        <input class="searchBox" type="text" name="term">
                        <input class="searchButton" type="submit" value="Search">
                    </form>
                </div>

                <!-- <div id="mostVisited" class="newtab-visited">
                    <ul>
                        <li class="newtab-item">
                            <a href="https://www.google.com">
                                <span class="newtab-link">
                                    <span class="newtab-letter">G</span>
                                </span>
                                <div class="newtab-header">Google Website</div>
                            </a>
                        </li>
                    </ul>
                </div> -->
                <div id="mostVisited" class="newtab-visited">
                    <ul>
                        <li class="newtab-item">
                            <a href="https://www.google.com">
                                <span class="newtab-link">
                                    <span class="newtab-letter">G</span>
                                </span>
                                <div class="newtab-header">Google Website</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>