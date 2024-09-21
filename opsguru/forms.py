from netbox.forms import NetBoxModelForm
from .models import Linksets
from utilities.forms.fields import CommentField


class AccessLinkesetForm(NetBoxModelForm):
    comments = CommentField()

    class Meta:
        model = Linksets
        fields = (
            'id', 'link_set_name' , 'asd_stp2_stp5_stp6' , 'asd_stp_1st_secondary_pc' , 'lsl', 'asd_stp_2nd_secondary_pc', 'comments'
        )
