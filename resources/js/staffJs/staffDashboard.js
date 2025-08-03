import Chart from 'chart.js/auto';

/**
 * Chart 1: Monthly Reports Trend (Line Chart)
 */
const trendCtx = document.getElementById('monthlyReportsChart');
if (trendCtx) {
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Reports Submitted',
                data: [10, 20, 18, 25, 30, 22], // Dummy values
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

/**
 * Chart 2: Report Type Distribution (Pie Chart)
 */
const typeCtx = document.getElementById('reportTypeChart');
if (typeCtx) {
    new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: ['Accident', 'Complaint', 'Maintenance'],
            datasets: [{
                data: [45, 25, 30], // Dummy values
                backgroundColor: ['#e11d48', '#f97316', '#10b981'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
}

/**
 * Chart 3: Reports by Department (Horizontal Bar Chart)
 */
const deptCtx = document.getElementById('reportsByDepartmentChart');
if (deptCtx) {
    new Chart(deptCtx, {
        type: 'bar',
        data: {
            labels: ['HR', 'IT', 'Finance', 'Facilities', 'Legal'],
            datasets: [{
                label: 'Reports',
                data: [12, 19, 7, 15, 9], // Dummy values
                backgroundColor: '#7c3aed'
            }]
        },
        options: {
            indexAxis: 'y', // Makes it horizontal
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
}

/**
 * Chart 4: Report Completion Status (Doughnut)
 */
const completionCtx = document.getElementById('completionStatusChart');
if (completionCtx) {
    new Chart(completionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Under Review'],
            datasets: [{
                data: [120, 35, 15], // Dummy values
                backgroundColor: ['#22c55e', '#facc15', '#3b82f6'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
}
