# Xml To Json Plugin
The **Xml To Json** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Plugin allows to get data from xml file and transfer it to JSON object.

## Installation
### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `xml-to-json`. You can find these files on [GitHub](https://github.com/pawelsla/grav-plugin-xml-to-json).

You should now have all the plugin files under

    /your/site/grav/user/plugins/xml-to-json
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/pawelsla/grav-plugin-xml-to-json/blueprints.yaml).

## Configuration

Before configuring this plugin, you should copy the `user/plugins/xml-to-json/xml-to-json.yaml` to `user/config/plugins/xml-to-json.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

| Variable | Default | Options         | Note                    |
| --------:| -------:| -------:        | :----                   |
| enabled  | true    |`true` or `false`|                         |
| query    |         | string          | your API's search query |
| key      |         | string          | your API's auth key     |
| url      |         | string          | your API's url          |  

Note that if you use the Admin Plugin, a file with your configuration named xml-to-json.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

You can use this plugin to get XML data when is authorized with `apiKey` and  parametrized with `query` also, so path to XML data file is constructed like this, i.e. `"YOUR_API_URL?key=YOUR_KEY&q=QUERY"`syntax. If it has different syntax you must change `$path` variable definition in `onTwigPageVariables()` function from **xml-to-json.php**. 

If you want to use this plugin in Twig files, you should create in this files ```
{% block javascripts %}
<script>
{% set JSON = api %}; // set access to your data transfer
console.log({{ JSON }}) //returns JSON encode your data from API
{#...

In this place, you can create array from your API's request response using Array.from({{ JSON }}) JS method as JS constants (const) or variables (let, var). Then you can use API methods on created Javascript Object. 

...#}
</script>
{% endblock %}```

### Testing
This plugin was testing with [Goodreads](https://www.goodreads.com/api) API.
