<x-dashboard-layout>

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.area.index') }}">Areas</a>
        </li>

        <li class="breadcrumb-item">
            Add Area
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Add Area</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.area.store') }}"
                          method="POST">

                        @csrf

                        @include('dashboard.areas._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.area.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button class="btn btn-primary">
                                {{ $btn_label ?? 'Add' }}
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-dashboard-layout>