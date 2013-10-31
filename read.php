<html>
	<head>
		<title>LOG READER</title>
		<style type="text/css">
			 #logview{
			 	border: 1px solid black;
			 	height: 400px;
			 	overflow-y: scroll; 
			 }
		 </style>
		 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		 
		 <script type="text/javascript">
			var logname;
			var t;
			var log;
			var initialTime = currentTime = 1000;
			jQuery(document).ready(function(){
				jQuery("#logname").on('change',function(){
					if(jQuery(this).val() != ''){
						log = "";
						currentTime = initialTime;
						logname = jQuery(this).val();
						jQuery('#logview pre').html();
						getLog('timer');
					}
				});
				jQuery("#stop").on('click',function(){
					stopTail();
				});
			});

			function getLog(timer) {
				jQuery.post("logtail.php", {'logname': logname}, function( data ) {
					if(log != data){
						log = data;
						currentTime = initialTime;
						jQuery("#logview pre").append(data);
					}else{
						currentTime += 500;
					}
				});
				startTail(timer);
			}
			
			function startTail(timer) {
				if (timer == "stop") {
					stopTail();
				} else {
					t = setTimeout("getLog()",currentTime);
				}
			}

			function stopTail() {

				clearTimeout(t);
				var pause = "\nThe log viewer has been paused. To begin viewing again, click the Start Viewer button.\n";
				jQuery("#logview pre").append(pause);

			}

		 </script>

	</head>
	<body>
		
		<fieldset>
			<legend>Selecione</legend>
			<ul>
				<li>
					<select name="logname" id="logname">
						<option value="">Selecione</option>
						<optgroup label="NOVO">Novo</optgroup>
						<option value="novo-batch">Batch</option>
						<option value="prd">Front</option>
					</select>
					<a href="javascript: void(0)"; id="stop">Parar</a>
				</li>
			</ul>
		</fieldset>
		<div>
			<h1>Log</h1>
			<div id="logview">
				<pre></pre>
			</div>
		</div>
	</body>
</html>