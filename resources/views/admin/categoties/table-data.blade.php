<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
                        <th class="text-center">{{__('text.name')}}</th>
                        <th class="text-center">{{__('text.unit')}}</th>
                        <th class="text-center">{{__('text.safety_stocks')}}</th>
                        <th class="text-center">{{__('text.quantity')}}</th>
                        <th class="text-center">{{__('text.edit')}}</th>
						<th class="text-center">{{__('text.delete')}}</th>

				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['categories']) > 0)
                    @foreach($data['categories'] as $category)

					<tr class="m-datatable__row">
						<td>
                            {{$i++}}
						</td>
						<td>
                            {{app::setLocale(   session('locale'))}}
                            @if (App::getLocale()=='ar')
                            {{$category->name_ar}}
                            @elseif(App::getLocale()=='en')
                            {{$category->name_en}}
                            @else
                            {{$category->name_ar}}
                            @endif


                        </td>

                        <td>
                            {{ $category->unit->name_ar }}
                        </td>

                        <td>
                      {{ $category->safety_stocks }}
                        </td>

                        <td>
                            {{ $category->quantity }}
                        </td>

						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$category->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>


						<td class="text-center"><a href="javascript:void(0)" data-id="{{$category->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
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


  <!--  <iframe src="https://player.vimeo.com/video/390164649" width="200" height="200" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  -->

	<div style="text-align: center;">
			{!! $data['categories']->render() !!}
	</div>
</div>
