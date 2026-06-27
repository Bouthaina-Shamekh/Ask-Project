<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Subscriptions
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <div class="row">
                    <h5>Subscriptions</h5>
                </div>

                <div>
                    <a href="{{ route('dashboard.subscription.create') }}"
                       class="btn btn-primary">
                        Add Subscription
                    </a>
                </div>

            </div>

            <div class="card-body">

                <div class="dt-responsive table-responsive">

                    <table id="footer-search"
                           class="table table-striped table-bordered nowrap">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Business</th>

                                <th>Plan</th>

                                <th>Starts At</th>

                                <th>Ends At</th>

                                <th>Amount Paid</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($subscriptions as $subscription)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $subscription->business?->name }}
                                    </td>

                                    <td>
                                        {{ $subscription->plan?->name }}
                                    </td>

                                    <td>
                                        {{ $subscription->starts_at ?? '--' }}
                                    </td>

                                    <td>
                                        {{ $subscription->ends_at ?? '--' }}
                                    </td>

                                    <td>

                                        @if($subscription->amount_paid)

                                            {{ number_format($subscription->amount_paid,2) }}

                                        @else

                                            --

                                        @endif

                                    </td>

                                    <td>

                                        @switch($subscription->status)

                                            @case('active')

                                                <span class="badge bg-success">
                                                    Active
                                                </span>

                                            @break

                                            @case('pending')

                                                <span class="badge bg-warning">
                                                    Pending
                                                </span>

                                            @break

                                            @case('expired')

                                                <span class="badge bg-danger">
                                                    Expired
                                                </span>

                                            @break

                                            @case('cancelled')

                                                <span class="badge bg-secondary">
                                                    Cancelled
                                                </span>

                                            @break

                                        @endswitch

                                    </td>

                                    <td>

                                        <a href="{{ route('dashboard.subscription.edit',$subscription->id) }}"
                                           class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                            <i class="ti ti-edit text-xl leading-none"></i>

                                        </a>

                                        <form action="{{ route('dashboard.subscription.destroy',$subscription->id) }}"
                                              method="POST"
                                              class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary delete-form">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit">

                                                <i class="ti ti-trash text-xl leading-none"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')

        <script src="{{ asset('assets-dashboard/js/plugins/dataTables.min.js') }}"></script>
        <script src="{{ asset('assets-dashboard/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

        <script>

            $('#footer-search').DataTable();

        </script>

        <script>

            document.querySelectorAll('.delete-form').forEach(form => {

                form.addEventListener('submit', function (e) {

                    if (!confirm('Are you sure you want to delete this item?')) {

                        e.preventDefault();

                    }

                });

            });

        </script>

    @endpush

</x-dashboard-layout>