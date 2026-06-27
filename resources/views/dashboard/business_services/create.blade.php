<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/media.css') }}">
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.business-service.index') }}">Business Services</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Add Business Service
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Add Business Service</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.business-service.store') }}"
                          method="POST">

                        @csrf

                        @include('dashboard.business_services._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.business-service.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                {{ $btn_label ?? 'Add' }}
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-dashboard-layout>