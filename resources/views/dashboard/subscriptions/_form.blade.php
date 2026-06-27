<div class="row">

    <div class="form-group col-6 mb-3">

        <label>Business</label>

        <select name="business_id" class="form-control">

            <option value="">Select Business</option>

            @foreach($businesses as $business)

                <option value="{{ $business->id }}"
                    {{ old('business_id', $subscriptions->business_id) == $business->id ? 'selected' : '' }}>

                    {{ $business->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <label>Plan</label>

        <select name="plan_id" class="form-control">

            <option value="">Select Plan</option>

            @foreach($plans as $plan)

                <option value="{{ $plan->id }}"
                    {{ old('plan_id', $subscriptions->plan_id) == $plan->id ? 'selected' : '' }}>

                    {{ $plan->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group col-6 mb-3">

        <label>Starts At</label>

        <input
            type="datetime-local"
            name="starts_at"
            class="form-control"
            value="{{ old('starts_at', $subscriptions->starts_at ? \Carbon\Carbon::parse($subscriptions->starts_at)->format('Y-m-d\TH:i') : '') }}">

    </div>

    <div class="form-group col-6 mb-3">

        <label>Ends At</label>

        <input
            type="datetime-local"
            name="ends_at"
            class="form-control"
            value="{{ old('ends_at', $subscriptions->ends_at ? \Carbon\Carbon::parse($subscriptions->ends_at)->format('Y-m-d\TH:i') : '') }}">

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="amount_paid"
            label="Amount Paid"
            type="number"
            step="0.01"
            placeholder="0.00"
            :value="$subscriptions->amount_paid"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="payment_method"
            label="Payment Method"
            type="text"
            placeholder="Cash, Visa..."
            :value="$subscriptions->payment_method"
        />

    </div>

    <div class="form-group col-4 mb-3">

        <x-form.input
            name="payment_reference"
            label="Payment Reference"
            type="text"
            placeholder="Reference Number"
            :value="$subscriptions->payment_reference"
        />

    </div>

    <div class="form-group col-6 mb-3">

        <label>Status</label>

        <select name="status" class="form-control">

            <option value="pending"
                {{ old('status', $subscriptions->status) == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="active"
                {{ old('status', $subscriptions->status) == 'active' ? 'selected' : '' }}>
                Active
            </option>

            <option value="expired"
                {{ old('status', $subscriptions->status) == 'expired' ? 'selected' : '' }}>
                Expired
            </option>

            <option value="cancelled"
                {{ old('status', $subscriptions->status) == 'cancelled' ? 'selected' : '' }}>
                Cancelled
            </option>

        </select>

    </div>

</div>