<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document" >
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('text.add_new') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-form__group row">

                        <div class="col-md-12">
                            <label>{{__('text.document')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="document"  class="form-control document" placeholder="{{__('text.document')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.name_suppliers')}}<span class="required">*</span></label>
                            <select name="supplier_id" class="form-control supplier_id" id="supplier_id">
                                <option value="-1">-----</option>
                                @foreach($data['suppliers'] as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{$supplier->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.date')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input data-date-format="dd/mm/yyyy" id="datepicker" name="date" class="form-control date" placeholder="{{__('text.date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>{{__('text.item')}}<span class="required">*</span></label>
                            <div class="form-valid">

                            <input type="text" name="item_name_seach"  class="form-control item_name_seach" placeholder="	{{__('text.item')}}
                            ">
                            </div>
                        </div>

                    </div>


                        <!-- start tabel-->

                        <div class="form-group m-form__group row">
                            <table class="table table-bordered" id="html_table" width="100%">
                                <thead class="m-datatable__head">
                                    <tr>
                                            <th class="text-center">{{__('text.item')}}</th>
                                            <th class="text-center">{{__('text.quantity')}}</th>
                                            <th class="text-center">{{__('text.price')}}</th>
                                            <th class="text-center">{{__('text.delete')}}</th>

                                    </tr>
                                </thead>
                                <tbody class="m-datatable__body load tbody_entry_documetn" id="tbody_entry_documetn">


                                </tbody>


                            </table>


                        </div>













                    <div class="form-group m-form__group row">

                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">{{__('text.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
            </form>
        </div>
    </div>
</div>


