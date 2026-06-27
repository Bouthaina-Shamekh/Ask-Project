<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Plans
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <div class="row">
                    <h5>Plans</h5>
                </div>

                <div>
                    <a href="{{ route('dashboard.plan.create') }}"
                       class="btn btn-primary">
                        Add Plan
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

                                <th>Name</th>

                                <th>Price</th>

                                <th>Duration</th>

                                <th>Businesses</th>

                                <th>Jobs</th>

                                <th>Images</th>

                                <th>Featured</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($plans as $plan)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        {{ $plan->name }}

                                    </td>

                                    <td>

                                        {{ number_format($plan->price,2) }}

                                    </td>

                                    <td>

                                        {{ $plan->duration_days }} Days

                                    </td>

                                    <td>

                                        {{ $plan->businesses_limit ?? 'Unlimited' }}

                                    </td>

                                    <td>

                                        {{ $plan->jobs_limit ?? 'Unlimited' }}

                                    </td>

                                    <td>

                                        {{ $plan->images_limit ?? 'Unlimited' }}

                                    </td>

                                    <td>

                                        @if($plan->can_feature_business)

                                            <span class="badge bg-primary">

                                                Yes

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                No

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        @if($plan->status == 'active')

                                            <span class="badge bg-success">

                                                Active

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('dashboard.plan.edit',$plan->id) }}"
                                           class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                            <i class="ti ti-edit text-xl leading-none"></i>

                                        </a>

                                        <form action="{{ route('dashboard.plan.destroy',$plan->id) }}"
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