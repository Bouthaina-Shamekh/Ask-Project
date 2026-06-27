<div class="row">

    <div class="form-group col-6 mb-3">

        <x-form.input
            name="name"
            label="Plan Name"
            :re="true"
            type="text"
            placeholder="Enter plan name"
            required
            :value="$plans->name"
        />

    </div>

    <div class="form-group col-6 mb-3">

        <x-form.input
            name="slug"
            label="Slug"
            :re="true"
            type="text"
            placeholder="Enter slug"
            required
            :value="$plans->slug"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="price"
            label="Price"
            :re="true"
            type="number"
            step="0.01"
            placeholder="0.00"
            required
            :value="$plans->price"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="duration_days"
            label="Duration (Days)"
            :re="true"
            type="number"
            placeholder="30"
            required
            :value="$plans->duration_days"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="active"
                {{ old('status', $plans->status) == 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="inactive"
                {{ old('status', $plans->status) == 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="businesses_limit"
            label="Businesses Limit"
            type="number"
            placeholder="Unlimited"
            :value="$plans->businesses_limit"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="jobs_limit"
            label="Jobs Limit"
            type="number"
            placeholder="Unlimited"
            :value="$plans->jobs_limit"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="images_limit"
            label="Images Limit"
            type="number"
            placeholder="Unlimited"
            :value="$plans->images_limit"
        />

    </div>

    <div class="form-group col-12 mb-3">

        <label>

            <input
                type="checkbox"
                name="can_feature_business"
                value="1"
                {{ old('can_feature_business', $plans->can_feature_business) ? 'checked' : '' }}>

            Can Feature Business

        </label>

    </div>

</div>