@extends('layouts.admin.app')

@section('title', translate('messages.reCaptcha Setup'))


@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('assets/admin/img/captcha.png')}}" class="w--26" alt="">
                </span>
                <span>
                    {{translate('messages.reCaptcha_credentials_setup')}}
                </span>
            </h1>
            @include('admin-views.business-settings.partials.third-party-links')
        </div>
        <!-- End Page Header -->

        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <span class="status">
                        {{translate('Status')}}
                    </span>

                </div>
                <div class="mt-2">
                    @php($config=\App\CentralLogics\Helpers::get_business_settings('recaptcha'))
                    <form
                        action="{{env('APP_MODE')!='demo'?route('admin.business-settings.third-party.recaptcha_update',['recaptcha']):'javascript:'}}"
                        method="post">
                        @csrf
                        <label class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control mb-4">
                            <span class="pr-1 d-flex align-items-center switch--label">
                                <span class="line--limit-1">
                                    @if (isset($config) && $config['status'] == 1)
                                    {{translate('Turn OFF')}}
                                    @else
                                    {{translate('Turn ON')}}
                                    @endif
                                </span>
                            </span>
                            <input type="checkbox"
                                   data-id="recaptcha_status"
                                   data-type="toggle"
                                   data-image-on="{{ asset('/assets/admin/img/modal/important-recapcha.png') }}"
                                   data-image-off="{{ asset('/assets/admin/img/modal/warning-recapcha.png') }}"
                                   data-title-on="{{ translate('Important!') }}"
                                   data-title-off="{{ translate('Warning!') }}"
                                   data-text-on="<p>{{ translate('reCAPTCHA is now enabled for added security. Users may be prompted to complete a reCAPTCHA challenge to verify their human identity and protect against spam and malicious activity.') }}</p>"
                                   data-text-off="<p>{{ translate('Disabling reCAPTCHA may leave your website vulnerable to spam and malicious activity and suspects that a user may be a bot. It is highly recommended to keep reCAPTCHA enabled to ensure the security and integrity of your website.') }}</p>"
                                   class="status toggle-switch-input dynamic-checkbox-toggle"
                                   name="status" id="recaptcha_status" value="1" {{isset($config) && $config['status'] == 1 ? 'checked':''}}>
                            <span class="toggle-switch-label text p-0">
                                <span class="toggle-switch-indicator"></span>
                            </span>
                        </label>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="site_key" class="form-label">{{translate('messages.Site Key')}}</label><br>
                                    <input id="site_key" type="text" class="form-control" name="site_key"
                                            value="{{env('APP_MODE')!='demo'?$config['site_key']??"":''}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="site_key" class="form-label">{{translate('messages.Secret Key')}}</label><br>
                                    <input id="site_key" type="text" class="form-control" name="secret_key"
                                            value="{{env('APP_MODE')!='demo'?$config['secret_key']??"":''}}">
                                </div>
                            </div>
                        </div>
                        <ul class="list-gap-5">
                            <li>{{translate('messages.Go to the Credentials page')}}
                                ({{translate('messages.Click')}} <a
                                    href="https://www.google.com/recaptcha/admin/create"
                                    target="_blank">{{translate('messages.here')}}</a>)
                            </li>
                            <li>{{translate('messages.Add a ')}}
                                <b>{{translate('messages.label')}}</b> {{translate('messages.(Ex: Test Label)')}}
                            </li>
                            <li>
                                {{translate('messages.Select reCAPTCHA v2 as ')}}
                                <b>{{translate('messages.reCAPTCHA Type')}}</b>
                                ({{translate("Sub type: I'm not a robot Checkbox")}}
                                )
                            </li>
                            <li>
                                {{translate('messages.Add')}}
                                <b>{{translate('messages.domain')}}</b>
                                {{translate('messages.(For ex: demo.6amtech.com)')}}
                            </li>
                            <li>
                                {{translate('messages.Check in ')}}
                                <b>{{translate('messages.Accept the reCAPTCHA Terms of Service')}}</b>
                            </li>
                            <li>
                                {{translate('messages.Press')}}
                                <b>{{translate('messages.Submit')}}</b>
                            </li>
                            <li>{{translate('messages.Copy')}} <b>{{ translate('Site') }}
                                    {{ translate('Key') }}</b> {{translate('messages.and')}} <b>{{ translate('Secret') }}
                                    {{ translate('Key') }}</b>, {{translate('messages.paste in the input filed below and')}}
                                <b>{{ translate('Save') }}</b>.
                            </li>
                        </ul>
                        <div class="btn--container justify-content-end">
                            <button type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                            <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}" class="btn btn--primary call-demo">{{translate('messages.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
