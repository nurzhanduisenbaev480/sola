<!DOCTYPE html>
<html lang="en">
<head>
    <title>invoice card - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table td, .table th{
            font-size: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th rowspan="2">№</th>
                    <th rowspan="2">Заявка</th>
                    <th rowspan="2">Юр.лицо</th>
                    <th colspan="5" style="text-align: center;">Получатель</th>
                    <th rowspan="2">Отправитель</th>
                    <th rowspan="2">Груз</th>
                    <th rowspan="2">Мест</th>
                    <th rowspan="2">Вес</th>
                    <th rowspan="2">Объем</th>
                    <th rowspan="2">ФИО, Подпись</th>
                </tr>
                <tr>
                    <th>Грузополучатель</th>
                    <th>Контактное лицо</th>
                    <th>Контакты</th>
                    <th>Город</th>
                    <th>Адрес доставки</th>
                </tr>
                </thead>
				<tbody>
					@php $i=0;@endphp
					@foreach($overheads as $overhead)
					@php $i++;@endphp
					<tr>
						<td>{{$i}}</td>
						<td>{{$overhead->overhead_code}}</td>
						@if($overhead->nds == 1)
							<td>ALSI</td>
						@else
							<td>SALAR</td>
						@endif
						<td>{{$overhead->to_company}}</td>
						<td>{{$overhead->to_name}}</td>
						<td>{{$overhead->to_phone}}</td>
						<td>{{App\Models\City::find($overhead->to_city)->city_name}}</td>
						<td>{{$overhead->to_address}}</td>
						<td>{{$overhead->from_company}}</td>
						<td>{{$overhead->product_name}}</td>
						<td>{{$overhead->place}}</td>
						<td>{{$overhead->mass}}</td>
						<td>{{$overhead->volume}}</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
