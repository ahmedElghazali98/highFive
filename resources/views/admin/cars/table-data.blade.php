<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
                        <th class="text-center">{{__('text.name')}}</th>
                        <th class="text-center">{{__('text.car_number')}}</th>
                        <th class="text-center">{{__('text.edit')}}</th>
						<th class="text-center">{{__('text.delete')}}</th>

				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['cars']) > 0)
                    @foreach($data['cars'] as $car)


					<tr class="m-datatable__row">
						<td>
							{{$i++}}
						</td>
						<td>

                            {{$car->name_ar}}

                        </td>

                        <td>

                            {{$car->car_number}}

						</td>



						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$car->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>


						<td class="text-center"><a href="javascript:void(0)" data-id="{{$car->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>

                    </tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="9">{{__('text.none')}}</td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['cars']->render() !!}
	</div>
</div>
