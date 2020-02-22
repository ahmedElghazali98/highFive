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

                        <div class="col-md-6">
                            <label>{{__('text.item')}}<span class="required">*</span></label>
                        <input type="text" name="tag_search"  autocomplete="off"  class="form-control tag_search" placeholder="{{__('text.item')}}">

                        <input type="hidden" name="item_id" class="item_id" value="" >

                        <ul class="search_result_order tag_search_dropdown">
                        </ul>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.date')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input data-date-format="dd/mm/yyyy" autocomplete="off" id="datepicker" name="date" class="form-control date" placeholder="{{__('text.date')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{__('text.to')}}<span class="required">*</span></label>
                            <select name="to_store_id" class="form-control to_store_id selectpicker"
                            data-show-subtext="true" data-live-search="true"
                            id="to_store_id">
                                <option value="">{{__('text.to')}}</option>
                                @foreach($data['stores'] as $s)
                                    <option value="{{$s->id}}">
                                        {{$s->name_ar}}
                                    </option>
                                    @endforeach
                            </select>
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


