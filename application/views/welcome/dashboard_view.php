<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">

            <div id="chartContainer" style="height: 370px; width: 100%;"></div>

        </div>
    </div>
</div>

<script>
    window.onload = function() {

        var options = {
            animationEnabled: true,
            theme: "light2", //"light1", "light2", "dark1", "dark2"
            title: {
                text: "Sales Analysis -  <?php echo date('M Y') ?>"
            },
            data: [{
                type: "funnel",
                toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
                indexLabel: "{label} ({percentage}%)",
                dataPoints: [{
                        y: 1800,
                        label: "Leads"
                    },
                    {
                        y: 1552,
                        label: "Initial Communication"
                    },
                    {
                        y: 1320,
                        label: "Customer Evaluation"
                    },
                    {
                        y: 885,
                        label: "Negotiation"
                    },
                    {
                        y: 678,
                        label: "Order Received"
                    },
                    {
                        y: 617,
                        label: "Payment"
                    }
                ]
            }]
        };
        calculatePercentage();
        $("#chartContainer").CanvasJSChart(options);

        function calculatePercentage() {
            var dataPoint = options.data[0].dataPoints;
            var total = dataPoint[0].y;
            for (var i = 0; i < dataPoint.length; i++) {
                if (i == 0) {
                    options.data[0].dataPoints[i].percentage = 100;
                } else {
                    options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
                }
            }
        }

    }
</script>