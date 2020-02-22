<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{__('text.document')}}</th>
                        <th class="text-center">{{__('text.supplier')}}</th>
                        <th class="text-center">{{__('text.date')}}</th>
                        <th class="text-center">{{__('text.print_report')}}</th>
                        <th class="text-center">{{__('text.edit')}}</th>
						<th class="text-center">{{__('text.delete')}}</th>

				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php
					$i =1;
				@endphp
				@if(count($data['entry_documents']) > 0)
                    @foreach($data['entry_documents'] as $entry_document)

					<tr class="m-datatable__row">
						<td>
							{{$i++}}
                        </td>
                        <td>

                            {{$entry_document->document}}

						</td>
						<td>

                            {{app::setLocale(   session('locale'))}}
                            @if (App::getLocale()=='ar')
                            {{$entry_document->supplier->name_ar}}
                            @elseif(App::getLocale()=='en')
                            {{$entry_document->supplier->name_en}}
                            @else
                            {{$entry_document->supplier->name_ar}}
                            @endif
                        </td>

                        <td>

                            {{$entry_document->date}}

						</td>


                        <td class="text-center">
							<a href="{{route('admin.entryDocument.pdf',['id'=>$entry_document->id])}}"  target="_blank" style="background-color:green;color: white;
                                border: 1px solid green"  class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							"> <i class="far fa-file-pdf"></i> </a>
                        </td>


						<td class="text-center">
							<a href="javascript:void(0)" data-id="{{$entry_document->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>


						<td class="text-center">
                            <a href="javascript:void(0)" data-id="{{$entry_document->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
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
			{!! $data['entry_documents']->render() !!}
	</div>
</div>
