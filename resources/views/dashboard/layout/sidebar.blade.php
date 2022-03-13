<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    <span>p</span>aint
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
    <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ url('/admin') }}" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('الرئيسية')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('المستخدمين')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account"></i>
          <span class="link-title">{{__('المستخدمين')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="users">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allUser" class="nav-link {{ (request()->is('admin/allUser')) ? 'active' : '' }}">  {{__('كل المستخدمين')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('مزودي الخدمة')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#provider" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account-star"></i>
          <span class="link-title">{{__('مزودي الخدمة')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="provider">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allprovider" class="nav-link {{ (request()->is('admin/allprovider')) ? 'active' : '' }}"> {{__('مزودي الخدمة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/requestProvider" class="nav-link {{ (request()->is('admin/requestProvider')) ? 'active' : '' }}"> {{__('طلبات مزودي الخدمة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/blockedAccount" class="nav-link {{ (request()->is('admin/blockedAccount')) ? 'active' : '' }}"> {{__('الحسابات المجمدة')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('الباقات')}}</li>
      <li class="nav-item ">
        <a href="/admin/allPackage" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('كل الباقات')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('المناقصات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#Tenders" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account-star"></i>
          <span class="link-title">{{__('المناقصات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="Tenders">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allTender" class="nav-link {{ (request()->is('admin/allTender')) ? 'active' : '' }}"> {{__('كل المناقصات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/connectedTenders" class="nav-link {{ (request()->is('admin/connectedTenders')) ? 'active' : '' }}"> {{__('المناقصات المتفق عليها')}}</a>
            </li>

          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('أنواع العمل')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#TypeWork" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account-star"></i>
          <span class="link-title">{{__('أنواع العمل')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="TypeWork">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allTypeWork" class="nav-link {{ (request()->is('admin/allTypeWork')) ? 'active' : '' }}"> {{__('أنواع العمل')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('الاشعارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-bell-ring-outline"></i>
          <span class="link-title">{{__('الاشعارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="notification">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/notifications" class="nav-link {{ (request()->is('admin/notifications')) ? 'active' : '' }}"> {{__('الاشعارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/sendNotifications" class="nav-link {{ (request()->is('admin/sendNotifications')) ? 'active' : '' }}"> {{__('إرسال اشعار')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('قائمة الأدمن')}}</li>
      <li class="nav-item ">
        <a href="/admin/myAdmins" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('قائمة الأدمن')}}</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
