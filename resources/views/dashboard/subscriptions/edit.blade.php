<x-dashboard-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/media.css') }}">
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.home') }}">Home</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.subscription.index') }}">Subscriptions</a>
        </li>

        <li class="breadcrumb-item" aria-current="page">
            Edit Subscription
        </li>
    </x-slot:breadcrumbs>

    <div class="col-span-12 xl:col-span-12">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <h5>Edit Subscription</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('dashboard.subscription.update', $subscriptions->id) }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        @include('dashboard.subscriptions._form')

                        <div class="col-span-12 text-left">

                            <a href="{{ route('dashboard.subscription.index') }}"
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