<?php if (isset($_SESSION['user']['username'])) { ?>
<nav class="navbar-fluid">
	<div class="logo_div">
		<a href="index.php"><h1>Universe Blog</h1></a>
	</div>
	<ul>
		<li><form action="">
      		<input type="text" placeholder="Search.." name="search">
    	</form></li>
		<li><form action="">
      		<button type="submit" style="padding: 16px; margin-top:5px"><i class="fa fa-search"></i></button>
    	</form></li>
		<li><a class="active" href="index.php">Home</a></li>
		<li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="logout.php">Log Out</a></li>
	</ul>
</nav>
<?php }else{ ?>
<nav class="navbar-fluid">
	<div class="logo_div">
		<a href="index.php"><h1>Universe Blog</h1></a>
	</div>
	<ul>
		<li><form action="">
      		<input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search.." title="Type in a category">
    	</form></li>
		<li><form action="">
      		<button type="submit" style="padding: 16px; margin-top:5px"><i class="fa fa-search"></i></button>
    	</form></li>
		<li><a class="active" href="index.php">Home</a></li>
		<li><a href="contact.php">Contact</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="login.php">Log In</a></li>
	</ul>
</nav>
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("mySearch");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myMenu");
            li = ul.getElementsByTagName("li");

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
    </script>

<?php } ?>