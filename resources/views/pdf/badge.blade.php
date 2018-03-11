<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		* { margin: 0; padding: 0; }
		@page { size: 101.6mm 76.2mm; }
		body{
			/*background-color: #34495E;*/
			/*color: white;*/
			font-family: monospace;
		}
		p{
			font-style: italic;
			font-size: 8px;
		}
		#qrimg img{
			left: 12.5mm;
			position: absolute;
			width: 76.6mm;
			height: 45mm;
			z-index: -1;
		}
		#infowrapper{
			position: relative;
			text-align: center;
			width: 101.6mm;
			left: 0mm;
			top: 45mm;
		}
		#name h1{
			padding-top: 8%;
			font-size: 16px;
		}
		#name p{
			margin-bottom: 5%;
		}

		#companyname h1{
			font-size: 12px;
		}
		#companyname p{
			margin-bottom: 5%;
		}

		#designation h1{
			font-size: 12px;
		}
		#designation p{
			margin-bottom: 3%;
		}
		#eventname h1{
			font-style: italic;
			text-align: right;
			margin-right: 5%;
			font-family: Century Gothic Ms;
			font-size: 8px;
		}
	</style>
</head>
<body>
	{{-- <img src="http://via.placeholder.com/350x150" id="qrimg"> --}}
	<div id="qrimg">
		{{-- {{$qrcode}} --}}
		{{-- {{public_path() . '\img\guest\\' . $qrcode}} --}}
		<img src="{{public_path() . '\img\guest\\' . $qrcode}}">
	</div>
	<div id="infowrapper">
		<div id="name">
			<h1>{{ucwords($name)}}</h1>
			<p>(Guest Name)</p>
		</div>
		<div id="companyname">
			<h1>{{ucwords($companyname)}}</h1>
			<p>(Company Name)</p>
		</div>
		<div id="designation">
			<h1>{{ucwords($designation)}}</h1>
			<p>(Designation)</p>
		</div>
		<div id="eventname">
			<h1>{{ucwords($eventname)}}</h1>
		</div>		
	</div>
</body>
</html>