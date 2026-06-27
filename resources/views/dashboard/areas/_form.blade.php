<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="name"
            label="Name"
            :re="true"
            type="text"
            placeholder="Enter area name"
            required
            :value="$areas->name"
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
            :value="$areas->slug"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <label>Status</label>

        <select name="status" class="form-control">

            <option value="active"
                @selected(old('status',$areas->status) == 'active')>
                Active
            </option>

            <option value="inactive"
                @selected(old('status',$areas->status) == 'inactive')>
                Inactive
            </option>

        </select>

    </div>

</div>