<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Node.js" />
    <meta name="keywords" content="Node.js, Technology Inquiry Project" />
    <meta name="author" content="Group 2 - Node.js - Archer, Ben, Callum, Jack and William" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/styleLight.css">
    <link rel="icon" type="image/x-icon" href="images/nodejsicon.ico">
    <title>Node.js - Technology Inquiry Project</title>
</head>

<body id="enhancement_body_background">
    <header>
        <!-- Node.js logo -->
        <a class="logo" href="indexLight.php"><img src="images/nodejslogo2.png" width="30" alt="logo"></a>
        <input type="checkbox" class="menu-checkbox" id="menu-checkbox">
        <label class="hamburger-icon" for="menu-checkbox"><span class="nav-icon"></span></label>

        <!-- Menu -->
        <ul class="menu">
            <li><a href="indexLight.php">Home</a></li>
            <li><a href="topicLight.php">Topic</a></li>
            <li><a href="quizLight.php">Quiz</a></li>
            <li><a class="selected" href="enhancementsLight.php">Enhancements</a></li>
            <li><a href="enhancements2Light.php">PHP Enhancements</a></li>
            <li class="mode"><a href="enhancements.php">Dark Mode</a></li>
            <li class="mode"><a href="authenticateLight.php">User</a></li>
            <li class="mode"><a href="manageQueryLight.php">⚙</a></li>
        </ul>
    </header>

    <main>
        <h1>Enhancements</h1>

        <div class="enhancements">
            <section class="enhancement-card">
                <h2>Light and Dark Modes</h2>
                <p>
                    The primary enhancement for our HTML/CSS webpage is an accessibility
                    feature which allows the user to choose light or dark mode. It works the same
                    way as all other light and dark mode settings on other sites, basically you can
                    click on one of our options in the navigation bar and it changes the CSS files
                    and all its selected colours.

                    <br>
                    This was achieved by creating multiple versions of each CSS and HTML file
                    and linking them appropriately.
                    By pressing this plus button it will also take you to the light or dark mode.<a href="enhancements.php">+</a>
                </p>
            </section>

            <section class="enhancement-card">
                <h2>Mobile Responsiveness</h2>
                <p>
                    For our second primary enhancement, we chose to make the website mobile responsive, When it is
                    viewed on
                    mobile certain elements will shrink, outright change or dissapear to accommodate the smaller screen
                    size.

                    <br>
                    This was achieved through using the @media rule to apply different styles when the screen size is at
                    a certain width. In the following example, the column is at 50% width at default but will stretch to
                    100% of the screen width when it is under 700 pixels.
                </p>
                <img src="images/mobileresponsivenessexample.png" width="100%" alt="logo">

                <p>
                    To align small elements on desktop mode, we set margin-left and margin-right to
                    auto, this aligns the element within the center of the parent element.
                </p>
            </section>

            <section class="enhancement-card">
                <h2>WCAG Compliance</h2>
                <p>
                    WCAG is an acronym for Web Content Accessibility Guidelines,
                    it is a internationally recognized standard for making content
                    more accesseible to people with a disability. All Selectable elements on this website
                    can be selected through the use of a keyboard only. This was done through using apprioriate tags for
                    selectable elements.
                </p>
            </section>

            <section class="enhancement-card">
                <h2>Website Tab Icon</h2>
                <p>
                    The tab bar icon for this website has been updated to use a Node.js Logo, through simply adding a
                    link in the html head element.
                </p>

                <img src="images/iconexample.png" width="100%" alt="logo">
            </section>
        </div>
    </main>

    <?php
    include "footer.inc"
    ?>
</body>

</html>