# Contao CORS

This Contao 4.x bundle was developed to extend the CMS by supporting control of CORS headers on frontend.

## Limit Access

By default this plugin is accepting requests on behalf of any domain. However, this is significantly weaking security of your website and thus you should explicitly lists all domains that might access your website in `app/config/parameters.yml` by adding this parameter:

```yaml
parameters:
    ...
    cors.domains:
        - http://example.com
        - http://www.example.com
        - https://secure.example.com
```
