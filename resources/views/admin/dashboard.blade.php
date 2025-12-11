@extends('layouts.admin')

@section('title', 'Home')

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-md-flex align-items-center">
            <div>
              <h4 class="card-title">Sales Overview</h4>
              
              <p class="card-subtitle">Monthly sales performance</p>
            </div>
            <div class="ms-auto">
              <ul class="list-unstyled mb-0">
                <li class="list-inline-item text-primary">
                  <span class="round-8 text-bg-primary rounded-circle me-1 d-inline-block"></span>
                  Current Month
                </li>
                <li class="list-inline-item text-info">
                  <span class="round-8 text-bg-info rounded-circle me-1 d-inline-block"></span>
                  Last Month
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
              <span class="text-muted fs-3">$45,890</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-success-subtle text-success">+68%</span>
            </div>
          </div>

          <div class="py-3 d-flex align-items-center">
            <span class="btn btn-warning rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-star fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">Best Product</h5>
              <span class="text-muted fs-3">Product A</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-success-subtle text-success">+42%</span>
            </div>
          </div>

          <div class="py-3 d-flex align-items-center">
            <span class="btn btn-success rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-message-dots fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">Reviews</h5>
              <span class="text-muted fs-3">1,245 Reviews</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-success-subtle text-success">+28%</span>
            </div>
          </div>

          <div class="pt-3 mb-7 d-flex align-items-center">
            <span class="btn btn-info rounded-circle round-48 hstack justify-content-center">
              <i class="ti ti-users fs-6"></i>
            </span>
            <div class="ms-3">
              <h5 class="mb-0 fw-bolder fs-4">New Users</h5>
              <span class="text-muted fs-3">342 Users</span>
            </div>
            <div class="ms-auto">
              <span class="badge bg-success-subtle text-success">+15%</span>
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
              <select class="form-select theme-select border-0" aria-label="Period">
                <option value="1">November 2025</option>
                <option value="2">October 2025</option>
                <option value="3">September 2025</option>
              </select>
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
                <tr>
                  <td class="px-0">
                    <div class="d-flex align-items-center">
                      <img src="{{ asset('admin/assets/images/profile/user-3.jpg') }}" class="rounded-circle" width="40"
                        alt="user" />
                      <div class="ms-3">
                        <h6 class="mb-0 fw-bolder">John Doe</h6>
                        <span class="text-muted">john@email.com</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-0">Premium Package</td>
                  <td class="px-0">
                    <span class="badge bg-success">Completed</span>
                  </td>
                  <td class="px-0 text-dark fw-medium text-end">Rp 3.900.000</td>
                </tr>
                <tr>
                  <td class="px-0">
                    <div class="d-flex align-items-center">
                      <img src="{{ asset('admin/assets/images/profile/user-5.jpg') }}" class="rounded-circle" width="40"
                        alt="user" />
                      <div class="ms-3">
                        <h6 class="mb-0 fw-bolder">Jane Smith</h6>
                        <span class="text-muted">jane@email.com</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-0">Basic Package</td>
                  <td class="px-0">
                    <span class="badge bg-warning">Pending</span>
                  </td>
                  <td class="px-0 text-dark fw-medium text-end">Rp 1.500.000</td>
                </tr>
                <tr>
                  <td class="px-0">
                    <div class="d-flex align-items-center">
                      <img src="{{ asset('admin/assets/images/profile/user-6.jpg') }}" class="rounded-circle" width="40"
                        alt="user" />
                      <div class="ms-3">
                        <h6 class="mb-0 fw-bolder">Mike Johnson</h6>
                        <span class="text-muted">mike@email.com</span>
                      </div>
                    </div>
                  </td>
                  <td class="px-0">Enterprise Package</td>
                  <td class="px-0">
                    <span class="badge bg-success">Completed</span>
                  </td>
                  <td class="px-0 text-dark fw-medium text-end">Rp 12.800.000</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('css')

@endpush
@push('js')

@endpush