<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
                        <th class="text-center">{{__('text.name')}}</th>
                        <th class="text-center">{{__('text.type')}}</th>
                        <th class="text-center">{{__('text.status')}}</th>
                        <th class="text-center">{{__('text.edit')}}</th>
						<th class="text-center">{{__('text.delete')}}</th>

				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['system_constants']) > 0)
					@foreach($data['system_constants'] as $system_constant)
                    @php
                    if($system_constant->status==1)
                            {
                            $class='btn btn-success m-btn m-btn--icon m-btn--pill';
                            $color='green';
                            $icon='check';
                            $text = __('forms.active');
                        }else{
                            $class='btn btn-danger m-btn m-btn--icon m-btn--pill';
                            $color='red';
                            $icon='check';
                            $text =__('forms.inactive');
                        }
                @endphp
					<tr class="m-datatable__row">
						<td>
							{{$i++}}
						</td>
						<td>
                            {{$system_constant->name_ar}}


                        </td>

                        <td>
                            @foreach($data['system_constants_select'] as $system_constant_select)
                            @if($system_constant_select->value2 == $system_constant->type)
                            {{$system_constant_select->name_ar}}

                            @endif
                            @endforeach


                        </td>
                        <td class="text-center">
							<a  color="{{$color}}" data-id="{{$system_constant->id}}" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
						</td>




						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$system_constant->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>


						<td class="text-center"><a href="javascript:void(0)" data-id="{{$system_constant->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>

					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="9">{{__('forms.none')}}</td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['system_constants']->render() !!}
	</div>
</div>
