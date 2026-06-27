<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/plugins/dataTables.bootstrap5.min.css') }}" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Business Images
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between">

                <div class="row">
                    <h5>Business Images</h5>
                </div>

                <div>
                    <a href="{{ route('dashboard.business-image.create') }}"
                        class="btn btn-primary">
                        Add Business Image
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

                                <th>Image</th>

                                <th>Business</th>

                                <th>Alt Text</th>

                                <th>Sort Order</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($businessImages as $businessImage)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        @if ($businessImage->image)

                                            <img src="{{ asset('storage/' . $businessImage->image) }}"
                                                width="60"
                                                height="60"
                                                class="rounded">

                                        @else

                                            --

                                        @endif

                                    </td>

                                    <td>

                                        {{ $businessImage->business?->name }}

                                    </td>

                                    <td>

                                        {{ $businessImage->alt ?: '--' }}

                                    </td>

                                    <td>

                                        {{ $businessImage->sort_order }}

                                    </td>

                                    <td>

                                        <a href="{{ route('dashboard.business-image.edit', $businessImage->id) }}"
                                            class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

                                            <i class="ti ti-edit text-xl leading-none"></i>

                                        </a>

                                        <form action="{{ route('dashboard.business-image.destroy', $businessImage->id) }}"
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