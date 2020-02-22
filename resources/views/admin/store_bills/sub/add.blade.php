<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document" >
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm2" action="" method="post" enctype="multipart/form-data">
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
                            <label>{{__('text.statement')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="statement"  class="form-control statement" placeholder="{{__('text.statement')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.name_suppliers')}}<span class="required">*</span></label>
                            <select name="supplier_id" class="form-control supplier_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="supplier_id">
                                <option value="">-----</option>
                                @foreach($data['suppliers'] as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{$supplier->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.type_bill')}}<span class="required">*</span></label>
                            <select name="type_id" class="form-control type_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="type_id">
                                <option value="">-----</option>
                                @foreach($data['type_bill'] as $t)
                                    <option value="{{$t->id}}">
                                        {{$t->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.stores')}}<span class="required">*</span></label>
                            <select name="store_id" class="form-control store_id  selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="store_id">
                                <option value="">-----</option>
                                @foreach($data['stores'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
                        </div>




                        <div class="col-md-6">
                            <label>{{__('text.discount')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="discount"  class="form-control discount" placeholder="{{__('text.discount')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.item')}}<span class="required"></span></label>
                            <div class="form-valid">

                            <input type="text" name="tag_search"  autocomplete="off"  class="form-control tag_search" placeholder="{{__('text.item')}}">

                            <ul class="search_result_order tag_search_dropdown">
                            </ul>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label>{{__('text.barcode')}}<span class="required"></span></label>
                            <div class="form-valid">

                            <input type="text" name="barcode_search"  autocomplete="off"  class="form-control barcode_search" placeholder="{{__('text.barcode')}}">

                            <ul class="search_result_order barcode_search_dropdown">
                            </ul>
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
                                    <!-- add tr based on function js-->

                                </tbody>


                            </table>


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



<!--                          model log tabel   -->

<div class="modal fade in" id="tabel_log" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xlg " role="document" >
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('text.processors_log') }} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- start tabel-->

                    <div class="form-group m-form__group row">


                        <div class="col-md-12">
                        <table class="table table-bordered" id="html_table" width="100%">
                            <thead class="m-datatable__head">
                                <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">{{__('text.store')}}</th>
                                        <th class="text-center">{{__('text.item')}}</th>
                                       <!-- <th class="text-center">{{__('text.transaction_type')}}</th>-->
                                        <th class="text-center">{{__('text.quantity')}}</th>
                                        <th class="text-center">{{__('text.price')}}</th>
                                        <th class="text-center">{{__('text.user')}}</th>
                                        <th class="text-center">{{__('text.date')}}</th>


                                </tr>
                            </thead>
                            <tbody class="m-datatable__body load tbody_items" id="tbody_log">


                            </tbody>


                        </table>
                        </div>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{__('text.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>





