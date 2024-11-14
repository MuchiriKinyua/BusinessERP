<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="payrolls-table">
            <thead>
            <tr>
                <th>Employee Id</th>
                <th>Salary Id</th>
                <th>Payment Period</th>
                <th>Total Earnings</th>
                <th>Total Deductions</th>
                <th>Net Pay</th>
                <th>Payrolls Status</th>
                <th>Payslip</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payrolls as $payroll)
                <tr>
                    <td>{{ $payroll->employee_id }}</td>
                    <td>{{ $payroll->salary_id }}</td>
                    <td>{{ $payroll->payment_period }}</td>
                    <td>{{ $payroll->total_earnings }}</td>
                    <td>{{ $payroll->total_deductions }}</td>
                    <td>{{ $payroll->net_pay }}</td>
                    <td>{{ $payroll->payrolls_status }}</td>
                    <td>{{ $payroll->payslip }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['payrolls.destroy', $payroll->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('payrolls.show', [$payroll->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('payrolls.edit', [$payroll->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $payrolls])
        </div>
    </div>
</div>
