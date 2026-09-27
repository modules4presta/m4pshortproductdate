{**
 * m4pshortproductdate
 *
 * @author    Modules4Presta <contact@modules4presta.io>
 * @copyright 2026 Nice Code sp. z o.o. (Modules4Presta)
 * @license   https://opensource.org/licenses/MIT MIT License
 *}

<div>
    <div class="alert alert-info">
        {l s='Please note that this option requires you to create a combination from the product.' d='Modules.M4pshortproductdate.Admin'}
    </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label" for="active_lower_date">
            {l s='Active lower date' d='Modules.M4pshortproductdate.Admin'}
        </label>
        <div class="col-sm-9">
            <div class="switch">
                <input type="radio" name="m4pshortproductdate_active" id="active_lower_date_on" value="1" {if !empty($data.active)}checked{/if}>
                <label for="active_lower_date_on">{l s='Yes' d='Modules.M4pshortproductdate.Admin'}</label>

                <input type="radio" name="m4pshortproductdate_active" id="active_lower_date_off" value="0" {if empty($data.active)}checked{/if}>
                <label for="active_lower_date_off">{l s='No' d='Modules.M4pshortproductdate.Admin'}</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label" for="expired_date">
            {l s='Date' d='Modules.M4pshortproductdate.Admin'}
        </label>
        <div class="col-sm-9">
            <input type="date" name="m4pshortproductdate_expired_date" id="expired_date" class="form-control" value="{if !empty($data.date)}{$data.date}{/if}">
            <small>{l s='Enter date to which product have expired.' d='Modules.M4pshortproductdate.Admin'}</small>
        </div>
    </div>
</div>