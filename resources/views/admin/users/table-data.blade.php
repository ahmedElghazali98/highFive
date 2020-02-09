<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{__('text.username')}}</th>
						<th class="text-center">{{__('text.email')}}</th>
						<th class="text-center">{{__('text.fullname')}}</th>
						<th class="text-center">{{__('text.status')}}</th>
                        <th class="text-center">{{__('text.edit')}}</th>
                        <th class="text-center">{{__('text.change_password')}}</th>
						<th class="text-center">{{__('text.permissions')}}</th>
						<th class="text-center">{{__('text.delete')}}</th>

				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['users']) > 0)
					@foreach($data['users'] as $users)
					@php
						if($users->status==1)
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
							{{$users->username}}
						</td>
						<td>
							{{$users->email}}
						</td>
						<td>
							{{$users->fullname}}
						</td>

						<td class="text-center">
							<a  color="{{$color}}" data-id="{{$users->id}}" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
						</td>

						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$users->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>

                        <td class="text-center">
							<a href="javascript:void(0)"  data-id="{{$users->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							password-modal"> <i class="fa fa-lock"></i> </a>
                        </td>

						<td class="text-center">
							<a href="javascript:void(0)"  data-id="{{$users->id}}" style="background-color:green" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                permission"> <i class="fa fa-lock"></i> </a>
                        </td>


						<td class="text-center"><a href="javascript:void(0)" data-id="{{$users->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
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
			{!! $data['users']->render() !!}
	</div>
</div>
