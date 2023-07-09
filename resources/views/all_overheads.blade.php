<div class="row">
{{--    <div class="col-12 border-right min-vh-200">--}}
{{--        <div class="bg-white rounded shadow-sm mb-3 p-4 py-4 d-flex flex-column">--}}
{{--            <form action="#">--}}
{{--                <div class="form-wrap" style="display: flex;align-items: center;">--}}
{{--                    <div class="form-group" style="display: flex;align-items: center;">--}}
{{--                        <label for="overhead_code" class="form-label me-3">Введите номер накладного:</label>--}}
{{--                        <input type="text" id="overhead_code" name="overhead_code" class="form-control">--}}
{{--                    </div>--}}
{{--                    <div class="form-group" style="display: flex;align-items: center;margin-top: -20px;">--}}
{{--                        <button type="submit" class="btn btn-link" id="searchButton">Поиск</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-12 border-right min-vh-200">
        @foreach($table as $row)
            {!! $row !!}
        @endforeach
    </div>
</div>
<script>

</script>
