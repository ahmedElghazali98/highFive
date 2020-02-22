<!-- BEGIN: Left Aside -->
<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close m-aside-left-close--skin-light" id="m_aside_left_close_btn"><i class="la la-close"></i></button>
				<div id="m_aside_left" class="m-grid__item m-aside-left ">

					<!-- BEGIN: Aside Menu -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light " data-menu-vertical="true" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1">
                                <a href="{{route('admin.system_constants.index')}}" class="m-menu__link">
                                    <i class="m-menu__link-icon fa fa-cog"></i>
                                    <span></span></i>
                                    <span class="m-menu__link-text">ثوابت النظام</span>
                                </a>
                                </li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.users.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-users-cog"></i>
        <span class="m-menu__link-text">المستخدمين</span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.employess.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-users"></i>
        <span class="m-menu__link-text">الموظفين</span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.suppliers.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-industry"></i>
        <span class="m-menu__link-text">الموردين</span>
    </a>
</li>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.customers.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-user"></i>
        <span class="m-menu__link-text">الزبائن</span>
    </a>
</li>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.category_products.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-sitemap"></i>
        <span class="m-menu__link-text">تصنيف المنتج </span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.categoties.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-list"></i>
        <span class="m-menu__link-text">الاصناف</span>
    </a>
</li>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.entryDocument.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon far fa-sticky-note"></i>
        <span class="m-menu__link-text">مستند إدخال</span>
    </a>
</li>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.items_production.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fa fa-industry"></i>
        <span class="m-menu__link-text"> إنتاج منتج</span>
    </a>
</li>

<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.dismantling_product.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon  fas fa-cut"></i>
        <span class="m-menu__link-text">تفكيك المنتج </span>
    </a>
</li>




<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.cars.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-car"></i>
        <span class="m-menu__link-text"> السيارات </span>
    </a>
</li>

<!-- start sub menu setting-->


<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover" m-menu-link-redirect="1"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon fas fa-store"></i><span
    class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">المخازن</span> <span class="m-menu__link-badge"></span> </span></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
   <ul class="m-menu__subnav">

       <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="{{route('admin.stores.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">المخازن </span></a></li>

       <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="{{route('admin.internal_store_movements.index')}}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">حركات المخزن الداخلية </span></a></li>

    </ul>
</div>
</li>

 <!--end sub menu setting-->







<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.store_item.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-car"></i>
        <span class="m-menu__link-text"> {{__('text.store_item')}} </span>
    </a>
</li>


<li class="m-menu__item  m-menu__item--submenu tabe_home" aria-haspopup="true" m-menu-submenu-toggle="hover">
    <a href="{{route('admin.store_bills.index')}}" class="m-menu__link m-menu__toggle  m-menu--active">
        <i class="m-menu__link-icon fas fa-car"></i>
        <span class="m-menu__link-text"> {{__('text.store_bills')}} </span>
    </a>
</li>

















<!-- end -->







</ul>
</div>

<!-- END: Aside Menu -->
</div>

<!-- END: Left Aside -->





