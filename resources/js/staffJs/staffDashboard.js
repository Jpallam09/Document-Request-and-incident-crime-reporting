import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", () => {
    // Chart 1: Monthly Reports Trend
    const trendCtx = document.getElementById("monthlyReportsChart");
    if (trendCtx) {
        fetch("monthlyTrend")
            .then((res) => res.json())
            .then((chartData) => {
                new Chart(trendCtx, {
                    type: "line",
                    data: {
                        labels: chartData.labels,
                        datasets: [
                            {
                                label: "Reports Submitted",
                                data: chartData.data,
                                borderColor: "#2563eb",
                                backgroundColor: "rgba(37, 99, 235, 0.2)",
                                fill: true,
                                tension: 0.4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } },
                    },
                });
            })
            .catch((err) => console.error("Chart load error:", err));
    }

    // Chart 2: Report Type Distribution
// Chart 2: Report Type Distribution
const typeCtx = document.getElementById("reportTypeChart");
if (typeCtx) {
    fetch('reportType')
        .then(res => res.json())
        .then(chartData => {
            new Chart(typeCtx, {
                type: "pie",
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: ["#e11d48", "#f97316", "#10b981", "#6366f1"],
                        borderWidth: 1,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "bottom"
                        }
                    }
                }
            });
        })
        .catch(err => console.error('Pie chart load error:', err));
}

    // Chart 3: Reports by Department
    const deptCtx = document.getElementById("reportsByDepartmentChart");
    if (deptCtx) {
        new Chart(deptCtx, {
            type: "bar",
            data: {
                labels: [
                    "Bacarreña",
                    "Bagong Sikat",
                    "Bella Luz",
                    "Dagupan",
                    "Daramuangan Norte",
                    "Daramuangan Sur",
                ],
                datasets: [
                    {
                        label: "Reports",
                        data: [12, 19, 7, 15, 9],
                        backgroundColor: "#7c3aed",
                    },
                ],
            },
            options: {
                indexAxis: "y",
                responsive: true,
                scales: { x: { beginAtZero: true } },
                plugins: { legend: { display: false } },
            },
        });
    }

    // Chart 4: Report Completion Status
    const completionCtx = document.getElementById("completionStatusChart");
    if (completionCtx) {
        new Chart(completionCtx, {
            type: "doughnut",
            data: {
                labels: ["Completed", "Pending", "Under Review"],
                datasets: [
                    {
                        data: [120, 35, 15],
                        backgroundColor: ["#22c55e", "#facc15", "#3b82f6"],
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: { legend: { position: "bottom" } },
            },
        });
    }
});
