<div class="form">
    <div class="row">
        <div class="col-auto mb-3">
            <h5 style="padding-top: 7px;"><i class="fas fa-filter"></i></h5>
        </div>
        <div class="col-auto mb-3">
            <input placeholder="First name..." type="text" class="form-control" name="ff__first_name"
                value="{{ request('ff__first_name') }}" />
        </div>
        <div class="col-auto mb-3">
            <input placeholder="Last name..." type="text" class="form-control" name="ff__last_name"
                value="{{ request('ff__last_name') }}" />
        </div>
        <div class="col-auto mb-3">
            <input placeholder="Email..." type="text" class="form-control" name="ff__email"
                value="{{ request('ff__email') }}" />
        </div>
        <div class="col-auto mb-3">
            <button type="button" id="reset_filter" class="btn btn-primary"><i class="fas fa-eraser"></i> Reset</button>
        </div>
        <div class="col-auto mb-3">
            @include('snippets.export_excel_btn')
        </div>
    </div>
</div>
