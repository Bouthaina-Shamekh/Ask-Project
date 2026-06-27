<thead>

<tr>

    <th>#</th>

    <th>Name</th>

    <th>Slug</th>

    <th>Status</th>

    <th>Actions</th>

</tr>

</thead>

<tbody>

@foreach($areas as $area)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $area->name }}</td>

    <td>{{ $area->slug }}</td>

    <td>

        @if($area->status == 'active')
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif

    </td>

    <td>

        <a href="{{ route('dashboard.area.edit',$area->id) }}"
            class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">

            <i class="ti ti-edit text-xl leading-none"></i>

        </a>

        <form action="{{ route('dashboard.area.destroy',$area->id) }}"
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