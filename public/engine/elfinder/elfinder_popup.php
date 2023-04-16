<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	if (isset($_SESSION['_login_status']) && (strcmp($_SESSION['_login_status'], true) == 0)) :
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Media Manager</title>
		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="../jquery/themes/base/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="../jquery/themes/base/jquery.ui.theme.min.css">
		<link rel="stylesheet" type="text/css" href="../jquery/themes/rits/jquery-ui.custom.min.css">
		<script src="../jquery/js/jquery-1.11.1.min.js"></script>
		<script src="../jquery/js/jquery-ui.min.js"></script>
		<script src="../jquery/js/jquery-migrate.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script src="js/elfinder.min.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			var FileBrowserDialogue = {
				init: function() {
				  // Here goes your code for setting your custom things onLoad.
				},
				mySubmit: function (URL) {
				  // pass selected file path to TinyMCE
				  top.tinymce.activeEditor.windowManager.getParams().setUrl(URL);
				
				  // close popup window
				  top.tinymce.activeEditor.windowManager.close();
				}
			}
			$().ready(function() {
				$('#elfinder').elfinder({
					url : 'php/connector.php',  // connector URL (REQUIRED)
					getFileCallback: function(file) {
						FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE 
					},
					commands : [
						'reload', 'home', 'back', 'forward', 'quicklook', 'rename', 'search', 'info', 'view', 'resize', 'sort'
					]
				});
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
<?php
	endif;
?>