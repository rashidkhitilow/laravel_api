@php
    $item_name = "user";
    $form_id = "add_user_frm";
    $url = "users";
@endphp
<script>

$(document).on('click', '.show_add_{{ $item_name }}_btn', (e) => {
    MyUtils.popup(
        'Add new user',
        `<form id="{{ $form_id }}" autocomplete="off">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form">
                    <div class="row">
                        <div class="col-auto mb-3">
                            <label>Full Name*</label>
                            <input style="width: 250px;" type="text" class="form-control" name="name" value="" placeholder="Full name..." >
                        </div>
                        <div class="col-auto mb-3">
                            <label>Email*</label>
                            <input style="width: 100%;" type="text" class="form-control" name="email" value="" placeholder="Email..." >
                        </div>
                        <div class="col-auto mb-3">
                            <label>Phone*</label>
                            <input style="width: 100%;" type="number" step="0.01" class="form-control" name="phone" value="" placeholder="Phone..." >
                        </div>
                        <div class="col-auto mb-3">
                            <label>Password*</label>
                            <input style="width: 100%;" type="password" step="0.01" class="form-control" name="password" value="" placeholder="Password..." >
                        </div>
                        <div class="col-auto mb-3">
                            <label>Repeat Password*</label>
                            <input style="width: 100%;" type="password" step="0.01" class="form-control" name="password2" value="" placeholder="Repeat Password..." >
                        </div>
                        <div class="col-auto mb-3">
                            <label style="width: 100%;">&nbsp;</label>
                            <button type="button" class="btn btn-primary add_{{ $item_name }}_btn">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            `,
        650);
})

$(document).on('click', '#{{ $form_id }} .add_{{ $item_name }}_btn', async (e) => {
    MyUtils.loadingShow();
    var formData = new FormData($('#{{ $form_id }}')[0])
    $.ajax({
        url: '/{{ $url }}/new',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
    }).done(function(data) {
        if (data && data['result'] == 'success') {
            MyUtils.clearPopupForm('{{ $form_id }}')

            $.get('/{{ $url }}/filter?ff__id='+data['user']['id']).done(function(data) {
                $('tr', $(data)).each(function(index) {
                    if (index == 0 || index > 1) return;
                    $('#all_items_tbl tr:first').after($(this))
                    MyUtils.flash(this)
                })
            })
            MyUtils.toastSuccess(data['message'])
        } else MyUtils.toastError(data['message'])
    })
    .fail(function(data) {
        MyUtils.toastError(data && data.responseJSON ? data.responseJSON['message'] : null)
    })
    .always(function() {
        MyUtils.loadingHide()
    });
})

</script>