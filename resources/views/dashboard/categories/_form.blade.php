<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="name"
            label="Name"
            :re="true"
            type="text"
            placeholder="Enter category name"
            required
            :value="$categories->name"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="slug"
            label="Slug"
            :re="true"
            type="text"
            placeholder="Enter category slug"
            required
            :value="$categories->slug"
        />
    </div>

    <div class="form-group col-12 mb-3">
        <label>Description</label>

        <textarea
            name="description"
            rows="4"
            class="form-control"
            placeholder="Enter category description">{{ old('description', $categories->description) }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label>Image</label>

        <input
            type="file"
            name="image"
            class="form-control"
        >

        <span class="text-muted">
            Size Image : 1080 × 1080
        </span>

        @if($categories->image)
            <img
                src="{{ asset('storage/'.$categories->image) }}"
                height="60"
                class="mt-2"
            >
        @endif
    </div>

    <div class="form-group col-3 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="active"
                {{ old('status',$categories->status) == 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="inactive"
                {{ old('status',$categories->status) == 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

    <div class="form-group col-3 mb-3">
        <x-form.input
            name="sort_order"
            label="Sort Order"
            type="number"
            placeholder="0"
            :value="$categories->sort_order"
        />
    </div>

</div>