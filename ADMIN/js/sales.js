
$(document).ready(function() {
    $.ajax({
        url: "./data/income.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var day = [];
            var amount = [];

            for (var i in data) {
                day.push(data[i].day);
                amount.push(data[i].amount);
            }
            var chartdata = {
                labels: day,
                datasets: [{
                    label: 'Daily Sales Report',
                    backgroundColor: 'forestgreen',
                    borderColor: 'orange',
                    data: amount
                }]
            };
            var ctx = $("#sales");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
 
});
