<!DOCTYPE html>
<html>
<head>
	<title></title>
	@switch($status)

	    @case(1)
				{{-- Sample 1 - 4 x 3 --}}
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
	        @break

	    @case(2)
	       		{{-- Sample 2 - 4 x 5 --}}
	       		<style type="text/css">
	       			* { margin: 0; padding: 0; }
	       			@page { size: 101.6mm 127mm; }
	       			body{
	       				/*background-color: #34495E;*/
	       				/*color: white;*/
	       				font-family: monospace;
	       			}
	       			p{
	       				font-style: italic;
	       				font-size: 15px;
	       			}
	       			#qrimg img{
	       				/*left: 12.5mm;*/
	       				position: absolute;
	       				width: 101.6mm;
	       				height: 70mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 101.6mm;
	       				left: 0mm;
	       				top: 70mm;
	       			}
	       			#name h1{
	       				padding-top: 8%;
	       				font-size: 25px;
	       			}
	       			#name p{
	       				margin-bottom: 8%;
	       			}

	       			#companyname h1{
	       				font-size: 16px;
	       			}
	       			#companyname p{
	       				margin-bottom: 8%;
	       			}

	       			#designation h1{
	       				font-size: 16px;
	       			}
	       			#designation p{
	       				margin-bottom: 8%;
	       			}
	       			#eventname h1{
	       				font-style: italic;
	       				text-align: right;
	       				margin-right: 5%;
	       				font-family: Century Gothic Ms;
	       				font-size: 12px;
	       			}
	       		</style>
	        @break

	    @case(3)
	       		{{-- Sample 3 - 5 x 4 --}}
	       		<style type="text/css">
	       			* { margin: 0; padding: 0; }
	       			@page { size: 127mm 101.6mm; }
	       			body{
	       				/*background-color: #34495E;*/
	       				/*color: white;*/
	       				font-family: monospace;
	       			}
	       			p{
	       				font-style: italic;
	       				font-size: 12px;
	       			}
	       			#qrimg img{
	       				left: 13.5mm;
	       				position: absolute;
	       				width: 100mm;
	       				height: 51.6mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 127mm;
	       				left: 0mm;
	       				top: 51.6mm;
	       			}
	       			#name h1{
	       				padding-top: 5%;
	       				font-size: 24px;
	       			}
	       			#name p{
	       				margin-bottom: 7%;
	       			}

	       			#companyname h1{
	       				font-size: 16px;
	       			}
	       			#companyname p{
	       				margin-bottom: 7%;
	       			}

	       			#designation h1{
	       				font-size: 16px;
	       			}
	       			#designation p{
	       				margin-bottom: 10%;
	       			}
	       			#eventname h1{
	       				font-style: italic;
	       				text-align: right;
	       				margin-right: 5%;
	       				font-family: Century Gothic Ms;
	       				font-size: 12px;
	       			}
	       		</style>
	        @break

	    @case(4)
	       		{{-- Sample 4 - ID 1 --}}
	       		<style type="text/css">
	       			* { margin: 0; padding: 0; }
	       			@page { size: 53.98mm  85.60mm; }
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
	       				/*left: 13.5mm;*/
	       				position: absolute;
	       				width: 53.98mm;
	       				height: 50.60mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 53.98mm;
	       				left: 0mm;
	       				top: 50.60mm;
	       			}
	       			#name h1{
	       				padding-top: 3%;
	       				font-size: 15px;
	       			}
	       			#name p{
	       				margin-bottom: 10%;
	       			}

	       			#companyname h1{
	       				font-size: 8px;
	       			}
	       			#companyname p{
	       				margin-bottom: 10%;
	       			}

	       			#designation h1{
	       				font-size: 8px;
	       			}
	       			#designation p{
	       				margin-bottom: 15%;
	       			}
	       			#eventname h1{
	       				font-style: italic;
	       				text-align: right;
	       				margin-right: 5%;
	       				font-family: Century Gothic Ms;
	       				font-size: 6px;
	       			}
	       		</style>
	        @break

	@endswitch
	
	


	



	





	


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