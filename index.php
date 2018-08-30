<!DOCTYPE html>
<html>
<head>
	<title>ANPR Main System</title>
	<!-- Bootstrap Core CSS -->
	<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h1>Camera Feed</h1>
			<video autoplay="true" id="cameraView"></video>
			<button class="btn btn-primary" id="captureSnap">CAPTURE</button>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var video = document.querySelector("#cameraView");
 
	if (navigator.mediaDevices.getUserMedia) {       
	    navigator.mediaDevices.getUserMedia({video: true})
	  .then(function(stream) {
	  	console.log(stream)
	    video.srcObject = stream;
	  })
	  .catch(function(err0r) {
	    console.log("Something went wrong!");
	  });
	}

	$("#captureSnap").on('click', function(){
		alert("Snappned!")
	})
</script>
</body>
</html>