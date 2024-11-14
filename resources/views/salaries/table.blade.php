<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="salaries-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Basic Salary</th>
                <th>Bonus</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th>Pay Date</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee_id }}</td>
                    <td>{{ $salary->basic_salary }}</td>
                    <td>{{ $salary->bonus }}</td>
                    <td>{{ $salary->deductions }}</td>
                    <td>{{ $salary->net_salary }}</td>
                    <td>{{ $salary->pay_date }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['salaries.destroy', $salary->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('salaries.show', [$salary->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('salaries.edit', [$salary->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $salaries])
        </div>
    </div>
</div>
