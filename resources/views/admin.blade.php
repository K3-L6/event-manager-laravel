@extends('layouts.app')
@push('title') 
  Dashboard 
@endpush

@push('sidebar')
  @include('layouts.sidebar')
@endpush

@section('content')

<section class="dashboard-header">
  <div class="container-fluid">
    <div class="row">
      <!-- Statistics -->
      <div class="statistics col-lg-3 col-12">
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-red"><i class="fa fa-bar-chart"></i></div>
          <div class="text"><strong>0</strong><br><small>Active Guest</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-orange"><i class="fa fa-dollar"></i></div>
          <div class="text"><strong>50</strong><br><small>Invited Guest</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-blue"><i class="fa fa-money"></i></div>
          <div class="text"><strong>50</strong><br><small>Walk-Ins</small></div>
        </div>
        <div class="statistic d-flex align-items-center bg-white has-shadow">
          <div class="icon bg-green"><i class="fa fa-credit-card"></i></div>
          <div class="text"><strong>100</strong><br><small>Total Guest</small></div>
        </div>
      </div>
      <!-- Line Chart            -->
      <div class="chart col-lg-9 col-12">
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
                    "Active Guesst",
                    "Invited Guest",
                    "Walk-Ins",
                    "Total Guest"
                ],
                datasets: [
                    {
                        label: "Event Sales Chart",
                        backgroundColor: [
                            '#ff7676',
                            '#54e69d',
                            '#85b4f2',
                            '#ffc36d'
                        
                        ],
                        hoverBackgroundColor: [
                            '#ff7676',
                            '#54e69d',
                            '#85b4f2',
                            '#ffc36d'
                        ],
                        borderColor: [
                            '#ff7676',
                            '#54e69d',
                            '#85b4f2',
                            '#ffc36d'
                        ],
                        borderWidth: 1,
                        data: [0, 50, 50, 100],
                    },
                ]
            }
        });
    });

</script>
@endpush
