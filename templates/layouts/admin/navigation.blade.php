@if (isset($menu['section']) && $menu['section'])
    <li class="kt-menu__section ">
        <h4 class="kt-menu__section-text">{{ $menu['name'] }}</h4>
        <i class="kt-menu__section-icon flaticon-more-v2"></i>
    </li>
@else
    @if ((isset($menu['children']) && arrayKeyHasValue($menu['children'], 'visible', 1))
        || (!isset($menu['children']) && (!isset($menu['visible']) || (isset($menu['visible']) && $menu['visible']))))
        <li class="kt-menu__item {{ (isset($menu['children']) && arrayKeyHasValue($menu['children'], 'active', 1)) ? 'kt-menu__item--active kt-menu__item--open'
            : ((!isset($menu['children']) && isset($menu['active']) && $menu['active']) ? 'kt-menu__item--active' : '') }}">
            <a href="{!! $menu['link'] ?? 'javascript:;' !!}" class="kt-menu__link {{ isset($menu['children']) ? 'kt-menu__toggle' : '' }}">
                @if (isset($menu['icon']))
                    <span class="kt-menu__link-icon">
                        <i class="{{ $menu['icon'] }}"></i>
                    </span>
                @else
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                    </i>
                @endif
                <span class="kt-menu__link-text">{{ __('staff/navigations.'.$menu['name']) }}</span>
                @if (isset($menu['children']))
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                @endif
            </a>
            @if (isset($menu['children']))
                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        @each('layouts.admin.navigation', $menu['children'], 'menu', null)
                    </ul>
                </div>
            @endif
            </a>
        </li>
    @endif
@endif