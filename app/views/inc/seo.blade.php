<!-- Twitter Graph -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@{{{ Config::get('site.twitter') }}}" />
<meta name="twitter:creator" content="@{{{ Config::get('site.creator') }}}" />
<!-- /Twitter Graph -->
<meta property="fb:admins" content="{{ Config::get('site.fb_admin')}}" />
<meta property="fb:app_id" content="{{ Config::get('site.fb_id')}}" />
<meta property="og:locale" content="ht_HT" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="{{ Config::get('site.name') }}" />


@section('seo')

<link rel="canonical" href="{{ Config::get('site.url') }}" />

<!-- Open Graph -->
<meta property="og:url" content="{{ Config::get('site.url') }}" />
<meta property="og:title" content="{{ Config::get('site.name') . ' &mdash; ' . Config::get('site.description') }}" />
<meta property="og:description" content="{{ Config::get('site.description') }}" />
<meta property="og:image" content="{{ TKPM::asset(Config::get('site.logo')) }}" />
<!-- / Open Graph -->
@show