<div class="row">

    <div class="form-group col-6 mb-3">

        <label>Business</label>

        <select name="business_id" class="form-control">

            <option value="">Select Business</option>

            @foreach($businesses as $business)

                <option value="{{ $business->id }}"
                    {{ old('business_id', $businessServices->business_id) == $business->id ? 'selected' : '' }}>

                    {{ $business->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <x-form.input
            name="name"
            label="Service Name"
            :re="true"
            type="text"
            placeholder="Enter service name"
            required
            :value="$businessServices->name"
        />

    </div>

    <div class="form-group col-12 mb-3">

        <label>Description</label>

        <textarea
            name="description"
            rows="4"
            class="form-control"
            placeholder="Enter service description">{{ old('description', $businessServices->description) }}</textarea>

    </div>

    <div class="form-group col-6 mb-3">

        <x-form.input
            name="price"
            label="Price"
            type="number"
            step="0.01"
            placeholder="0.00"
            :value="$businessServices->price"
        />

    </div>

    <div class="form-group col-6 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="active"
                {{ old('status', $businessServices->status) == 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="inactive"
                {{ old('status', $businessServices->status) == 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

</div>