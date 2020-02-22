<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
    <li class="m-menu__item  m-menu__item--active " aria-haspopup="true">
        <a href="{{ route('admin.dashboard.view') }}" class="m-menu__link "><span class="m-menu__item-here">
            </span><span class="m-menu__link-text">{{__('text.dashboard')}}
                </span></a>
            </li>

    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
             class="m-menu__link-text">{{__('text.setting')}}</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.system_constants.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.system_constants')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.users.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-users-cog"></i>
                        <span class="m-menu__link-text">{{__('text.users')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.employess.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-users"></i>
                        <span class="m-menu__link-text">{{__('text.employees')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.suppliers.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-industry"></i>
                        <span class="m-menu__link-text">{{__('text.suppliers')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.customers.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-user"></i>
                        <span class="m-menu__link-text">{{__('text.customers')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.cars.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-car"></i>
                        <span class="m-menu__link-text">{{__('text.cars')}} </span>
                    </a>
                </li>


                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.tax_category.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-sitemap"></i>
                        <span class="m-menu__link-text">{{__('text.tax_category')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.taxes.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fas fa-calculator"></i>
                        <span class="m-menu__link-text">{{__('text.taxes')}} </span>
                    </a>
                </li>






            </ul>
        </div>
    </li>

    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
             class="m-menu__link-text">{{__('text.items')}}</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
            <ul class="m-menu__subnav">

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.category_products.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.category_products')}} </span>
                    </a>
                </li>


                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.items.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.items')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.items_production.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.items_production')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.dismantling_product.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.dismantling_product')}} </span>
                    </a>
                </li>

                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                    <a href="{{route('admin.entryDocument.index')}}" class="m-menu__link ">
                        <i class="m-menu__link-icon fa fa-cog"></i>
                        <span class="m-menu__link-text">{{__('text.entry_documents')}} </span>
                    </a>
                </li>


            </ul>
        </div>
    </li>


    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><span class="m-menu__item-here"></span><span
        class="m-menu__link-text">{{__('text.stores')}}</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
   <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow m-menu__arrow--adjust"></span>
       <ul class="m-menu__subnav">

           <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
               <a href="{{route('admin.stores.index')}}" class="m-menu__link ">
                   <i class="m-menu__link-icon fa fa-cog"></i>
                   <span class="m-menu__link-text">{{__('text.stores')}} </span>
               </a>
           </li>


           <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
               <a href="{{route('admin.internal_store_movements.index')}}" class="m-menu__link ">
                   <i class="m-menu__link-icon fa fa-cog"></i>
                   <span class="m-menu__link-text">{{__('text.internal_store_movements')}} </span>
               </a>
           </li>

           <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
               <a href="{{route('admin.store_bills.index')}}" class="m-menu__link ">
                   <i class="m-menu__link-icon fa fa-cog"></i>
                   <span class="m-menu__link-text">{{__('text.store_bills')}} </span>
               </a>
           </li>

           <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
               <a href="{{route('admin.store_item.index')}}" class="m-menu__link ">
                   <i class="m-menu__link-icon fa fa-cog"></i>
                   <span class="m-menu__link-text">{{__('text.store_item')}} </span>
               </a>
           </li>




       </ul>
   </div>
</li>









</ul>
