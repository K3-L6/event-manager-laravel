@extends('layouts.app')
@push('title') 
  Dashboard 
@endpush

@push('loader')
 @include('layouts.loader')
 @push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
           $('.loader').fadeOut(3000); 
        }); 
    </script>
 @endpush
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')

<section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <!-- Statistics -->
      <div class="statistics col-3">
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_walkin.png') }}"></div>
          <div class="text"><strong>{{$walkin}}</strong><br><small>Walk-In</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_prereg.png') }}"></div>
          <div class="text"><strong>{{$prereg}}</strong><br><small>Pre-Registered</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_totalguest.png') }}"></div>
          <div class="text"><strong>{{$total}}</strong><br><small>Total Guest</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-blue"><img class="iconimage" src="{{ asset('img/m_guestlog.png') }}"></div>
          <div class="text"><strong>{{$guestlogs}}</strong><br><small>Guest Logs</small></div>
        </div>
      </div>
      <!-- Line Chart            -->
      <div class="chart col-9">
        <div class="line-chart bg-white d-flex align-items-center justify-content-center has-shadow">
          <canvas id="barChartExample"></canvas>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection

@push('scripts')
<script type="text/javascript">
    /*global $, document*/
    $(document).ready(function () {

        'use strict';
        // ------------------------------------------------------- //
        // Bar Chart
        // ------------------------------------------------------ //
        var BARCHARTEXMPLE    = $('#barChartExample');
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            options: {

                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: '#eee'
                        }

                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            suggestedMin: 0,
                            beginAtZero: true 
                        },
                        gridLines: {
                            color: '#eee'
                        }
                    }]
                },
                legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                           label: function(tooltipItem) {
                                  return tooltipItem.yLabel;
                        }
                    }
                },
            },
            data: {
                labels: [
                    "Walk-In Guest",
                    "Pre-Registered Guest",
                    "Total Guest",
                    "Guest Logs"
                ],
                datasets: [
                    {
                        label: "Event Sales Chart",
                        backgroundColor: [
                            '#379392',
                            '#379392',
                            '#379392',
                            '#379392'
                        
                        ],
                        hoverBackgroundColor: [
                            '#379392',
                            '#379392',
                            '#379392',
                            '#379392'
                        ],
                        borderColor: [
                            '#379392',
                            '#379392',
                            '#379392',
                            '#379392'
                        ],
                        borderWidth: 1,
                        data: [{{$walkin}}, {{$prereg}}, {{$total}}, {{$guestlogs}}],
                    },
                ]
            }
        });

    });

</script>
@endpush
