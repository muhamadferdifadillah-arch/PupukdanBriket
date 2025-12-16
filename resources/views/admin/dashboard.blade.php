@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  {{-- Debug: Check if variables exist --}}
  @if(!isset($weeklyStats))
    <div class="alert alert-danger">
      <h4>Error: $weeklyStats variable is not defined!</h4>
      <p>Available variables: {{ implode(', ', array_keys(get_defined_vars())) }}</p>
    </div>
  @endif

  @if(!isset($salesByMonth))
    <div class="alert alert-danger">
      <h4>Error: $salesByMonth variable is not defined!</h4>
    </div>
  @endif

  @if(!isset($recentTransactions))
    <div class="alert alert-danger">
      <h4>Error: $recentTransactions variable is not defined!</h4>
    </div>
  @endif

  {{-- Show data if exists --}}
  @if(isset($weeklyStats) && isset($salesByMonth) && isset($recentTransactions))
  <div class="row">
    <div class="col-lg-8">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-md-flex align-items-center">
            <div>
              <h4 class="card-title">Sales Overview</h4>
              <p class="card-subtitle">12 Months Sales Comparison</p>
            </div>
            <div class="ms-auto">
              <ul class="list-unstyled mb-0">
                <li class="list-inline-item text-primary">
                  <span class="round-8 text-bg-primary rounded-circle me-1 d-inline-block"></span>
                  Current Year
                </li>
                <li class="list-inline-item text-info">
                  <span class="round-8 text-bg-info rounded-circle me-1 d-inline-block"></span>
                  Last Year
                </li>
              </ul>
            </div>
          </div>
          <div id="sales-overview" class="mt-4 mx-n6"></div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card overflow-hidden">
        <div class="card-body pb-0">
          <div class="d-flex align-items-start">
            <div>
              <h4 class="card-title">Weekly Stats</h4>
              <p class="card-subtitle">Performance metrics</p>
            </div>
          </div>

          <div class="mt-4 pb-3 d-flex align-items-center">
            <span class="btn btn-primary rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-shopping-cart fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">Top Sales</h5>
              <span class="text-muted fs-3">Rp {{ number_format($weeklyStats['top_sales']['amount'], 0, ',', '.') }}</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-{{ $weeklyStats['top_sales']['growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $weeklyStats['top_sales']['growth'] >= 0 ? 'success' : 'danger' }}">
                {{ $weeklyStats['top_sales']['growth'] >= 0 ? '+' : '' }}{{ $weeklyStats['top_sales']['growth'] }}%
              </span>
            </div>
          </div>

          <div class="py-3 d-flex align-items-center">
            <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-star fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">Best Product</h5>
              <span class="text-muted fs-3">{{ $weeklyStats['best_product']['name'] }}</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-{{ $weeklyStats['best_product']['growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $weeklyStats['best_product']['growth'] >= 0 ? 'success' : 'danger' }}">
                {{ $weeklyStats['best_product']['growth'] >= 0 ? '+' : '' }}{{ $weeklyStats['best_product']['growth'] }}%
              </span>
            </div>
          </div>

          <div class="py-3 d-flex align-items-center">
            <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-message-dots fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">Reviews</h5>
              <span class="text-muted fs-3">{{ number_format($weeklyStats['reviews']['count']) }} Reviews</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-{{ $weeklyStats['reviews']['growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $weeklyStats['reviews']['growth'] >= 0 ? 'success' : 'danger' }}">
                {{ $weeklyStats['reviews']['growth'] >= 0 ? '+' : '' }}{{ $weeklyStats['reviews']['growth'] }}%
              </span>
            </div>
          </div>

          <div class="pt-3 mb-7 d-flex align-items-center">
            <span class="btn btn-info rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-users fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">New Users</h5>
              <span class="text-muted fs-3">{{ number_format($weeklyStats['new_users']['count']) }} Users</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-{{ $weeklyStats['new_users']['growth'] >= 0 ? 'success' : 'danger' }}-subtle text-{{ $weeklyStats['new_users']['growth'] >= 0 ? 'success' : 'danger' }}">
                {{ $weeklyStats['new_users']['growth'] >= 0 ? '+' : '' }}{{ $weeklyStats['new_users']['growth'] }}%
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-md-flex align-items-center">
            <div>
              <h4 class="card-title">Recent Transactions</h4>
              <p class="card-subtitle">Latest orders and activities</p>
            </div>
            <div class="ms-auto mt-3 mt-md-0">
              <span class="badge bg-light-primary text-primary px-3 py-2">
                <i class="ti ti-calendar me-1"></i>
                Last 5 Transactions
              </span>
            </div>
          </div>

          <div class="table-responsive mt-4">
            <table class="table mb-0 text-nowrap align-middle">
              <thead>
                <tr>
                  <th scope="col" class="px-0 text-muted">Customer</th>
                  <th scope="col" class="px-0 text-muted">Product</th>
                  <th scope="col" class="px-0 text-muted">Status</th>
                  <th scope="col" class="px-0 text-muted text-end">Amount</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentTransactions as $transaction)
                <tr>
                  <td class="px-0">
                    <div class="d-flex align-items-center">
                      <img src="{{ asset($transaction['customer']['avatar']) }}" 
                           class="rounded-circle" width="40" height="40" 
                           alt="{{ $transaction['customer']['name'] }}"
                           onerror="this.src='{{ asset('admin/assets/images/profile/user-1.jpg') }}'" />
                      <div class="ms-3">
                        <h6 class="mb-0 fw-bolder">{{ $transaction['customer']['name'] }}</h6>
                        <span class="text-muted fs-2">{{ $transaction['customer']['email'] }}</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-0">{{ $transaction['product'] }}</td>
                  <td class="px-0">
                    @if($transaction['status'] == 'completed')
                      <span class="badge bg-success">Completed</span>
                    @elseif($transaction['status'] == 'pending')
                      <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($transaction['status'] == 'processing')
                      <span class="badge bg-info">Processing</span>
                    @elseif($transaction['status'] == 'cancelled')
                      <span class="badge bg-danger">Cancelled</span>
                    @else
                      <span class="badge bg-secondary">{{ ucfirst($transaction['status']) }}</span>
                    @endif
                  </td>
                  <td class="px-0 text-dark fw-medium text-end">
                    Rp {{ number_format($transaction['amount'], 0, ',', '.') }}
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center">
                      <i class="ti ti-shopping-cart-off fs-8 text-muted mb-2"></i>
                      <p class="text-muted mb-0">No transactions found</p>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection

@push('css')
<style>
  .round-8 {
    width: 8px;
    height: 8px;
  }
  
  .round-48 {
    width: 48px;
    height: 48px;
  }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if(isset($salesByMonth))
    // Data dari controller
    const salesData = @json($salesByMonth);
    
    // Sales Overview Chart Configuration
    const chartOptions = {
      series: [
        {
          name: 'Current Year',
          data: salesData.current
        },
        {
          name: 'Last Year',
          data: salesData.last
        }
      ],
      chart: {
        type: 'area',
        height: 350,
        fontFamily: 'inherit',
        foreColor: '#adb0bb',
        toolbar: {
          show: false
        }
      },
      colors: ['#5D87FF', '#49BEFF'],
      dataLabels: {
        enabled: false
      },
      markers: {
        size: 0
      },
      legend: {
        show: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      grid: {
        show: true,
        strokeDashArray: 3,
        borderColor: 'rgba(0,0,0,.1)'
      },
      xaxis: {
        categories: salesData.months,
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        }
      },
      yaxis: {
        labels: {
          formatter: function(value) {
            return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
          }
        }
      },
      tooltip: {
        theme: 'dark',
        y: {
          formatter: function(value) {
            return 'Rp ' + value.toLocaleString('id-ID');
          }
        }
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#5D87FF', '#49BEFF'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 0.4,
          opacityTo: 0.1,
          stops: [0, 100]
        }
      }
    };

    // Render Chart
    const chart = new ApexCharts(document.querySelector("#sales-overview"), chartOptions);
    chart.render();
    @endif
  });
</script>
@endpush