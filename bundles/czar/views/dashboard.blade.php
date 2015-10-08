@layout('czar::pageshell')

@section('content')

	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('userdata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('totalusers') }}</td>
						<td> {{$users_total}}</td>
					</tr>
					<tr>
						<td>{{ t('userstoday') }}</td>
						<td> {{$users_today}}</td>
					</tr>
					<tr>
						<td>{{ t('usersweek') }}</td>
						<td> {{$users_week}}</td>
					</tr>
					<tr>
						<td>{{ t('usersmonth') }}</td>
						<td> {{$users_month}}</td>
					</tr>
					<tr>
						<td>{{ t('usersonline') }}</td>
						<td> {{$users_online}}</td>
					</tr>
					<tr>
						<td>{{ t('maleusers') }}</td>
						<td> {{$users_male}}</td>
					</tr>
					<tr>
						<td>{{ t('femaleusers') }}</td>
						<td>{{$users_female}}</td>
					</tr>
				</tbody>
			</table>
	</div>


	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('photodata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('totalphotos') }}</td>
						<td> {{$photos_total}}</td>
					</tr>
					<tr>
						<td>{{ t('photostoday') }}</td>
						<td> {{$photos_today}}</td>
					</tr>
					<tr>
						<td>{{ t('photosweek') }}</td>
						<td> {{$photos_week}}</td>
					</tr>
					<tr>
						<td>{{ t('photosmonth') }}</td>
						<td> {{$photos_month}}</td>
					</tr>
				</tbody>
			</table>
	</div>

	
	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('msgdata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('msgtotal') }}</td>
						<td> {{$msg_total}}</td>
					</tr>
					<tr>
						<td>{{ t('msgtoday') }}</td>
						<td> {{$msg_today}}</td>
					</tr>
					<tr>
						<td>{{ t('msgweek') }}</td>
						<td> {{$msg_week}}</td>
					</tr>
					<tr>
						<td>{{ t('msgmonth') }}</td>
						<td> {{$msg_month}}</td>
					</tr>
				</tbody>
			</table>
	</div>

	
	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('encounterdata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('enountertotal') }}</td>
						<td> {{$encounters_total}}</td>
					</tr>
					<tr>
						<td>{{ t('encountertoday') }}</td>
						<td> {{$encounters_today}}</td>
					</tr>
					<tr>
						<td>{{ t('encounterweek') }}</td>
						<td> {{$encounters_week}}</td>
					</tr>
					<tr>
						<td>{{ t('encountermonth') }}</td>
						<td> {{$encounters_month}}</td>
					</tr>
				</tbody>
			</table>
	</div>


	

	
	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('giftdata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('gifttotal') }}</td>
						<td> {{$gifts_total}}</td>
					</tr>
					<tr>
						<td>{{ t('gifttoday') }}</td>
						<td> {{$gifts_today}}</td>
					</tr>
					<tr>
						<td>{{ t('giftweek') }}</td>
						<td> {{$gifts_week}}</td>
					</tr>
					<tr>
						<td>{{ t('giftmonth') }}</td>
						<td> {{$gifts_month}}</td>
					</tr>
				</tbody>
			</table>
	</div>

	
	<div class="portlet-body">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>{{ t('photoraterdata') }}</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>{{ t('ratingtotal') }}</td>
						<td> {{$photo_rater_total}}</td>
					</tr>
					<tr>
						<td>{{ t('ratingtoday') }}</td>
						<td> {{$photo_rater_today}}</td>
					</tr>
					<tr>
						<td>{{ t('ratingweek') }}</td>
						<td> {{$photo_rater_week}}</td>
					</tr>
					<tr>
						<td>{{ t('ratingmonth') }}</td>
						<td> {{$photo_rater_month}}</td>
					</tr>
				</tbody>
			</table>
	</div>
@endsection
