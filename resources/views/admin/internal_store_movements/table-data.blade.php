<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
                        <th class="text-center">{{__('text.from')}}</th>
                        <th class="text-center">{{__('text.to')}}</th>
                        <th class="text-center">{{__('text.date')}}</th>
                        <th class="text-center">{{__('text.processors')}}</th>
                        <th class="text-center">{{__('text.processors_log')}}</th>
                       <!-- <th class="text-center">{{__('text.delete')}}</th>-->
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['internal_store_movements']) > 0)
                    @foreach($data['internal_store_movements'] as $internal_store_movement)


					<tr class="m-datatable__row">
						<td>
							{{$i++}}
						</td>
						<td>


                            {{$internal_store_movement->from_store->name_ar}}

                        </td>

                        <td>

                            {{$internal_store_movement->to_store->name_ar}}

                        </td>

                        <td>

                            {{$internal_store_movement->date}}

						</td>



						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$internal_store_movement->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
                        </td>

                        <td class="text-center">
							<a href="javascript:void(0)" data-id="{{$internal_store_movement->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                processors_log"> <i class="fa fa-history"></i> </a>
						</td>


						<!--<td class="text-center"><a href="javascript:void(0)" data-id="{{$internal_store_movement->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>-->

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
			{!! $data['internal_store_movements']->render() !!}
	</div>
</div>
