from extras.plugins import PluginConfig
# 4.0.5
# from netbox.plugins import PluginConfig

class NetBoxLinksetsConfig(PluginConfig):
    name = 'linksets'
    verbose_name = ' NetBox Linksets Lists'
    description = 'Manage simple Linksets in NetBox'
    version = '0.1'
    base_url = 'access-linksets'


config = NetBoxLinksetsConfig




from netbox.plugins import PluginConfig
class NetBoxLinksetsConfig(PluginConfig):
    name = 'netbox_linksets'
    verbose_name = ' NetBox Linksets Lists'
    description = 'Manage simple ACLs in NetBox'
    version = '0.1'
    base_url = 'access-linksets'
config = NetBoxLinksetsConfig




from setuptools import find_packages, setup

setup(
    name='netbox-access-linksets',
    version='0.1',
    description='An example NetBox plugin',
    install_requires=[],
    packages=find_packages(),
    include_package_data=True,
    zip_safe=False,
)


'netbox_linksets',