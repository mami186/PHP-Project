document.addEventListener("DOMContentLoaded", function () {
    // Destroy existing charts if needed
    if (Chart.getChart("lineChart")) {
        Chart.getChart("lineChart").destroy();
    }
    if (Chart.getChart("doughnutChart")) {
        Chart.getChart("doughnutChart").destroy();
    }

    var ctx1 = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [{
                label: "Expenses",
                data: [500, 800, 1200, 1500, 1000, 2000],
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 2,
                fill: false
            }]
        }
    });

    var ctx2 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels: ["Savings", "Expenses"],
            datasets: [{
                data: [60, 40],
                backgroundColor: ["#36A2EB", "#FF6384"]
            }]
        }
    });
});
