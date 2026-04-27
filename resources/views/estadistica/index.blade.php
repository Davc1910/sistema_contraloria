@extends('layouts.index')

<title>@yield('title') Estadística</title>

@section('css-datatable')
        <link href="{{ asset ('assets/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset ('assets/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset ('assets/css/plugins.min.css')}}" rel="stylesheet">
        <link href="{{ asset ('assets/css/kaiadmin.min.css')}}" rel="stylesheet">
        <link href="{{ asset ('assets/css/demo.css')}}" rel="stylesheet">
@endsection


@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h2 class="font-weight-bold text-primary">Estadísticas</h2>      
                    </div>

                   
                        
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Evaluaciones realizadas por mes</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar" style="height: 350px;">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Evaluaciones Aprobadas y Negadas por mes</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar" style="height: 350px;">
                                        <canvas id="myHorizontalBarChart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>

                      
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Seguimientos realizadas por mes</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar" style="height: 350px;">
                                        <canvas id="myBarChart5"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        {{-- <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">############</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart2"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">####################</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart3"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
                    

                </div>

            </div>
        </div>
    </div>
</div>

    <script src="{{ asset ('https://cdn.jsdelivr.net/npm/chart.js')  }}"></script>

    {{-- ? FUNCIÓN PARA MOSTRAR LOS EVALUACIONES POR MES --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() { 
            var ctx = document.getElementById("myBarChart").getContext('2d');
            var data = @json($data_evaluacion); 

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 12
                            },
                            maxBarThickness: 25,
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100, // Fijamos el máximo en 15 registros
                                padding: 10,
                                callback: function(value) {
                                    return value; // Mostrar los valores tal cual sin ningún símbolo extra
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + tooltipItem.yLabel; // Mostrar solo el número
                            }
                        }
                    }
                }
            }); 
        });
    </script>

     {{-- * FUNCION PARA MOSTRAR LAS EVALUACIONES CON EL ESTATUS APROBADAS Y PENDIENTES POR MES --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("myHorizontalBarChart").getContext('2d');
            var data = @json($data_aprobado);

            var myHorizontalBarChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Permitir ajuste del tamaño
                    legend: {
                        position: 'top'
                    },  
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100, // Fijamos el máximo en 15 registros
                                padding: 10,
                                callback: function(value) {
                                    return value; // Mostrar los valores tal cual sin ningún símbolo extra
                                }// Ajustar el máximo dinámicamente
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.labels[tooltipItem.index] || '';
                                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                return label + ': ' + value;
                            }
                        }
                    }
                }
            });
        });
    </script>

    {{-- * FUNCIÓN PARA MOSTRAR LOS SEGUIMIENTOS POR MES (CORREGIDO ID Y VARIABLES y Escala) --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() { 
            var ctx = document.getElementById("myBarChart5").getContext('2d');
            var data = @json($data_seguimiento); 

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 12
                            },
                            maxBarThickness: 25,
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100, // Fijamos el máximo en 15 registros
                                padding: 10,
                                callback: function(value) {
                                    return value; // Mostrar los valores tal cual sin ningún símbolo extra
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + tooltipItem.yLabel; // Mostrar solo el número
                            }
                        }
                    }
                }
            }); 
        });
    </script>

    
@endsection