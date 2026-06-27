<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Business Working Hours
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <div class="row">
                    <h5>Business Working Hours</h5>
                </div>

                <div>
                    <a href="{{ route('dashboard.business-working-hour.create') }}"
                       class="btn btn-primary">
                        Add Business Working Hour
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

                                <th>Day</th>

                                <th>Opens At</th>

                                <th>Closes At</th>

                                <th>Closed</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($businessWorkingHours as $businessWorkingHour)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $businessWorkingHour->business?->name }}
                                    </td>

                                    <td>

                                        @switch($businessWorkingHour->day_of_week)

                                            @case(0)
                                                Sunday
                                            @break

                                            @case(1)
                                                Monday
                                            @break

                                            @case(2)
                                                Tuesday
                                            @break

                                            @case(3)
                                                Wednesday
                                            @break

                                            @case(4)
                                                Thursday
                                            @break

                                            @case(5)
                                                Friday
                                            @break

                                            @case(6)
                                                Saturday
                                            @break

                                        @endswitch

                                    </td>

                                    <td>

                                        {{ $businessWorkingHour->opens_at ?? '--' }}

                                    </td>

                                    <td>

                                        {{ $businessWorkingHour->closes_at ?? '--' }}

                                    </td>

                                    <td>

                                        @if($businessWorkingHour->is_closed)

                                            <span class="badge bg-danger">
                                                Yes
                                            </span>

                                        @else

                                            <span class="badge bg-success">
                                                No
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('dashboard.business-working-hour.edit',$businessWorkingHour->id) }}"
                                           class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                            <i class="ti ti-edit text-xl leading-none"></i>

                                        </a>

                                        <form action="{{ route('dashboard.business-working-hour.destroy',$businessWorkingHour->id) }}"
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