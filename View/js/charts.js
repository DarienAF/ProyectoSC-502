$(document).ready(function () {
    CargarDatosActividad();
    
    function CargarDatosActividad() {
        fetch('./index.php?controller=ReportsPage&action=obtenerActividad')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('actividadChart').getContext('2d');
                var actividadChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Activos', 'Inactivos'],
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
            })
            .catch(error => console.error('Error:', error));
    }
    CargarDatosClasesAsistidas()
    function CargarDatosClasesAsistidas() {
        fetch('./index.php?controller=ReportsPage&action=obtenerClasesAsistidas')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.nombres_clases, // Etiquetas
                        datasets: [{
                            label: 'Cantidad de Asistencias',
                            data: data.conteos, // Datos
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
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
            })
            .catch(error => console.error('Error:', error));
    }

    CargarDatosCategoriasAsistidas() 
    function CargarDatosCategoriasAsistidas() {
        fetch('./index.php?controller=ReportsPage&action=obtenerCategoriasAsistidas')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie', // Cambiamos el tipo de gráfico a 'pie'
                    data: {
                        labels: data.nombres_categorias, // Etiquetas
                        datasets: [{
                            data: data.cantidades_asistentes, // Datos
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }
    
    CargarPromedioPeso()
    function CargarPromedioPeso() {
        fetch('./index.php?controller=ReportsPage&action=obtenerPromedioPeso')
            .then(response => response.json())
            .then(data => {
                var ctx = document.getElementById('myChart3').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line', // Cambiamos el tipo de gráfico a 'line'
                    data: {
                        labels: data.meses, // Etiquetas
                        datasets: [{
                            label: 'Promedio de peso',
                            data: data.promedios, // Datos
                            fill: false,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Promedio de peso en los últimos meses'
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }
    
    
    
});