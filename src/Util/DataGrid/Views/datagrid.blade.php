<div class="rpd-datagrid table-responsive">

    <div class="row" style="margin: 0;">

        <div class="col-md-7">
            {!! $filter or '' !!}
        </div>

        <div class="col-md-5">
            @include('rapyd::toolbar', [
                'label' => $label,
                'buttons_right' => $buttons['TR']
            ])
        </div>

    </div>

    <hr style="margin: 0;">

    <table{!! $dg->buildAttributes() !!}>
        <thead>
        <tr>
            @foreach ($dg->columns as $column)
                <th{!! $column->buildAttributes() !!}>
                    @if ($column->orderby)
                        @if ($dg->onOrderby($column->orderby_field, 'asc'))
                            <span class="glyphicon glyphicon-chevron-up"></span>
                        @else
                            <a href="{{ $dg->orderbyLink($column->orderby_field,'asc') }}">
                                <span class="glyphicon glyphicon-chevron-up"></span>
                            </a>
                        @endif
                        @if ($dg->onOrderby($column->orderby_field, 'desc'))
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        @else
                            <a href="{{ $dg->orderbyLink($column->orderby_field,'desc') }}">
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </a>
                        @endif
                    @endif
                    {!! $column->label !!}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @if (count($dg->rows) == 0)
            <tr><td colspan="{!! count($dg->columns) !!}">{!! trans('rapyd::rapyd.no_records') !!}</td></tr>
        @endif
        @foreach ($dg->rows as $row)
            <tr{!! $row->buildAttributes() !!}>
                @foreach ($row->cells as $cell)
                    <td{!! $cell->buildAttributes() !!}>{!! $cell->value !!}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="btn-toolbar" role="toolbar">
        @if ($dg->havePagination())
            <div class="pull-left">
                {!! $dg->links() !!}
            </div>
            <div class="pull-right">
                {!! $dg->totalRows() !!}
            </div>
        @endif
    </div>
</div>

