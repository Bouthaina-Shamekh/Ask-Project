<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/media.css') }}">
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.category.index') }}">Categories</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Add Category
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Add Category</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.category.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        @include('dashboard.categories._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.category.index') }}"
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