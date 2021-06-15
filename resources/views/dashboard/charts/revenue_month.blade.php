
<script>
    let myChart = document.getElementById('revenue_month').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
        type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:[
                @foreach($last_revenue_month as $last_rev_month)
                '{{$last_rev_month->day_nbr}}',
                @endforeach
                    //'Jan', 'Fab', 'Mar', 'Apr', 'Mai', 'Jun'
            ],
            datasets:[
                //First graph
                {
                label:'Revenue (DA)',
                data:[
                    @foreach($last_revenue_month as $last_rev_month)
                        {{$last_rev_month->day_revenue}},
                    @endforeach
                    //640040, 181045, 153060, 106519, 105162, 95072
                ],

                //backgroundColor:'green',
                backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth:1,
                borderColor:'#777',
                hoverBorderWidth:3,
                hoverBorderColor:'#000'
            },

            ]
        },


        options:{
            title:{
                display:false,
                text:'Last 30 Days Revenue',
                fontSize:25,
            },
            legend:{
                display:true,
                position:'right',
                labels:{
                    fontColor:'#000'
                }
            },
            layout:{
                padding:{
                    left:20,
                    right:0,
                    bottom:0,
                    top:0
                }
            },
            tooltips:{
                enabled:true
            }
        }
    });
</script>

