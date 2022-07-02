$(document).ready(function() {
    $.ajax({
        url: "./data/sales.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var Day = [];
            var Sales = [];

            for (var i in data) {
                Day.push(data[i].Day);
                Sales.push(data[i].Sales);
            }

            var chartdata = {
                labels: Day,
                datasets: [{
                    label: 'Daily Sales Report',
                    backgroundColor: 'forestgreen',
                    borderColor: 'orange',
                    data: Sales
                }]
            };
            var ctx = $("#income");

            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});