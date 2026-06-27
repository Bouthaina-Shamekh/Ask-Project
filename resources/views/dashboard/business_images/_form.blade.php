<div class="row">

    <div class="form-group col-6 mb-3">

        <label>Business</label>

        <select name="business_id" class="form-control">

            <option value="">Select Business</option>

            @foreach($businesses as $business)

                <option value="{{ $business->id }}"
                    {{ old('business_id', $businessImages->business_id) == $business->id ? 'selected' : '' }}>

                    {{ $business->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <label>Image</label>

        <input
            type="file"
            name="image"
            class="form-control"
        >

        <span class="text-muted">
            Recommended Size: 1080 × 1080
        </span>

        @if($businessImages->image)

            <img
                src="{{ asset('storage/'.$businessImages->image) }}"
                alt="Current Image"
                height="60"
                class="mt-2 rounded">

        @endif

    </div>

    <div class="form-group col-8 mb-3">

        <x-form.input
            name="alt"
            label="Alt Text"
            type="text"
            placeholder="Enter image alt text"
            :value="$businessImages->alt"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="sort_order"
            label="Sort Order"
            type="number"
            placeholder="0"
            :value="$businessImages->sort_order"
        />

    </div>

</div>