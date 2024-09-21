import django_tables2 as tables
from netbox.tables import NetBoxTable
from .models import Linksets

class AccessLinksetsTable(NetBoxTable):
    name = tables.Column(linkify=True)
    class Meta(NetBoxTable.Meta):
        model = Linksets
        fields = (
            'link_set_name' , 'asd_stp2_stp5_stp6' , 'asd_stp_1st_secondary_pc' , 'lsl', 'asd_stp_2nd_secondary_pc'
        )
        default_columns = ('link_set_name', 'asd_stp2_stp5_stp6')
