from netbox.views import generic
from django.db.models import Count
from . import forms, models, tables
import requests
import json

class AccessLinksetView(generic.ObjectView):
    queryset = models.Linksets.objects.all()
    
    def fetch_and_save_linksets(self):
        url = 'http://10.5.140.26:8181/api/data/linksets/all'
        
        try:
            response = requests.get(url, auth=('brix', 'brix@$432'))
            response.raise_for_status()  # Check for HTTP errors

            response_text = response.text
            json_objects = response_text.split('}{')

            for i, json_obj in enumerate(json_objects, start=1):
                json_obj = f'{{{json_obj}}}'  # Re-wrap the JSON object
                try:
                    linkset = json.loads(json_obj)
                    linksets_data = models.Linksets(
                        link_set_name=linkset.get("link_set_name", "N/A"),
                        asd_stp2_stp5_stp6=linkset.get("asd_stp2_stp5_stp6", "N/A"),
                        asd_stp_1st_secondary_pc=linkset.get("asd_stp_1st_secondary_pc", "N/A"),
                        asd_stp_2nd_secondary_pc=linkset.get("asd_stp_2nd_secondary_pc", "N/A"),
                        lsl=linkset.get("lsl", "N/A"),
                    )
                    linksets_data.save()
                except json.JSONDecodeError:
                    print(f"Error parsing JSON object {i}.")
        except requests.exceptions.RequestException as e:
            print(f"Error fetching data from {url}: {e}")

    def get(self, request, *args, **kwargs):
        # Fetch and save linksets before rendering the view
        self.fetch_and_save_linksets()
        return super().get(request, *args, **kwargs)

class AccessLinksetListView(generic.ObjectListView):
    queryset = models.Linksets.objects.all()
    table = tables.AccessLinksetsTable

class AccessLinksetEditView(generic.ObjectEditView):
    queryset = models.Linksets.objects.all()
    form = forms.AccessListForm

class AccessLinksetDeleteView(generic.ObjectDeleteView):
    queryset = models.Linksets.objects.all()