@if(setting('chatwoot_enabled') === '1')
    @if(trim((string) setting('chatwoot_script_override', '')) !== '')
        {!! setting('chatwoot_script_override') !!}
    @elseif(trim((string) setting('chatwoot_website_token', '')) !== '')
        <script>
            (function(d,t) {
                var BASE_URL = {!! json_encode(rtrim((string) setting('chatwoot_base_url', 'https://app.chatwoot.com'), '/')) !!};
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.src = BASE_URL + "/packs/js/sdk.js";
                s.parentNode.insertBefore(g, s);
                g.async = true;
                g.onload = function () {
                    window.chatwootSDK.run({
                        websiteToken: {!! json_encode(setting('chatwoot_website_token')) !!},
                        baseUrl: BASE_URL
                    });
                };
            })(document, "script");
        </script>
    @endif
@endif
