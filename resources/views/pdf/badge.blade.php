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
						font-size: 7px;
					}
					#qrimg img{
						left: 25.8mm;
						position: absolute;
						width: 50mm;
						height: 50mm;
						z-index: -1;
					}
					#infowrapper{
						position: relative;
						text-align: center;
						width: 101.6mm;
						left: 0mm;
						top: 47mm;
					}
					#name h1{
						/*padding-top: 1%;*/
						font-size: 12px;
					}
					#name p{
						margin-bottom: 3%;
					}

					#companyname h1{
						font-size: 9px;
					}
					#companyname p{
						margin-bottom: 3%;
					}

					#designation h1{
						font-size: 9px;
					}
					#designation p{
						margin-bottom: 3%;
					}

					#badgeid h1{
						font-size: 9px;
					}
					#badgeid p{
						margin-bottom: 3%;
					}

					#eventname h1{
						font-style: italic;
						text-align: right;
						margin-right: 5%;
						font-family: Century Gothic Ms;
						font-size: 7px;
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
	       				font-size: 13px;
	       			}
	       			#qrimg img{
	       				left: 15.8mm;
	       				position: absolute;
	       				width: 70mm;
	       				height: 70mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 101.6mm;
	       				left: 0mm;
	       				top: 65mm;
	       			}
	       			#name h1{
	       				font-size: 23px;
	       			}
	       			#name p{
	       				margin-bottom: 8%;
	       			}

	       			#companyname h1{
	       				font-size: 14px;
	       			}
	       			#companyname p{
	       				margin-bottom: 8%;
	       			}

	       			#designation h1{
	       				font-size: 14px;
	       			}
	       			#designation p{
	       				margin-bottom: 8%;
	       			}

	       			#badgeid h1{
	       				font-size: 14px;
	       			}
	       			#badgeid p{
	       				margin-bottom: 10%;
	       			}

	       			#eventname h1{
	       				font-style: italic;
	       				text-align: right;
	       				margin-right: 5%;
	       				font-family: Century Gothic Ms;
	       				font-size: 10px;
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
	       				font-size: 8px;
	       			}
	       			#qrimg img{
	       				left: 31mm;
	       				position: absolute;
	       				width: 65mm;
	       				height: 65mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 127mm;
	       				left: 0mm;
	       				top: 60mm;
	       			}
	       			#name h1{
	       				font-size: 18px;
	       			}
	       			#name p{
	       				margin-bottom: 5%;
	       			}

	       			#companyname h1{
	       				font-size: 13px;
	       			}
	       			#companyname p{
	       				margin-bottom: 5%;
	       			}

	       			#designation h1{
	       				font-size: 13px;
	       			}
	       			#designation p{
	       				margin-bottom: 5%;
	       			}

	       			#badgeid h1{
	       				font-size: 13px;
	       			}
	       			#badgeid p{
	       				margin-bottom: 5%;
	       			}

	       			#eventname h1{
	       				font-style: italic;
	       				text-align: right;
	       				margin-right: 5%;
	       				font-family: Century Gothic Ms;
	       				font-size: 10px;
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
	       				height: 53.98mm;
	       				z-index: -1;
	       			}
	       			#infowrapper{
	       				position: relative;
	       				text-align: center;
	       				width: 53.98mm;
	       				left: 0mm;
	       				top: 50mm;
	       			}
	       			#name h1{
	       				/*padding-top: 5%;*/
	       				font-size: 13px;
	       			}
	       			#name p{
	       				margin-bottom: 8%;
	       			}

	       			#companyname h1{
	       				font-size: 8px;
	       			}
	       			#companyname p{
	       				margin-bottom: 8%;
	       			}

	       			#designation h1{
	       				font-size: 8px;
	       			}
	       			#designation p{
	       				margin-bottom: 8%;
	       			}

	       			#badgeid h1{
	       				font-size: 8px;
	       			}
	       			#badgeid p{
	       				margin-bottom: 5%;
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
	    @case(5)
				{{-- Sample 5 - ID 2 --}}
				<style type="text/css">
					* { margin: 0; padding: 0; }
					@page { size: 74mm  105mm; }
					body{
						font-family: monospace;
					}
					p{
						font-style: italic;
						font-size: 9px;
					}
					#qrimg img{
						/*left: 13.5mm;*/
						position: absolute;
						left: 7mm;
						width: 60mm;
						height: 60mm;
						z-index: -1;
					}
					#infowrapper{
						position: relative;
						text-align: center;
						width: 74mm;
						left: 0mm;
						top: 60mm;
					}
					#name h1{
						font-size: 17px;
					}
					#name p{
						margin-bottom: 6%;
					}

					#companyname h1{
						font-size: 11px;
					}
					#companyname p{
						margin-bottom: 6%;
					}

					#designation h1{
						font-size: 11px;
					}
					#designation p{
						margin-bottom: 6%;
					}

					#badgeid h1{
						font-size: 11px;
					}
					#badgeid p{
						margin-bottom: 10%;
					}

					#eventname h1{
						font-style: italic;
						text-align: right;
						margin-right: 5%;
						font-family: Century Gothic Ms;
						font-size: 10px;
					}
				</style>
	    	@break

	   	    @case(6)
	   				{{-- Sample 6 - ID 3 --}}
	   				<style type="text/css">
	   					* { margin: 0; padding: 0; }
	   					@page { size: 88mm  125mm; }
	   					body{
	   						font-family: monospace;
	   					}
	   					p{
	   						font-style: italic;
	   						font-size: 12px;
	   					}
	   					#qrimg img{
	   						/*left: 13.5mm;*/
	   						position: absolute;
	   						left: 9mm;
	   						width: 70mm;
	   						height: 70mm;
	   						z-index: -1;
	   					}
	   					#infowrapper{
	   						position: relative;
	   						text-align: center;
	   						width: 88mm;
	   						left: 0mm;
	   						top: 68mm;
	   					}
	   					#name h1{
	   						font-size: 19px;
	   					}
	   					#name p{
	   						margin-bottom: 8%;
	   					}

	   					#companyname h1{
	   						font-size: 12px;
	   					}
	   					#companyname p{
	   						margin-bottom: 8%;
	   					}

	   					#designation h1{
	   						font-size: 12px;
	   					}
	   					#designation p{
	   						margin-bottom: 8%;
	   					}

	   					#badgeid h1{
	   						font-size: 12px;
	   					}
	   					#badgeid p{
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
		<div id="badgeid">
			<h1>{{$idcard}}</h1>
			<p>(Badge ID)</p>
		</div>
		<div id="eventname">
			<h1>{{ucwords($eventname)}}</h1>
		</div>		
	</div>
</body>
</html>