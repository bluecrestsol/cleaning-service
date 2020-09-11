<div class="kt-portlet__body">
    {{-- data to be send to javascript --}}
    <collection
        variables='<?php echo json_encode([
            "place" => [
                "use_customer" => old("billing_details") ? "0" : (isset($place) ? (isset($place->billing_details) ? "0" : "1") : "1")
            ]
        ]); ?>'>
    </collection>
    <div class="kt-section kt-section--first">
        <div class="kt-section__body">
            @if (isset($place))
                {{-- code field --}}
                <div class="form-group">
                    <label>{{ __('staff/forms.places_code') }} *</label>
                    <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}" name="code" value="{{ old('code', $place->code ?? '') }}">
                    {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            @endif

            {{-- financial type field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_financial_type') }} *</label>
                <div class="group-control {{ $errors->has('financial_type') ? 'is-invalid' : ''}}">
                    <select name="financial_type" class="form-control kt-selectpicker {{ $errors->has('financial_type') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.places_select_financial_type') }}</option>
                        @foreach(['free', 'billed'] as $financial_type)
                            <option value="{{ $financial_type }}"
                                {{ old('financial_type', $place->financial_type ?? '') == $financial_type ? 'selected' : '' }}>{{ __('staff/forms.places_financial_type_'.$financial_type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('financial_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- agent field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_agent') }} *</label><i class="fa fa-spinner fa-spin" v-if="agent.loading" style="margin-left: 5px;"></i>
                <select2
                    name="agent_id"
                    initial="{{ old('agent_id', $place->agent_id ?? '') }}"
                    v-model="agent.value"
                    :options.sync="agent.options"
                    placeholder="{{ __('staff/forms.places_select_agent') }}"
                    error="{{ $errors->first('agent_id') }}"
                ></select2>
            </div>

            {{-- customer field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_customer') }} *</label> <i class="fa fa-spinner fa-spin" v-if="customer.loading" style="margin-left: 5px;"></i>
                <select2
                    name="customer_id"
                    initial="{{ old('customer_id', $place->customer_id ?? '') }}"
                    v-model="customer.value"
                    :options.sync="customer.options"
                    placeholder="{{ __('staff/forms.places_select_customer') }}"
                    error="{{ $errors->first('customer_id') }}"
                ></select2>
            </div>

            {{-- name field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_name') }} *</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $place->name ?? '') }}">
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- type field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_type') }} *</label>
                <div class="group-control {{ $errors->has('type') ? 'is-invalid' : ''}}">
                    <select name="type" class="form-control kt-selectpicker {{ $errors->has('type') ? 'is-invalid' : ''}}" id="type">
                        <option value="">{{ __('staff/forms.places_select_type') }}</option>
                        @foreach(['residential', 'commercial', 'public'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $place->type ?? '') == $type ? 'selected' : '' }}>{{ __('staff/forms.places_type_'.$type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.places_category') }} *</label> <i class="fa fa-spinner fa-spin" v-if="category.loading" style="margin-left: 5px;"></i>
                <select2
                    name="places_category_id"
                    initial="{{ old('places_category_id', $place->places_category_id ?? '') }}"
                    v-model="category.value"
                    :options.sync="category.options"
                    placeholder="{{ __('staff/forms.places_select_category') }}"
                    error="{{ $errors->first('places_category_id') }}"
                ></select2>
            </div>

            {{-- status field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_status') }} *</label>
                <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
                    <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.places_select_status') }}</option>
                        @foreach(['enabled', 'disabled'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $place->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.places_status_'.$status) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- area field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_area') }} {{ isset($country->area_unit) ? "({$country->area_unit})" : '' }}</label>
                <input type="text" class="form-control {{ $errors->has('area') ? 'is-invalid' : ''}}" name="area" value="{{ old('area', $place->area ?? '') }}">
                {!! $errors->first('area', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- state field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_state') }} *</label> <i class="fa fa-spinner fa-spin" v-if="state.loading" style="margin-left: 5px;"></i>
                <select2
                    name="state_id"
                    initial="{{ old('state_id', $place->state_id ?? '') }}"
                    v-model="state.value"
                    :options.sync="state.options"
                    placeholder="{{ __('staff/forms.places_select_state') }}"
                    error="{{ $errors->first('state_id') }}"
                ></select2>
            </div>

            {{-- city field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_city') }} *</label> <i class="fa fa-spinner fa-spin" v-if="city.loading" style="margin-left: 5px;"></i>
                <select2
                    name="city_id"
                    initial="{{ old('city_id', $place->city_id ?? '') }}"
                    v-model="city.value"
                    :options.sync="city.options"
                    placeholder="{{ __('staff/forms.places_select_city') }}"
                    error="{{ $errors->first('city_id') }}"
                ></select2>
            </div>

            {{-- district field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_district') }} *</label> <i class="fa fa-spinner fa-spin" v-if="district.loading" style="margin-left: 5px;"></i>
                <select2
                    name="district_id"
                    initial="{{ old('district_id', $place->district_id ?? '') }}"
                    v-model="district.value"
                    :options.sync="district.options"
                    placeholder="{{ __('staff/forms.places_select_district') }}"
                    error="{{ $errors->first('district_id') }}"
                ></select2>
            </div>

            {{-- is listing public field --}}
            <div class="form-group">
                <label>{{__('staff/forms.places_public_listing')}}</label>
                <v-switch
                    name="is_listing_public"
                    initial="{{ old('is_listing_public', $place->is_listing_public ?? '') }}"
                    :options="publicListing.options"
                    v-model="publicListing.value"
                ></v-switch>
            </div>

            {{-- is history public field --}}
            <div class="form-group">
                <label>{{__('staff/forms.places_public_history')}}</label>
                <v-switch
                    name="is_history_public"
                    initial="{{ old('is_history_public', $place->is_history_public ?? '') }}"
                    :options="publicHistory.options"
                    v-model="publicHistory.value"
                ></v-switch>
            </div>

            {{-- is gallery public field --}}
            <div class="form-group form-group-last">
                <label>{{__('staff/forms.places_public_photos')}}</label>
                <v-switch
                    name="is_gallery_public"
                    initial="{{ old('is_gallery_public', $place->is_gallery_public ?? '') }}"
                    :options="publicPhotos.options"
                    v-model="publicPhotos.value"
                ></v-switch>
            </div>
        </div>
    </div>

    {{-- address related fields section --}}
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.places.partials.sections.crud.address')

    {{-- billing details related fields section --}}
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.places.partials.sections.crud.billing-details')

</div>

{{-- form footer --}}
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.places.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>