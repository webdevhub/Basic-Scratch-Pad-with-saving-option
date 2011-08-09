<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="main.css" />
<title>HTML5 Canvas Scratch Pad with Image Storing >> Image</title> 
<body>
<div id="wrapper">
	<?php
	if(isset($_POST['imageData'])&&$_POST['imageData']!="") {
		$data = $_POST['imageData'];
		if(substr($data,0,14)!="data:image/png") {
			echo "Invalid Image Format. Please try again. Click here to go back to Scratch Pad";
		} else {
			// Remove the starting characters,"data:image/jpg;base64,". Rest left is the PNG data
			$imageData = substr($data,22,strlen($data)-22);

			//as the data is base64 encoded. We decode it to get the raw data first.
			$finalImageData = base64_decode($imageData);
			
			//we assign the name to the file based upon the timestamp
			$filename = "uploads/".time().".png";
			// In our example we're creating a new file, $filename in write mode.
			// that's where $finalImageData will go when we fwrite() it.
			$handle = fopen($filename, 'w+');
			if (!$handle) {
			    echo "Cannot open file ($filename)";
			    exit;
			}
			// Write $finalImageData to our opened file.
			if (fwrite($handle, $finalImageData) === FALSE) {
			    echo "Cannot write to file ($filename)";
			    exit;
			} else {
			    echo "<h1>You photo has been stored. </h1><br/>";
			    echo '<img src="'.$filename.'" /> <br/>';
			    echo '<h2>The link is <a href="http://demo.webdevhub.net/canvas/store-canvas/'.$filename.'">http://demo.webdevhub.net/canvas/store-canvas/'.$filename."</a></h2>";
			    echo "<h3>Click <a href='/canvas/store-canvas/'>here</a> to go back to Scratch Pad</h3>";
			}
			fclose($handle);
		}
	} else {
		echo "There is no data.";
	}
	?>
</div>
</body>
</html>