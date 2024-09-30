@forelse($bank_data as $b)
<div class="payment_list">
    <div class="flex-fill">
        <p>{{ $b->bank_name}}</p>
    </div>
    <div>
        <div class="btn-group dropleft">
            <button type="button" class="circle_drop" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </button>
            <div class="dropdown-menu dash-drop icongp">
                <a class="dropdown-item" href="javascript:void(0)" onclick="primaryAccount('{{$b->id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Set as Primary</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="editBankData('{{$b->id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="viewBankData('{{$b->id}}')"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteBankData('{{$b->id}}')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
            </div>
        </div>
    </div>
</div>
@empty
@endforelse