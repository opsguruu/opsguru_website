from netbox.plugins import PluginConfig

class NetBoxLinkSetsConfig(PluginConfig):
    name = 'netbox_linksets'
    verbose_name = 'NetBox Link Sets'
    description = 'Manage Link Sets in NetBox'
    version = '0.1'
    base_url = 'link-sets'

config = NetBoxLinkSetsConfig
