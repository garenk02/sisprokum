<div style="background-color:#fff;">
    <canvas id="myChart" width="400" height="180"></canvas>
    <script>
    $(function () {
        var dLabels = {!! json_encode($data['labels']) !!};
        var dDatasets = {!! json_encode($data['datasets']) !!};
        var dBgColor = {!! json_encode($data['bg_colors']) !!};
        var dBorderColor = {!! json_encode($data['border_colors']) !!};
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dLabels,
                datasets: [{
                    label: 'Produk Hukum',
                    data: dDatasets,
                    backgroundColor: dBgColor,
                    borderColor: dBorderColor,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
    </script>
</div>
