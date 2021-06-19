<script>
    let myChart4 = document.getElementById('revenue_year').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart4 = new Chart(myChart4, {
        type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:[
                @foreach($last_revenue_year as $last_rev_y)
                '{{$last_rev_y->month_name}}',
                @endforeach
                    //'Jan', 'Fab', 'Mar', 'Apr', 'Mai', 'Jun'
            ],
            datasets:[
                //First graph
                {
                label:'Revenue (DA)',
                data:[
                    @foreach($last_revenue_year as $last_rev_y)
                        {{$last_rev_y->month_revenue}},
                    @endforeach
                    //640040, 181045, 153060, 106519, 105162, 95072
                ],

                //backgroundColor:'green',
                backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
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
                display:true,
                text:'Revenue',
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
