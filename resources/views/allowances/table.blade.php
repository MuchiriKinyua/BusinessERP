<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="allowances-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Allowance Type</th>
                <th>Amount</th>
                <th>Date Granted</th>
                <th>Allowance Priviledge</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allowances as $allowance)
                <tr>
                    <td>{{ $allowance->employee_id }}</td>
                    <td>{{ $allowance->allowance_type }}</td>
                    <td>{{ $allowance->amount }}</td>
                    <td>{{ $allowance->date_granted }}</td>
                    <td>{{ $allowance->allowance_priviledge }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['allowances.destroy', $allowance->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('allowances.show', [$allowance->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('allowances.edit', [$allowance->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $allowances])
        </div>
    </div>
</div>
