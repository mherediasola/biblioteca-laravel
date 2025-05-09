@extends('base')
@section('titulo', 'Dashboard')
@section('contenido')
<div class="container">
    <canvas id="dashboard"></canvas>
</div>

<script>
    const grafica = document.getElementById('dashboard');

    var datos = {!! json_encode($datos) !!}

    console.log(datos);

    new Chart(grafica, {
        type: 'bar',
        data: {
                labels: datos.map(row => row.titulo),
                datasets: [{
                label: 'Ejemplar / Número de préstamos',
                data: datos.map(row => row.cantidad),
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
</script>

@endsection
