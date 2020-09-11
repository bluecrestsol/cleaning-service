<div class="kt-portlet__body">
    <div class="kt-section kt-section--first kt-section--last">
        <collection
            variables='<?php echo json_encode([
                "old" => getOr(session()->getOldInput()),
                "contract" => $contract ?? null,
                "error" => $errors->messages()
            ]); ?>'>
        </collection>
        <div class="kt-section__body">
            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.contracts_customer_code') }}</label> <i class="fa fa-spinner fa-spin" v-if="customer.code.loading" style="margin-left: 5px;"></i>
                <v-input
                    name="customer[code]"
                    initial="{{ old('customer.code', $contract->customer->code ?? '') }}"
                    v-model="customer.code.value"
                    initial-error="{{ $errors->first('customer.code') }}"
                    :error.sync="customer.code.error"
                    v-on:blur="onBlur"
                    v-on:keyup="onKeyup"
                ></v-input>
            </div>
        </div>
        <div v-if="customer.id">
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.contracts.partials.sections.crud.customer')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            <div class="kt-section__body">
                <div class="form-group">
                    <label>{{ __('staff/forms.contracts_place') }} </label> <i class="fa fa-spinner fa-spin" v-if="place.loading" style="margin-left: 5px;"></i>
                    <select2
                        name="place_id"
                        v-model="place.value"
                        :options.sync="place.options"
                        placeholder="{{ __('staff/forms.contracts_select_place') }}"
                        :error.sync="place.error"
                        @change="onPlaceChanged"
                    ></select2>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.contracts_frequency') }}</label>
                    <div class="group-control" :class="{'is-invalid': frequency.error }">
                        <select name="frequency" class="form-control kt-selectpicker"
                            :class="{'is-invalid': frequency.error }"
                            v-model="frequency.value">
                            <option value="">{{ __('staff/forms.contracts_select_frequency') }}</option>
                            @foreach(['daily', 'twice_a_week', 'weekly', 'biweekly', 'monthly'] as $frequency)
                                <option value="{{ $frequency }}">{{ __('staff/forms.contracts_frequency_'.$frequency) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback" v-if="frequency.error">@{{ frequency.error }}</div>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.contracts_price_unit') }}</label>
                    <div class="group-control" :class="{'is-invalid': priceUnit.error }">
                        <select name="price_unit" class="form-control kt-selectpicker"
                            :class="{'is-invalid': priceUnit.error }"
                            v-model="priceUnit.value">
                            <option value="">{{ __('staff/forms.contracts_select_price_unit') }}</option>
                            @foreach(['appointment', 'week', 'month'] as $price_unit)
                                <option value="{{ $price_unit }}">{{ __('staff/forms.contracts_price_unit_'.$price_unit) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback" v-if="priceUnit.error">@{{ priceUnit.error }}</div>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.contracts_price') }}</label>
                    <v-input
                        name="price"
                        v-model="price.value"
                        :error.sync="price.error"
                    ></v-input>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.contracts_starts_at') }}</label>
                    <datepicker
                        name="started_at"
                        v-model="startsAt.value"
                        :config= "startsAt.config"
                        :error.sync="startsAt.error"
                    ></datepicker>
                </div>

                <div class="form-group form-group-last">
                    <label>{{ __('staff/forms.contracts_ends_at') }}</label>
                    <datepicker
                        name="ended_at"
                        v-model="endsAt.value"
                        :config= "endsAt.config"
                        :error.sync="endsAt.error"
                    ></datepicker>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.contracts.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>