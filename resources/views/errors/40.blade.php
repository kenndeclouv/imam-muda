<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="/assets/" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>403 | Not Authorized</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/css/demo.css">
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css">


    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/assets/vendor/css/pages/page-misc.css">

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <style type="text/css">
        .layout-menu-fixed .layout-navbar-full .layout-menu,
        .layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
            top: 0px !important;
        }

        .layout-page {
            padding-top: 0px !important;
        }

        .content-wrapper {
            padding-bottom: 0px !important;
        }
    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/vendor/js/template-customizer.js"></script>
    {{-- <style>
        #template-customizer {
            font-family: "Open Sans", BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol" !important;
            font-size: inherit !important;
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            z-index: 99999999;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 400px;
            -webkit-box-shadow: 0px .3125rem 1.375rem 0px rgba(34, 48, 62, .18);
            box-shadow: 0px .3125rem 1.375rem 0px rgba(34, 48, 62, .18);
            -webkit-transition: all .2s ease-in;
            -o-transition: all .2s ease-in;
            transition: all .2s ease-in;
            -webkit-transform: translateX(420px);
            -ms-transform: translateX(420px);
            transform: translateX(420px)
        }

        .dark-style #template-customizer {
            -webkit-box-shadow: 0px .3125rem 1.375rem 0px rgba(20, 20, 29, .26);
            box-shadow: 0px .3125rem 1.375rem 0px rgba(20, 20, 29, .26)
        }

        #template-customizer h5 {
            position: relative;
            font-size: 11px
        }

        #template-customizer>h5 {
            flex: 0 0 auto
        }

        #template-customizer .disabled {
            color: #d1d2d3 !important
        }

        #template-customizer .form-label {
            font-size: .9375rem;
            font-weight: 500
        }

        #template-customizer .form-check-label {
            font-size: .8125rem
        }

        #template-customizer.template-customizer-open {
            -webkit-transition-delay: .1s;
            -o-transition-delay: .1s;
            transition-delay: .1s;
            -webkit-transform: none !important;
            -ms-transform: none !important;
            transform: none !important
        }

        #template-customizer.template-customizer-open .custom-option.checked {
            color: var(--bs-primary);
            border-width: 2px;
            margin: 0
        }

        #template-customizer .template-customizer-header a:hover {
            color: inherit !important
        }

        #template-customizer .template-customizer-open-btn {
            position: absolute;
            top: 180px;
            left: 0;
            z-index: -1;
            display: block;
            width: 38px;
            height: 38px;
            border-top-left-radius: .375rem;
            border-bottom-left-radius: .375rem;
            background: var(--bs-primary);
            box-shadow: 0px .125rem .25rem 0px rgba(105, 108, 255, .4);
            color: #fff !important;
            text-align: center;
            font-size: 18px !important;
            line-height: 38px;
            opacity: 1;
            -webkit-transition: all .1s linear .2s;
            -o-transition: all .1s linear .2s;
            transition: all .1s linear .2s;
            -webkit-transform: translateX(-58px);
            -ms-transform: translateX(-58px);
            transform: translateX(-58px)
        }

        @media(max-width: 991.98px) {
            #template-customizer .template-customizer-open-btn {
                top: 145px
            }
        }

        .dark-style #template-customizer .template-customizer-open-btn {
            background: var(--bs-primary)
        }

        #template-customizer .template-customizer-open-btn::before {
            content: "";
            width: 22px;
            height: 22px;
            display: block;
            background-size: 100% 100%;
            position: absolute;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAABClJREFUaEPtmY1RFEEQhbsjUCIQIhAiUCNQIxAiECIQIxAiECIAIpAMhAiECIQI2vquZqnZvp6fhb3SK5mqq6Ju92b69bzXf6is+dI1t1+eAfztG5z1BsxsU0S+ici2iPB3vm5E5EpEDlSVv2dZswFIxv8UkZcNy+5EZGcuEHMCOBeR951uvVDVD53vVl+bE8DvDu8Pxtyo6ta/BsByg1R15Bwzqz5/LJgn34CZwfnPInI4BUB6/1hV0cSjVxcAM4PbcBZjL0XklIPN7Is3fLCkdQPpPYw/VNXj5IhPIvJWRIhSl6p60ULWBGBm30Vk123EwRxCuIzWkkjNrCZywith10ewE1Xdq4GoAjCz/RTXW44Ynt+LyBEfT43kYfbj86J3w5Q32DNcRQDpwF+dkQXDMey8xem0L3TEqB4g3PZWad8agBMRgZPeu96D1/C2Zbh3X0p80Op1xxloztN48bMQQNoc7+eLEuAoPSPiIDY4Ooo+E6ixeNXM+D3GERz2U3CIqMstLJUgJQDe+7eq6mub0NYEkLAKwEHkiBQDCZtddZCZ8d6r7JDwFkoARklHRPZUFVDVZWbwGuNrC4EfdOzFrRABh3Wnqhv+d70AEBLGFROPmeHlnM81G69UdSd6IUuM0GgUVn1uqWmg5EmMfBeEyB7Pe3txBkY+rGT8j0J+WXq/BgDkUCaqLgEAnwcRog0veMIqFAAwCy2wnw+bI2GaGboBgF9k5N0o0rUSGUb4eO0BeO9j/GYhkSHMHMTIqwGARX6p6a+nlPBl8kZuXMD9j6pKfF9aZuaFOdJCEL5D4eYb9wCYVCanrBmGyii/tIq+SLj/HQBCaM5bLzwfPqdQ6FpVHyra4IbuVbXaY7dETC2ESPNNWiIOi69CcdgSMXsh4tNSUiklMgwmC0aNd08Y5WAES6HHehM4gu97wyhBgWpgqXsrASglprDy7CwhehMZOSbK6JMSma+Fio1KltCmlBIj7gfZOGx8ppQSXrhzFnOhJ/31BDkjFHRvOd09x0mRBA9SFgxUgHpQg0q0t5ymPMlL+EnldFTfDA0NAmf+OTQ0X0sRouf7NNkYGhrOYNrxtIaGg83MNzVDSe3LXLhP7O/yrCsCz1zlWTpjWkuZAOBpX3yVnLqI1yLCOKU6qMrmP7SSrUEw54XF4WBIK5FxCMOr3lVsfGqNSmPzBXUnJTIX1jyVBq9wO6UObOpgC5GjO98vFKnTdQMZXxEsWZlDiCZMIxAbNxQOqlpVZtobejBaZNoBnRDzMFpkxvTQOD36BlrcySZuI6p1ACB6LU3wWuf5581+oHfD1vi89bz3nFUC8Nm7ZlP3nKkFbM4bWPt/MSFwklprYItwt6cmvpWJ2IVcQBCz6bLysSCv3SaANCiTsnaNRrNRqMXVVT1/BrAqz/buu/Y38Ad3KC5PARej0QAAAABJRU5ErkJggg==);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%)
        }

        .customizer-hide #template-customizer .template-customizer-open-btn {
            display: none
        }

        [dir=rtl] #template-customizer .template-customizer-open-btn {
            border-radius: 0;
            border-top-right-radius: .375rem;
            border-bottom-right-radius: .375rem
        }

        [dir=rtl] #template-customizer .template-customizer-open-btn::before {
            margin-left: -2px
        }

        #template-customizer.template-customizer-open .template-customizer-open-btn {
            opacity: 0;
            -webkit-transition-delay: 0s;
            -o-transition-delay: 0s;
            transition-delay: 0s;
            -webkit-transform: none !important;
            -ms-transform: none !important;
            transform: none !important
        }

        #template-customizer .template-customizer-inner {
            position: relative;
            overflow: auto;
            -webkit-box-flex: 0;
            -ms-flex: 0 1 auto;
            flex: 0 1 auto;
            opacity: 1;
            -webkit-transition: opacity .2s;
            -o-transition: opacity .2s;
            transition: opacity .2s
        }

        #template-customizer .template-customizer-inner>div:first-child>hr:first-of-type {
            display: none !important
        }

        #template-customizer .template-customizer-inner>div:first-child>h5:first-of-type {
            padding-top: 0 !important
        }

        #template-customizer .template-customizer-themes-inner {
            position: relative;
            opacity: 1;
            -webkit-transition: opacity .2s;
            -o-transition: opacity .2s;
            transition: opacity .2s
        }

        #template-customizer .template-customizer-theme-item {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -ms-flex-align: center;
            -webkit-box-flex: 1;
            -ms-flex: 1 1 100%;
            flex: 1 1 100%;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 0 24px;
            width: 100%;
            cursor: pointer
        }

        #template-customizer .template-customizer-theme-item input {
            position: absolute;
            z-index: -1;
            opacity: 0
        }

        #template-customizer .template-customizer-theme-item input~span {
            opacity: .25;
            -webkit-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s
        }

        #template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark {
            display: inline-block;
            width: 6px;
            height: 12px;
            border-right: 1px solid;
            border-bottom: 1px solid;
            opacity: 0;
            -webkit-transition: all .2s;
            -o-transition: all .2s;
            transition: all .2s;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg)
        }

        [dir=rtl] #template-customizer .template-customizer-theme-item .template-customizer-theme-checkmark {
            border-right: none;
            border-left: 1px solid;
            -webkit-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            transform: rotate(-45deg)
        }

        #template-customizer .template-customizer-theme-item input:checked:not([disabled])~span,
        #template-customizer .template-customizer-theme-item:hover input:not([disabled])~span {
            opacity: 1
        }

        #template-customizer .template-customizer-theme-item input:checked:not([disabled])~span .template-customizer-theme-checkmark {
            opacity: 1
        }

        #template-customizer .template-customizer-theme-colors span {
            display: block;
            margin: 0 1px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, .1) inset;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, .1) inset
        }

        #template-customizer.template-customizer-loading .template-customizer-inner,
        #template-customizer.template-customizer-loading-theme .template-customizer-themes-inner {
            opacity: .2
        }

        #template-customizer.template-customizer-loading .template-customizer-inner::after,
        #template-customizer.template-customizer-loading-theme .template-customizer-themes-inner::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 999;
            display: block
        }

        @media(max-width: 1200px) {
            #template-customizer {
                display: none;
                visibility: hidden !important
            }
        }

        @media(max-width: 575.98px) {
            #template-customizer {
                width: 300px;
                -webkit-transform: translateX(320px);
                -ms-transform: translateX(320px);
                transform: translateX(320px)
            }
        }

        .layout-menu-100vh #template-customizer {
            height: 100vh
        }

        [dir=rtl] #template-customizer {
            right: auto;
            left: 0;
            -webkit-transform: translateX(-420px);
            -ms-transform: translateX(-420px);
            transform: translateX(-420px)
        }

        [dir=rtl] #template-customizer .template-customizer-open-btn {
            right: 0;
            left: auto;
            -webkit-transform: translateX(58px);
            -ms-transform: translateX(58px);
            transform: translateX(58px)
        }

        [dir=rtl] #template-customizer .template-customizer-close-btn {
            right: auto;
            left: 0
        }

        #template-customizer .template-customizer-layouts-options[disabled] {
            opacity: .5;
            pointer-events: none
        }

        [dir=rtl] .template-customizer-t-style_switch_light {
            padding-right: 0 !important
        }
    </style> --}}
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <style>
        ._button_10caf_25 {
            border-radius: 8px;
            border: unset;
            cursor: pointer;
            transition: .3s
        }

        ._button_10caf_25:disabled {
            opacity: .3;
            cursor: not-allowed
        }

        ._button_default_10caf_35 {
            background: transparent;
            color: #43434e
        }

        ._button_default_10caf_35:hover {
            background: #f3f4f7
        }

        ._button_default_10caf_35:active {
            background: #8e8e8e
        }

        ._button_default_10caf_35 ._svg_10caf_45 * {
            fill: #43434e
        }

        ._button_primary_10caf_48 {
            background: #007eff;
            color: #fff
        }

        ._button_primary_10caf_48:hover {
            background: #3398ff
        }

        ._button_primary_10caf_48:active {
            background: #66b2ff
        }

        ._button_primary_10caf_48 ._svg_10caf_45 * {
            fill: #fff
        }

        ._button_link_10caf_61 {
            background: transparent;
            color: #007eff
        }

        ._button_link_10caf_61:hover {
            color: #3398ff
        }

        ._button_link_10caf_61:active {
            color: #66b2ff
        }

        ._button_link_10caf_61 ._svg_10caf_45 * {
            fill: #007eff
        }

        ._button_link_10caf_61 ._svg_10caf_45 *:hover {
            fill: #3398ff
        }

        ._button_link_10caf_61 ._svg_10caf_45 *:active {
            fill: #66b2ff
        }

        ._button_large_10caf_80 {
            padding: 12px 16px
        }

        ._button_large_10caf_80 * {
            font-size: 16px
        }

        ._button_medium_10caf_86 {
            padding: 8px 16px
        }

        ._button_medium_10caf_86 * {
            font-size: 16px
        }

        ._button_small_10caf_92 {
            padding: 4px;
            min-height: 24px
        }

        ._button_small_10caf_92 * {
            font-size: 12px
        }

        ._flexBox_9xdww_14 {
            flex-flow: unset
        }

        ._gap_extraTiny_9xdww_18 {
            gap: 2px
        }

        ._gap_tiny_9xdww_22 {
            gap: 4px
        }

        ._gap_extraSmall_9xdww_26 {
            gap: 6px
        }

        ._gap_small_9xdww_30 {
            gap: 8px
        }

        ._gap_medium_9xdww_34 {
            gap: 16px
        }

        ._gap_normal_9xdww_38 {
            gap: 24px
        }

        ._gap_large_9xdww_42 {
            gap: 32px
        }

        ._gap_xLarge_9xdww_46 {
            gap: 48px
        }

        ._gap_xxLarge_9xdww_50 {
            gap: 56px
        }

        ._gap_extraLarge_9xdww_54 {
            gap: 64px
        }

        ._column_9xdww_58 {
            flex-direction: column !important
        }

        ._flexWrap_9xdww_62 {
            flex-wrap: wrap
        }

        ._popover_12uvb_1 {
            position: fixed;
            padding: 8px 10px;
            z-index: 2147483647;
            background: #31363de6;
            border-radius: 4px;
            color: #fff;
            font-size: 14px
        }

        ._buttons_12uvb_11 {
            position: fixed;
            top: 0;
            right: 0;
            padding: 8px;
            z-index: 2147483647
        }

        ._popup_hcu7e_1 {
            position: fixed;
            z-index: 2147483649;
            background: #ffffffe6;
            border-radius: 4px;
            color: #000;
            font-size: 14px;
            line-height: 1.286;
            width: 350px;
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px);
            box-shadow: 0 0 7px -5px #000
        }

        ._popup_hcu7e_1:before {
            border-color: rgba(255, 255, 255, .9) transparent;
            border-width: 0 7px 7px 7px;
            left: 7px;
            top: -7px;
            border-style: solid;
            content: ".";
            display: block;
            height: 0;
            position: absolute;
            text-indent: -30000px;
            width: 0
        }

        ._color_hcu7e_27 {
            width: 20px;
            height: 20px;
            cursor: pointer;
            flex-shrink: 0
        }

        ._styleContainer_hcu7e_34 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        ._extraTiny_dg7lc_14 {
            padding: 2px
        }

        ._extraTinyVR_dg7lc_18 {
            padding-top: 2px;
            padding-bottom: 2px
        }

        ._extraTinyHR_dg7lc_23 {
            padding-left: 2px;
            padding-right: 2px
        }

        ._extraTinyTop_dg7lc_28 {
            padding-top: 2px
        }

        ._extraTinyRight_dg7lc_32 {
            padding-right: 2px
        }

        ._extraTinyBottom_dg7lc_36 {
            padding-bottom: 2px
        }

        ._extraTinyLeft_dg7lc_40 {
            padding-left: 2px
        }

        ._tiny_dg7lc_44 {
            padding: 4px
        }

        ._tinyVR_dg7lc_48 {
            padding-top: 4px;
            padding-bottom: 4px
        }

        ._tinyHR_dg7lc_53 {
            padding-left: 4px;
            padding-right: 4px
        }

        ._tinyTop_dg7lc_58 {
            padding-top: 4px
        }

        ._tinyRight_dg7lc_62 {
            padding-right: 4px
        }

        ._tinyBottom_dg7lc_66 {
            padding-bottom: 4px
        }

        ._tinyLeft_dg7lc_70 {
            padding-left: 4px
        }

        ._extraSmall_dg7lc_74 {
            padding: 6px
        }

        ._extraSmallVR_dg7lc_78 {
            padding-top: 6px;
            padding-bottom: 6px
        }

        ._extraSmallHR_dg7lc_83 {
            padding-left: 6px;
            padding-right: 6px
        }

        ._extraSmallTop_dg7lc_88 {
            padding-top: 6px
        }

        ._extraSmallRight_dg7lc_92 {
            padding-right: 6px
        }

        ._extraSmallBottom_dg7lc_96 {
            padding-bottom: 6px
        }

        ._extraSmallLeft_dg7lc_100 {
            padding-left: 6px
        }

        ._small_dg7lc_104 {
            padding: 8px
        }

        ._smallVR_dg7lc_108 {
            padding-top: 8px;
            padding-bottom: 8px
        }

        ._smallHR_dg7lc_113 {
            padding-left: 8px;
            padding-right: 8px
        }

        ._smallTop_dg7lc_118 {
            padding-top: 8px
        }

        ._smallRight_dg7lc_122 {
            padding-right: 8px
        }

        ._smallBottom_dg7lc_126 {
            padding-bottom: 8px
        }

        ._smallLeft_dg7lc_130 {
            padding-left: 8px
        }

        ._medium_dg7lc_134 {
            padding: 16px
        }

        ._mediumVR_dg7lc_138 {
            padding-top: 16px;
            padding-bottom: 16px
        }

        ._mediumHR_dg7lc_143 {
            padding-left: 16px;
            padding-right: 16px
        }

        ._mediumTop_dg7lc_148 {
            padding-top: 16px
        }

        ._mediumRight_dg7lc_152 {
            padding-right: 16px
        }

        ._mediumBottom_dg7lc_156 {
            padding-bottom: 16px
        }

        ._mediumLeft_dg7lc_160 {
            padding-left: 16px
        }

        ._normal_dg7lc_164 {
            padding: 24px
        }

        ._normalVR_dg7lc_168 {
            padding-top: 24px;
            padding-bottom: 24px
        }

        ._normalHR_dg7lc_173 {
            padding-left: 24px;
            padding-right: 24px
        }

        ._normalTop_dg7lc_178 {
            padding-top: 24px
        }

        ._normalRight_dg7lc_182 {
            padding-right: 24px
        }

        ._normalBottom_dg7lc_186 {
            padding-bottom: 24px
        }

        ._normalLeft_dg7lc_190 {
            padding-left: 24px
        }

        ._large_dg7lc_194 {
            padding: 32px
        }

        ._largeVR_dg7lc_198 {
            padding-top: 32px;
            padding-bottom: 32px
        }

        ._largeHR_dg7lc_203 {
            padding-left: 32px;
            padding-right: 32px
        }

        ._largeTop_dg7lc_208 {
            padding-top: 32px
        }

        ._largeRight_dg7lc_212 {
            padding-right: 32px
        }

        ._largeBottom_dg7lc_216 {
            padding-bottom: 32px
        }

        ._largeLeft_dg7lc_220 {
            padding-left: 32px
        }

        ._xLarge_dg7lc_224 {
            padding: 48px
        }

        ._xLargeVR_dg7lc_228 {
            padding-top: 48px;
            padding-bottom: 48px
        }

        ._xLargeHR_dg7lc_233 {
            padding-left: 48px;
            padding-right: 48px
        }

        ._xLargeTop_dg7lc_238 {
            padding-top: 48px
        }

        ._xLargeRight_dg7lc_242 {
            padding-right: 48px
        }

        ._xLargeBottom_dg7lc_246 {
            padding-bottom: 48px
        }

        ._xLargeLeft_dg7lc_250 {
            padding-left: 48px
        }

        ._xxLarge_dg7lc_254 {
            padding: 56px
        }

        ._xxLargeVR_dg7lc_258 {
            padding-top: 56px;
            padding-bottom: 56px
        }

        ._xxLargeHR_dg7lc_263 {
            padding-left: 56px;
            padding-right: 56px
        }

        ._xxLargeTop_dg7lc_268 {
            padding-top: 56px
        }

        ._xxLargeRight_dg7lc_272 {
            padding-right: 56px
        }

        ._xxLargeBottom_dg7lc_276 {
            padding-bottom: 56px
        }

        ._xxLargeLeft_dg7lc_280 {
            padding-left: 56px
        }

        ._extraLarge_dg7lc_284 {
            padding: 64px
        }

        ._extraLargeVR_dg7lc_288 {
            padding-top: 64px;
            padding-bottom: 64px
        }

        ._extraLargeHR_dg7lc_293 {
            padding-left: 64px;
            padding-right: 64px
        }

        ._extraLargeTop_dg7lc_298 {
            padding-top: 64px
        }

        ._extraLargeRight_dg7lc_302 {
            padding-right: 64px
        }

        ._extraLargeBottom_dg7lc_306 {
            padding-bottom: 64px
        }

        ._extraLargeLeft_dg7lc_310 {
            padding-left: 64px
        }

        ._size_tiny_ldink_23,
        ._size_tiny_ldink_23 * {
            font-size: 12px
        }

        ._size_small_ldink_27,
        ._size_small_ldink_27 * {
            font-size: 16px
        }

        ._size_medium_ldink_31,
        ._size_medium_ldink_31 * {
            font-size: 18px
        }

        ._size_large_ldink_35,
        ._size_large_ldink_35 * {
            font-size: 32px
        }

        ._weight_thin_ldink_39,
        ._weight_thin_ldink_39 * {
            font-weight: 100
        }

        ._weight_extraLight_ldink_43,
        ._weight_extraLight_ldink_43 * {
            font-weight: 200
        }

        ._weight_light_ldink_47,
        ._weight_light_ldink_47 * {
            font-weight: 300
        }

        ._weight_normal_ldink_51,
        ._weight_normal_ldink_51 * {
            font-weight: 400
        }

        ._weight_medium_ldink_55,
        ._weight_medium_ldink_55 * {
            font-weight: 500
        }

        ._weight_semiBold_ldink_59,
        ._weight_semiBold_ldink_59 * {
            font-weight: 600
        }

        ._weight_bold_ldink_63,
        ._weight_bold_ldink_63 * {
            font-weight: 700
        }

        ._weight_extraBold_ldink_67,
        ._weight_extraBold_ldink_67 * {
            font-weight: 800
        }

        ._lineHeight_ldink_71 {
            line-height: 100%
        }

        ._secondary_ldink_75 {
            color: #8e8e8e
        }

        ._modal_ib2ay_25 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2147483649
        }

        ._modal_ib2ay_25 ._background_ib2ay_36 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: .3s;
            opacity: 0;
            overflow: auto;
            background-color: color-mix(in srgb, #000000 60%, white 0%);
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px)
        }

        ._modal_ib2ay_25 ._window_ib2ay_48 {
            min-width: 280px;
            max-width: 560px;
            background: #fff;
            border-radius: 6px;
            padding: 16px;
            z-index: 1;
            position: relative;
            opacity: 0;
            transform: scale(.01);
            transition: .3s;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 6px 2px #00000026, 0 1px 2px #0000004d;
            overflow: auto
        }

        ._modal_ib2ay_25 ._window_ib2ay_48 ._loading_ib2ay_64 {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: #000000b3
        }

        ._modal_ib2ay_25 ._window_ib2ay_48 ._loading_ib2ay_64 img {
            width: 100px
        }

        ._modal_visible_ib2ay_76 ._background_ib2ay_36 {
            opacity: 1
        }

        ._modal_visible_ib2ay_76 ._window_ib2ay_48 {
            opacity: 1;
            transform: scale(1)
        }

        ._modal_hidden_ib2ay_83 ._background_ib2ay_36 {
            opacity: 0
        }

        ._modal_hidden_ib2ay_83 ._window_ib2ay_48 {
            opacity: 0;
            transform: scale(.01)
        }

        ._modal_hiddenDone_ib2ay_90 ._background_ib2ay_36 {
            opacity: 0
        }

        ._modal_hiddenDone_ib2ay_90 ._window_ib2ay_48 {
            opacity: 0;
            transform: scale(.01)
        }

        ._color_13dyv_1 {
            padding: 0 8px;
            border-radius: 8px;
            width: 100%;
            box-shadow: 0 0 7px -5px #000;
            font-weight: 800;
            flex-shrink: 0
        }
    </style>
</head>

<body>


    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Content -->

    <!-- Not Authorized -->
    <div class="container-xxl container-p-y">

    </div>
    <!-- /Not Authorized -->

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->



    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>


    <!-- Page JS -->

</body>

</html>
