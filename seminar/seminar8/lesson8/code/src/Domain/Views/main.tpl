<!DOCTYPE html>
<html>
    <head>
        <title>{{ title }}</title>
    </head>
    <body>
        <!-- {{ xdebug | raw }} -->

        <div id="header">
            {% include "auth-template.tpl" %}
        </div>

        {% include content_template_name %}
    </body>
</html>