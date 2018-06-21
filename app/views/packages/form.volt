<div class="packages-csv">

    {{ form(url("/packages/export"), 'id':"form-export", 'role':'form') }}
    <div class="center scaffold">

        <h2>Export packages</h2>

        <div class="clearfix">
            {{ form.label('package_id') }}
            {{ form.render('package_id', ['class' : 'input-middle']) }}
            {{ form.messages('package_id') }}
        </div>

        <div class="clearfix">
            {{ form.label('from_time') }}
            <div class="row">
                <div class="span">
                    {{ form.render('from_time', ['class' : 'input-middle']) }}
                </div>
                <div class="span" id="custom-from" >
                    &nbsp;
                </div>
            </div>
        </div>

        <div class="clearfix">
            {{ form.label('to_time') }}
            <div class="row">
                <div class="span">
                    {{ form.render('to_time', ['class' : 'input-middle']) }}
                </div>
                <div class="span" id="custom-to" >
                    &nbsp;
                </div>
            </div>

        </div>
        <br>
        <div class="clearfix">
            {{ submit_button("Export CSV", "class": "btn btn-primary", "id": "btn_export") }}
        </div>
    </div>

    {{ end_form() }}

</div>