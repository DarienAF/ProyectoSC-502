function CargarDatosActividad() {
    $.ajax({
        url: './index.php?controller=ReportsPage&action=obtenerActividad',
        method: 'POST',
        success: function(data) {
            data = JSON.parse(data);

            var ctx = document.getElementById('actividadChart').getContext('2d');
            var actividadChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Activos','Inactivos'], 
                    datasets: [{
                        label: 'Usuarios',
                        data: [data.miembros_activos, data.miembros_inactivos], 
                        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'], 
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'], 
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
}