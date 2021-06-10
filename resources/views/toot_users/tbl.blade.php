@php
$item_name = 'toot_user';
@endphp


<table class="table table-bordered" id="all_items_tbl">
    <thead>
        <tr class="table-secondary text-center">
            <th>Full name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Matrix Id</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all['items']->items as $user)
            <tr class="tr_{{ $item_name }}_user" data_id="{{ $user->id }}">
                <td class="td_name">{{ $user->first_name.' '.$user->last_name }}</td>
                <td class="td_email">{{ $user->email }}</td>
                <td class="td_mobile">{!! $user->mobile !!}</td>
                <td class="td_matrix_user_id">{!! $user->matrix_user_id !!}</td>
                <td class="td_created_at">{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{$all['items']->links}} --}}
@include('snippets.load_more_btn')
