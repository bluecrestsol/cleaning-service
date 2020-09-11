<div class="kt-section__body">
    <input type="hidden" name="customer_id" v-model="customer.id">
    <div class="form-group">
        <label>{{ __('staff/forms.contracts_customer_title') }}</label>
        <br>
        @{{ $t(`staff/forms.contracts_customer_title_${customer.title}`) }} 
    </div>
    <div class="form-group">
        <label>{{ __('staff/forms.contracts_customer_first_name') }}</label>
        <br>
        @{{ customer.first_name }} 
    </div>
    <div class="form-group">
        <label>{{ __('staff/forms.contracts_customer_last_name') }}</label>
        <br>
        @{{ customer.last_name }} 
    </div>
    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.contracts_customer_business_name') }}</label>
        <br>
        @{{ customer.business_name }} 
    </div>
</div>