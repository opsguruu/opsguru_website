from django.db import models
from netbox.models import NetBoxModel
from utilities.choices import ChoiceSet
from django.urls import reverse

class ActionChoices(ChoiceSet):
    key = 'LinkSetRule.action'
    CHOICES = [
        ('enable', 'Enabled', 'green'),
        ('disabled', 'Disabled', 'red'),
    ]

class ProtocolChoices(ChoiceSet):
    CHOICES = [
        ('asd', 'ASD', 'blue'),
        ('rtm', 'RTM', 'orange'),
    ]

class LinkSet(NetBoxModel):
    link_set_name = models.CharField(max_length=100, blank=True, null=True)
    customer = models.CharField(max_length=50, blank=True, null=True)
    country_abbreviation = models.TextField(blank=True, null=True)
    country = models.CharField(max_length=50, blank=True, null=True)
    loc = models.CharField(max_length=50, blank=True, null=True)
    link = models.CharField(max_length=50, blank=True, null=True)
    capacity = models.CharField(max_length=50, blank=True, null=True)
    msucapacity = models.CharField(max_length=50, blank=True, null=True)

    class Meta:
        ordering = ('link_set_name',)
    
    def get_absolute_url(self):
        return reverse('plugins:netbox_linksets:linkset', args=[self.pk])
    
    def __str__(self):
        return self.link_set_name
    
class LinkSetRTM(NetBoxModel):
    link_set_name = models.CharField(max_length=100, blank=True, null=True)
    customer = models.CharField(max_length=50, blank=True, null=True)
    country_abbreviation = models.TextField(blank=True, null=True)
    country = models.CharField(max_length=50, blank=True, null=True)
    loc = models.CharField(max_length=50, blank=True, null=True)
    link = models.CharField(max_length=50, blank=True, null=True)
    capacity = models.CharField(max_length=50, blank=True, null=True)
    msucapacity = models.CharField(max_length=50, blank=True, null=True)

    class Meta:
        ordering = ('link_set_name',)
    
    def get_absolute_url(self):
        return reverse('plugins:netbox_linksets:linkset_rtm', args=[self.pk])
    
    def __str__(self):
        return self.link_set_name
