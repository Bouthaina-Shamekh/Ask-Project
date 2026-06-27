<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/media.css') }}">
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.business-working-hour.index') }}">
                Business Working Hours
            </a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Edit Business Working Hour
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Edit Business Working Hour</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.business-working-hour.update', $businessWorkingHours->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        @include('dashboard.business_working_hours._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.business-working-hour.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-dashboard-layout>