<x-dashboard-layout>

    <x-slot:breadcrumbs>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.area.index') }}">Areas</a>
        </li>

        <li class="breadcrumb-item">
            Edit Area
        </li>

    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Edit Area</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.area.update',$areas->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        @include('dashboard.areas._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.area.index') }}"
                               class="btn btn-secondary">
                                Back
                            </a>

                            <button class="btn btn-primary">
                                Update
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-dashboard-layout>