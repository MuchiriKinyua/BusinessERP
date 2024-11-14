<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="deductions-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Deduction Type</th>
                <th>Amount</th>
                <th>Date Applied</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($deductions as $deduction)
                <tr>
                    <td>{{ $deduction->employee_id }}</td>
                    <td>{{ $deduction->deduction_type }}</td>
                    <td>{{ $deduction->amount }}</td>
                    <td>{{ $deduction->date_applied }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['deductions.destroy', $deduction->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('deductions.show', [$deduction->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('deductions.edit', [$deduction->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $deductions])
        </div>
    </div>
</div>
