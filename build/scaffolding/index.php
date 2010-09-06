<html>

<body>
<title>Manusing Scaffolding</title>

<form method="post">create <select name="type">
	<option value="model" selected="selected">Model</option>
	<option value="controller">Controller</option>
	<option value="views">Views</option>
	<option value="all">All</option>
</select> <input type="text" name="name" /> <input type="submit"
	value="submit" /></form>
</body>

</html>

<?php
include('./Scaffolding.php');
$scaffolding = new Scaffolding();
if( isset($_POST['type']) && isset($_POST['name'])){
	switch ( $_POST['type'] )
	{
		case 'model':
			$scaffolding->generateModel($_POST['name']);
			break;
				
		case 'controller':
			$scaffolding->generateController($_POST['name']);
			break;
				
		case 'views':
			$scaffolding->generateViews($_POST['name']);
			break;
				
		case 'all':
			$scaffolding->generateModel($_POST['name']);
			$scaffolding->generateController($_POST['name']);
			$scaffolding->generateViews($_POST['name']);
			break;
				
	}

}


?>