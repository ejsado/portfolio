<!-- navigation content -->
<nav>
	<a class="pill-button 
        <?php if ($currentPage == "projects") {echo "current-page";} ?>"
        href="/">
        Projects
    </a>
	<a class="pill-button 
        <?php if ($currentPage == "adventures") {echo "current-page";} ?>"
        href="/adventures/">
        Adventures
    </a>
    <a class="pill-button 
        <?php if ($currentPage == "about") {echo "current-page";} ?>"
        href="/about/">
        About
    </a>
	<a class="pill-button 
        <?php if ($currentPage == "contact") {echo "current-page";} ?>"
        href="/contact/">
        Contact
    </a>
	<!-- <a class="pill-button 
        <?php if ($currentPage == "other") {echo "current-page";} ?>"
        href="/other/">
        Other Maps
    </a> -->
</nav>