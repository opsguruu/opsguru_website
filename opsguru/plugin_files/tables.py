import django_tables2 as tables
from netbox.tables import NetBoxTable, ChoiceFieldColumn
from .models import LinkSet, LinkSetRTM

class LinkSetTable(NetBoxTable):
    link_set_name = tables.Column(linkify=True)

    class Meta(NetBoxTable.Meta):
        model = LinkSet
        fields = (
            'pk', 'id', 'link_set_name', 'customer', 'country_abbreviation',
            'country', 'loc', 'link' ,'capacity', 'msucapacity'
        )
        default_columns = ('link_set_name', 'customer', 'msucapacity')


class LinkSetTable_rtm(NetBoxTable):
    link_set_name = tables.Column(linkify=True)

    class Meta(NetBoxTable.Meta):
        model = LinkSetRTM
        fields = (
            'pk', 'id', 'link_set_name', 'customer', 'country_abbreviation',
            'country', 'loc', 'link' ,'capacity', 'msucapacity'
        )
        default_columns = ('link_set_name', 'customer', 'msucapacity')
