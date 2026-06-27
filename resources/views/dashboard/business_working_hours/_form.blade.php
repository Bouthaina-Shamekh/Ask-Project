<div class="row">

    <div class="form-group col-6 mb-3">

        <label>Business</label>

        <select name="business_id" class="form-control">

            <option value="">Select Business</option>

            @foreach($businesses as $business)

                <option value="{{ $business->id }}"
                    {{ old('business_id', $businessWorkingHours->business_id) == $business->id ? 'selected' : '' }}>

                    {{ $business->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <label>Day</label>

        <select name="day_of_week" class="form-control">

            <option value="0" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 0 ? 'selected' : '' }}>
                Sunday
            </option>

            <option value="1" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 1 ? 'selected' : '' }}>
                Monday
            </option>

            <option value="2" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 2 ? 'selected' : '' }}>
                Tuesday
            </option>

            <option value="3" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 3 ? 'selected' : '' }}>
                Wednesday
            </option>

            <option value="4" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 4 ? 'selected' : '' }}>
                Thursday
            </option>

            <option value="5" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 5 ? 'selected' : '' }}>
                Friday
            </option>

            <option value="6" {{ old('day_of_week', $businessWorkingHours->day_of_week) == 6 ? 'selected' : '' }}>
                Saturday
            </option>

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <label>Opens At</label>

        <input
            type="time"
            name="opens_at"
            class="form-control"
            value="{{ old('opens_at', $businessWorkingHours->opens_at) }}">

    </div>

    <div class="form-group col-6 mb-3">

        <label>Closes At</label>

        <input
            type="time"
            name="closes_at"
            class="form-control"
            value="{{ old('closes_at', $businessWorkingHours->closes_at) }}">

    </div>

    <div class="form-group col-12 mb-3">

        <label>

            <input
                type="checkbox"
                name="is_closed"
                value="1"
                {{ old('is_closed', $businessWorkingHours->is_closed) ? 'checked' : '' }}>

            Closed All Day

        </label>

    </div>

</div>