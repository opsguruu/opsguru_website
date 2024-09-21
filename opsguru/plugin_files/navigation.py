from netbox.plugins import PluginMenuItem, PluginMenuButton

from netbox.choices import ButtonColorChoices

accesslist_buttons = [
    PluginMenuButton(
        link='plugins:netbox_linksets:update_linksets',
        title='Refresh',
        icon_class='mdi mdi-refresh',
    )
]

accesslist_rtm_buttons = [
    PluginMenuButton(
        link='plugins:netbox_linksets:update_linksets',
        title='Refresh',
        icon_class='mdi mdi-refresh',
    )
]

menu_items = (
    PluginMenuItem(
        link='plugins:netbox_linksets:linkset_list',
        link_text='Linksets ASD',
        buttons=accesslist_buttons
    ),
    PluginMenuItem(
        link='plugins:netbox_linksets:linkset_list_rtm',
        link_text='Linksets RTM',
        buttons=accesslist_rtm_buttons
    )
)

