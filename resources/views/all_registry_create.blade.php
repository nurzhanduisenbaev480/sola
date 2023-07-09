<div class="row">
    <div class="col-4 border-right min-vh-100">
        @foreach($left_panels as $row)
            {!! $row !!}
        @endforeach
    </div>
    <div class="col-8 no-gutter min-vh-100">
        @foreach($right_panels as $row)
            {!! $row !!}
        @endforeach
    </div>
</div>
