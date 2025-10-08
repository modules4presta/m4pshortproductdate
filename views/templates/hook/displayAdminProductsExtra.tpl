<div>
    <div class="alert alert-info">
        {l s='Please note that this option requires you to create a combination from the product.' mod='m4pshortproductdate'}
    </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label" for="active_lower_date">
            {l s='Active lower date' mod='m4pshortproductdate'}
        </label>
        <div class="col-sm-9">
            <div class="switch">
                <input type="radio" name="m4pshortproductdate_active" id="active_lower_date_on" value="1" {if !empty($data.active)}checked{/if}>
                <label for="active_lower_date_on">Tak</label>

                <input type="radio" name="m4pshortproductdate_active" id="active_lower_date_off" value="0" {if empty($data.active)}checked{/if}>
                <label for="active_lower_date_off">Nie</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="expired_date">
            {l s='Date' mod='m4pshortproductdate'}
        </label>
        <div class="col-sm-9">
            <input type="date" name="m4pshortproductdate_expired_date" id="expired_date" class="form-control" value="{if !empty($data.date)}{$data.date}{/if}">
            <small>{l s='Enter date to which product have expired.' mod='m4pshortproductdate'}</small>
        </div>
    </div>
</div>