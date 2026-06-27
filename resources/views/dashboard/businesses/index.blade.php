<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Businesses
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <div class="row">
                    <h5>Businesses</h5>
                </div>

                <div>
                    <a href="{{ route('dashboard.business.create') }}"
                       class="btn btn-primary">
                        Add Business
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

                            <th>Logo</th>

                            <th>Name</th>

                            <th>Owner</th>

                            <th>Category</th>

                            <th>Area</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th>Featured</th>

                            <th>Actions</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($businesses as $business)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    @if($business->logo)

                                        <img src="{{ asset('storage/'.$business->logo) }}"
                                             width="55"
                                             height="55"
                                             class="rounded">

                                    @else

                                        --

                                    @endif

                                </td>

                                <td>

                                    {{ $business->name }}

                                </td>

                                <td>

                                    {{ $business->owner?->name }}

                                </td>

                                <td>

                                    {{ $business->category?->name }}

                                </td>

                                <td>

                                    {{ $business->area?->name }}

                                </td>

                                <td>

                                    {{ $business->phone }}

                                </td>

                                <td>

                                    @switch($business->status)

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

                                        @case('rejected')
                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>
                                        @break

                                        @case('suspended')
                                            <span class="badge bg-dark">
                                                Suspended
                                            </span>
                                        @break

                                    @endswitch

                                </td>

                                <td>

                                    @if($business->is_featured)

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

                                    <a href="{{ route('dashboard.business.edit',$business->id) }}"
                                       class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                        <i class="ti ti-edit text-xl leading-none"></i>

                                    </a>

                                    <form action="{{ route('dashboard.business.destroy',$business->id) }}"
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

                form.addEventListener('submit', function(e){

                    if(!confirm('Are you sure you want to delete this item?')){

                        e.preventDefault();

                    }

                });

            });

        </script>

    @endpush

</x-dashboard-layout>