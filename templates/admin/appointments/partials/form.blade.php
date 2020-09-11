<div class="kt-portlet__body">
    <div class="kt-section kt-section--first kt-section--last">
        <collection
            variables='<?php echo json_encode([
                "old" => getOr(session()->getOldInput()),
                "appointment" => $appointment ?? null,
                "error" => $errors->messages()
            ]); ?>'>
        </collection>
        <div class="kt-section__body">
            <div class="form-group">
                <label>{{ __('staff/forms.appointments_status') }}</label>
                <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
                    <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.appointments_select_status') }}</option>
                        @foreach(['booked', 'cancelled_by_customer', 'cancelled_by_company', 'completed'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $appointment->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.appointments_status_'.$status) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.appointments_customer_code') }}</label> <i class="fa fa-spinner fa-spin" v-if="customer.code.loading" style="margin-left: 5px;"></i>
                <v-input
                    name="customer[code]"
                    initial="{{ old('customer.code', $appointment->customer->code ?? '') }}"
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
            @include ('admin.appointments.partials.sections.crud.customer')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            <div class="kt-section__body">
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_place') }} </label> <i class="fa fa-spinner fa-spin" v-if="place.loading" style="margin-left: 5px;"></i>
                    <select2
                        name="place_id"
                        v-model="place.value"
                        :options.sync="place.options"
                        placeholder="{{ __('staff/forms.appointments_select_place') }}"
                        :error.sync="place.error"
                        @change="onPlaceChanged"
                    ></select2>
                </div>
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_contract') }} </label> <i class="fa fa-spinner fa-spin" v-if="contract.loading" style="margin-left: 5px;"></i>
                    <select2
                        name="contract_id"
                        v-model="contract.value"
                        :options.sync="contract.options"
                        placeholder="{{ __('staff/forms.appointments_select_contract') }}"
                        :error.sync="contract.error"
                    ></select2>
                </div>
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_ordered_at') }}</label>
                    <datetimepicker
                        name="ordered_at"
                        v-model="orderedAt.value"
                        :error.sync="orderedAt.error"
                    ></datetimepicker>
                </div>
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_scheduled_at') }}</label>
                    <datetimepicker
                        name="scheduled_at"
                        v-model="scheduledAt.value"
                        :error.sync="scheduledAt.error"
                    ></datetimepicker>
                </div>
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_serviced_at') }}</label>
                    <datetimepicker
                        name="serviced_at"
                        v-model="servicedAt.value"
                        :error.sync="servicedAt.error"
                    ></datetimepicker>
                </div>
                <div class="form-group" v-if="place.value">
                    <label>{{ __('staff/forms.appointments_services') }}</label> <i class="fa fa-spinner fa-spin" v-if="service.loading" style="margin-left: 5px;"></i>
                    <div class="mt-2 pl-4 row">
                        <div v-for="(item, index) in service.list" class="col-sm-6 col-md-4">
                            <div class="d-flex flex-row">
                                <label class="__switch-flex-label mr-2">@{{ item.text }}</label>
                                <div>
                                    <v-switch
                                        :options="service.options"
                                        v-model="item.value"
                                    ></v-switch>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_crew_leader') }} </label> <i class="fa fa-spinner fa-spin" v-if="crew.loading" style="margin-left: 5px;"></i>
                    <select2
                        name="crew[leader]"
                        v-model="crew.leader.value"
                        :options.sync="crew.options"
                        placeholder="{{ __('staff/forms.appointments_select_crew_leader') }}"
                        :error.sync="crew.leader.error"
                    ></select2>
                </div>

                <div class="form-group" v-if="crew.leader.value">
                    <label>{{ __('staff/forms.appointments_crew_members') }}</label>
                    <div class="mt-2 pl-4 row">
                        <template v-for="(item, index) in crew.member.list">
                            <template v-if="crew.leader.value != item.id">
                                <div class="col-sm-6 col-md-4">
                                    <div class="d-flex flex-row">
                                        <label class="__switch-flex-label mr-2">@{{ item.text }}</label>
                                        <div>
                                            <v-switch
                                                :options="crew.member.options"
                                                v-model="item.value"
                                            ></v-switch>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_currency') }} </label>
                    <br>
                    {{ optional(head($main['countries'])[0]->currency)->name }}
                    <input type="hidden" name="currency_id" value="{{ optional(head($main['countries'])[0]->currency)->id }}">
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_price') }}</label>
                    <v-input
                        name="price"
                        v-model="price.value"
                        :error.sync="price.error"
                    ></v-input>
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_payment_terms') }}</label>
                    <div class="group-control" :class="{'is-invalid': payment.terms.error }">
                        <select name="payment_term" class="form-control kt-selectpicker"
                            :class="{'is-invalid': payment.terms.error }"
                            v-model="payment.terms.value"
                            ref="payment-terms">
                            <option value="">{{ __('staff/forms.appointments_select_payment_terms') }}</option>
                            @foreach(['prepaid', 'on_appointment', 'postpaid', 'not_applicable'] as $payment_term)
                                <option value="{{ $payment_term }}">{{ __('staff/forms.appointments_payment_terms_'.$payment_term) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback" v-if="payment.terms.error">@{{ payment.terms.error }}</div>
                </div>

                <div class="form-group" v-if="payment.terms.value == 'postpaid'">
                    <label>{{ __('staff/forms.appointments_payment_due_at') }}</label>
                    <datepicker
                        name="payment_due_at"
                        v-model="payment.dueAt.value"
                        :config= "payment.dueAt.config"
                        :error.sync="payment.dueAt.error"
                    ></datepicker>
                </div>

                <div class="form-group form-group-last">
                    <label>{{ __('staff/forms.appointments_payment_method') }} </label>
                    <div class="group-control" :class="{'is-invalid': payment.method.error }">
                        <select name="payment_method" class="form-control kt-selectpicker"
                            :class="{'is-invalid': payment.method.error }"
                            v-model="payment.method.value">
                            <option value="">{{ __('staff/forms.appointments_select_payment_method') }}</option>
                            @foreach(['cash', 'bank_transfer', 'card', 'not_applicable'] as $payment_method)
                                <option value="{{ $payment_method }}">{{ __('staff/forms.appointments_payment_method_'.$payment_method) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback" v-if="payment.method.error">@{{ payment.method.error }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.appointments.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>
