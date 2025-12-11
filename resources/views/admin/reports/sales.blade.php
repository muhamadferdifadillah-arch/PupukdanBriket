@extends('layouts.admin')

@section('title', 'Sales Overview')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Sales Overview (Per Bulan)</h5>

                <div id="salesChart"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Total Penjualan',
            data: {!! json_encode(array_values($monthlySales)) !!}
        }],
        xaxis: {
            categories: [
                'Jan','Feb','Mar','Apr','Mei','Jun',
                'Jul','Agu','Sep','Okt','Nov','Des'
            ]
        }
    };

    var chart = new ApexCharts(
        document.querySelector("#salesChart"),
        options
    );

    chart.render();
</script>
@endpush
