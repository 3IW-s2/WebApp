<h1>Dashboard</h1>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="chart-container">
    <div id="bar-chart-buttons" class="tab-buttons">
        <button onclick="updateChart('day', this)" class="active">Par jour</button>
        <button onclick="updateChart('week', this)">Par semaine</button>
        <button onclick="updateChart('month', this)">Par mois</button>
        <button onclick="updateChart('year', this)">Par an</button>
        <button onclick="updateChart('years', this)">Par années</button>
    </div>
    <canvas id="bar-chart"></canvas>
</div>
<script>
    const data = {
        day: {
            labels: getHourLabels(),
            values: [10, 15, 20, 12, 8, 5, 7, 9, 11, 14, 18, 16, 13, 10, 8, 6, 5, 4, 7, 9, 11, 14, 15, 12, 13]
        },
        week: {
            labels: getWeekLabels(),
            values: [50, 45, 60, 70, 55, 40, 45]
        },
        month: {
            labels: getMonthLabels(),
            values: [200, 250, 300, 270, 220, 180, 190, 230, 280, 320, 310, 260, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        },
        year: {
            labels: getYearLabels(),
            values: [1200, 1500, 1800, 2000, 1900, 1700, 1600, 1700, 1900, 2200, 2300, 2100]
        },
        years: {
            labels: Array.from({ length: 7 }, (_, i) => `Année ${i + 2017}`),
            values: [10000, 12000, 15000, 18000, 22000, 25000, 28000]
        }
    };

    const options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    const ctx = document.getElementById('bar-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.day.labels,
            datasets: [{
                label: 'Nombre de vues',
                data: data.day.values,
                backgroundColor: 'rgba(13, 41, 140, 0.2)',
                borderColor: 'rgba(13, 41, 140, 1)',
                borderWidth: 1
            }]
        },
        options: options
    });

    function updateChart(type, button) {
        const newData = data[type];
        chart.data.labels = newData.labels;
        chart.data.datasets[0].data = newData.values;
        chart.update();

        const buttons = document.querySelectorAll('#bar-chart-buttons button');
        buttons.forEach(btn => btn.classList.remove('active'));

        button.classList.add('active');
    }

    function getHourLabels() {
        const labels = Array.from({ length: 24 }, (_, i) => `${i.toString().padStart(2, '0')}h00`);
        return labels;
    }

    function getWeekLabels() {
        const currentDate = new Date();
        const currentDay = currentDate.getDay();
        const daysOfWeek = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
        const labels = [];

        for (let i = 0; i < 7; i++) {
            const day = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() - (currentDay - i));
            const formattedDate = `${day.getDate().toString().padStart(2, '0')}/${(day.getMonth() + 1).toString().padStart(2, '0')}`;
            labels.push(formattedDate);
        }

        return labels;
    }

    function getMonthLabels() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth();
        const daysInMonth = new Date(currentDate.getFullYear(), currentMonth + 1, 0).getDate();
        const labels = [];

        for (let i = 1; i <= daysInMonth; i++) {
            const day = new Date(currentDate.getFullYear(), currentMonth, i);
            const formattedDate = `${day.getDate().toString().padStart(2, '0')}/${(day.getMonth() + 1).toString().padStart(2, '0')}`;
            labels.push(formattedDate);
        }

        return labels;
    }

    function getYearLabels() {
        const months = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];
        return months;
    }
</script>