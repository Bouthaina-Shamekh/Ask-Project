<div class="row">

    <div class="form-group col-4 mb-3">
        <label>Owner</label>

        <select name="owner_id" class="form-control">

            <option value="">Select Owner</option>

            @foreach($owners as $owner)

                <option value="{{ $owner->id }}"
                    {{ old('owner_id', $businesses->owner_id) == $owner->id ? 'selected' : '' }}>
                    {{ $owner->name }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-4 mb-3">
        <label>Category</label>

        <select name="category_id" class="form-control">

            <option value="">Select Category</option>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('category_id', $businesses->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-4 mb-3">
        <label>Area</label>

        <select name="area_id" class="form-control">

            <option value="">Select Area</option>

            @foreach($areas as $area)

                <option value="{{ $area->id }}"
                    {{ old('area_id', $businesses->area_id) == $area->id ? 'selected' : '' }}>
                    {{ $area->name }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="name"
            label="Business Name"
            :re="true"
            type="text"
            placeholder="Enter business name"
            required
            :value="$businesses->name"
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
            :value="$businesses->slug"
        />
    </div>

    <div class="form-group col-12 mb-3">

        <label>Description</label>

        <textarea
            name="description"
            rows="5"
            class="form-control"
            placeholder="Business description">{{ old('description',$businesses->description) }}</textarea>

    </div>

    <div class="form-group col-4 mb-3">
        <x-form.input
            name="phone"
            label="Phone"
            type="text"
            :value="$businesses->phone"
        />
    </div>

    <div class="form-group col-4 mb-3">
        <x-form.input
            name="whatsapp"
            label="WhatsApp"
            type="text"
            :value="$businesses->whatsapp"
        />
    </div>

    <div class="form-group col-4 mb-3">
        <x-form.input
            name="email"
            label="Email"
            type="email"
            :value="$businesses->email"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="website"
            label="Website"
            type="text"
            :value="$businesses->website"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="address"
            label="Address"
            type="text"
            :value="$businesses->address"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="latitude"
            label="Latitude"
            type="text"
            :value="$businesses->latitude"
        />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input
            name="longitude"
            label="Longitude"
            type="text"
            :value="$businesses->longitude"
        />
    </div>

    <div class="form-group col-6 mb-3">

        <label>Logo</label>

        <input type="file"
               name="logo"
               class="form-control">

        @if($businesses->logo)

            <img src="{{ asset('storage/'.$businesses->logo) }}"
                 height="60"
                 class="mt-2">

        @endif

    </div>

    <div class="form-group col-6 mb-3">

        <label>Cover</label>

        <input type="file"
               name="cover"
               class="form-control">

        @if($businesses->cover)

            <img src="{{ asset('storage/'.$businesses->cover) }}"
                 height="60"
                 class="mt-2">

        @endif

    </div>

    <div class="form-group col-4 mb-3">

        <label>Price Level</label>

        <select name="price_level" class="form-control">

            <option value="">Select</option>

            <option value="low"
                {{ old('price_level',$businesses->price_level) == 'low' ? 'selected' : '' }}>
                Low
            </option>

            <option value="medium"
                {{ old('price_level',$businesses->price_level) == 'medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="high"
                {{ old('price_level',$businesses->price_level) == 'high' ? 'selected' : '' }}>
                High
            </option>

        </select>

    </div>

    <div class="form-group col-4 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="pending" {{ old('status',$businesses->status) == 'pending' ? 'selected' : '' }}>Pending</option>

            <option value="active" {{ old('status',$businesses->status) == 'active' ? 'selected' : '' }}>Active</option>

            <option value="rejected" {{ old('status',$businesses->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>

            <option value="suspended" {{ old('status',$businesses->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>

        </select>

    </div>

    <div class="form-group col-4 mb-3">

        <label>Rejection Reason</label>

        <textarea
            name="rejection_reason"
            rows="2"
            class="form-control">{{ old('rejection_reason',$businesses->rejection_reason) }}</textarea>

    </div>

    <div class="form-group col-3 mb-3">

        <label>

            <input type="checkbox"
                   name="is_open"
                   value="1"
                   {{ old('is_open',$businesses->is_open) ? 'checked' : '' }}>

            Open

        </label>

    </div>

    <div class="form-group col-3 mb-3">

        <label>

            <input type="checkbox"
                   name="has_delivery"
                   value="1"
                   {{ old('has_delivery',$businesses->has_delivery) ? 'checked' : '' }}>

            Delivery

        </label>

    </div>

    <div class="form-group col-3 mb-3">

        <label>

            <input type="checkbox"
                   name="family_friendly"
                   value="1"
                   {{ old('family_friendly',$businesses->family_friendly) ? 'checked' : '' }}>

            Family Friendly

        </label>

    </div>

    <div class="form-group col-3 mb-3">

        <label>

            <input type="checkbox"
                   name="is_featured"
                   value="1"
                   {{ old('is_featured',$businesses->is_featured) ? 'checked' : '' }}>

            Featured

        </label>

    </div>

</div>