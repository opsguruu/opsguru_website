from netbox.forms import NetBoxModelForm
from .models import LinkSet, LinkSetRTM
from utilities.forms.fields import CommentField, DynamicModelChoiceField
from ipam.models import Prefix

class LinkSetForm(NetBoxModelForm):
    comments = CommentField()

    class Meta:
        model = LinkSet
        fields = (
            'link_set_name', 'customer', 'country_abbreviation',
            'country', 'loc', 'link' ,'capacity', 'msucapacity', 'comments'
        )

class LinkSetForm_rtm(NetBoxModelForm):
    comments = CommentField()

    class Meta:
        model = LinkSetRTM
        fields = (
            'link_set_name', 'customer', 'country_abbreviation',
            'country', 'loc', 'link' ,'capacity', 'msucapacity', 'comments'
        )
