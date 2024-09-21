from django.contrib.postgres.fields import ArrayField
from django.db import models
from netbox.models import NetBoxModel



class Linksets(NetBoxModel):
    link_set_name = models.CharField(max_length=100, blank=True, null=True)  # Increased length for names
    asd_stp2_stp5_stp6 = models.CharField(max_length=50, blank=True, null=True)  # Increased length for category
    asd_stp_1st_secondary_pc = models.TextField(blank=True, null=True)  # Changed to TextField for long text
    asd_stp_2nd_secondary_pc = models.CharField(max_length=50, blank=True, null=True)  # Increased length for region
    lsl = models.CharField(max_length=50, blank=True, null=True)  # Ensure slug is unique

    class Meta:
        ordering = ('link_set_name',)
       
    def __str__(self):
        return self.link_set_name
