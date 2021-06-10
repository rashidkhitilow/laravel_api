<style>
    #add_connected_modules {
        display: flex;
        justify-content: start;
        align-items: start;
    }
</style>

@php
    $item_name = 'toot_user';
    $folder_name = 'toot_users';
    $url = 'toot_users';
@endphp
<div class="row">
    <div class="col col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h1 class="card-title">
                    Users
                </h1>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="m-0">
                        @csrf
                        <input type="hidden" name="page" value="{{request('page')??1}}" />
                        @include($folder_name.'.filter')
                        <div class="row">
                            <div class="col-12" id="tbl_holder">@include($folder_name.'.tbl')</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@section('js_script')

@include('snippets.form_filter', ['filter_url' => '/'.$url.'/filter'])

@endsection

