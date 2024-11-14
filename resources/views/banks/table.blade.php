<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="banks-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>Account Number</th>
                <th>Account Name</th>
                <th>Account Type</th>
                <th>Bank Code</th>
                <th>Currency</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($banks as $bank)
                <tr>
                    <td>{{ $bank->employee_id }}</td>
                    <td>{{ $bank->bank_name }}</td>
                    <td>{{ $bank->branch_name }}</td>
                    <td>{{ $bank->account_number }}</td>
                    <td>{{ $bank->account_name }}</td>
                    <td>{{ $bank->account_type }}</td>
                    <td>{{ $bank->bank_code }}</td>
                    <td>{{ $bank->currency }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['banks.destroy', $bank->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('banks.show', [$bank->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('banks.edit', [$bank->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $banks])
        </div>
    </div>
</div>
