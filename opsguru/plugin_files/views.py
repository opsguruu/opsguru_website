from netbox.views import generic
from . import forms, models, tables
from django.db.models import Count
import requests, json
from django.http import JsonResponse, HttpResponseRedirect
from django.views.decorators.csrf import csrf_exempt
from django.db import connection

class LinkSetView(generic.ObjectView):
    def get(self, request, *args, **kwargs):
        # Fetch and save linksets before rendering the view
        self.fetch_and_save_linksets()
        return super().get(request, *args, **kwargs)

    queryset = models.LinkSet.objects.all()

class LinkSetListView(generic.ObjectListView):
    queryset = models.LinkSet.objects.all()
    table = tables.LinkSetTable

class LinkSetEditView(generic.ObjectEditView):
    queryset = models.LinkSet.objects.all()
    form = forms.LinkSetForm

class LinkSetDeleteView(generic.ObjectDeleteView):
    queryset = models.LinkSet.objects.all()

@csrf_exempt
def update_linksets(request):
    url = 'http://10.5.140.26:8181/api/data/linksets/all'
    try:
        response = requests.get(url, auth=('brix', 'brix@$432'))
        response.raise_for_status()  # Check for HTTP errors

        response_text = response.text
        json_objects = response_text.split('}{')

        # Delete existing data in the table
        with connection.cursor() as cursor:
            cursor.execute("DELETE FROM netbox_linksets_linkset")  # Replace `yourapp_linkset` with your actual table name

        # Insert new data
        for json_obj in json_objects:
            json_obj = f'{{{json_obj}}}'  # Re-wrap the JSON object
            try:
                linkset = json.loads(json_obj)

                # Ensure correct JSON format
                def transform_value(value):
                    if value is None:
                        return 'null'
                    elif isinstance(value, str):
                        return f'"{value}"'
                    elif isinstance(value, (int, float, bool)):
                        return str(value).lower()
                    else:
                        return value

                link_set_name = transform_value(linkset.get("link_set_name", "N/A"))
                customer = transform_value(linkset.get("customer", "N/A"))
                country_abbreviation = transform_value(linkset.get("country_abbre", "N/A"))
                country = transform_value(linkset.get("country", "N/A"))
                loc = transform_value(linkset.get("loc", "N/A"))
                link = transform_value(linkset.get("link", "N/A"))
                capacity = transform_value(linkset.get("capacity", "N/A"))
                msucapacity = transform_value(linkset.get("msu_capacity", "N/A"))
                custom_field_data = 'false'

                with connection.cursor() as cursor:
                    cursor.execute("""
                        INSERT INTO netbox_linksets_linkset (link_set_name, customer, country_abbreviation, country, loc,link,capacity,msucapacity,  custom_field_data)
                        VALUES (%s, %s, %s, %s, %s, %s,%s,%s,%s)
                    """, [link_set_name, customer, country_abbreviation, country, loc, link,capacity, msucapacity, custom_field_data])
                    
            except json.JSONDecodeError:
                print("Error parsing JSON object.")


        return HttpResponseRedirect('/plugins/link-sets/linksets/')

    except requests.exceptions.RequestException as e:
        return JsonResponse({"status": "error", "message": str(e)})
    

# RTM TABLE LIST
class LinkSetView_rtm(generic.ObjectView):
    def get(self, request, *args, **kwargs):
        # Fetch and save linksets before rendering the view
        self.fetch_and_save_linksets()
        return super().get(request, *args, **kwargs)

    queryset = models.LinkSetRTM.objects.all()

class LinkSetListView_rtm(generic.ObjectListView):
    queryset = models.LinkSetRTM.objects.all()
    table = tables.LinkSetTable_rtm

class LinkSetEditView_rtm(generic.ObjectEditView):
    queryset = models.LinkSetRTM.objects.all()
    form = forms.LinkSetForm_rtm

class LinkSetDeleteView_rtm(generic.ObjectDeleteView):
    queryset = models.LinkSetRTM.objects.all()


@csrf_exempt
def update_linksets_rtm(request):
    url = 'http://10.5.140.26:8181/api/data/linksets/all'
    try:
        response = requests.get(url, auth=('brix', 'brix@$432'))
        response.raise_for_status()  # Check for HTTP errors

        response_text = response.text
        json_objects = response_text.split('}{')

        # Delete existing data in the table
        with connection.cursor() as cursor:
            cursor.execute("DELETE FROM netbox_linksets_linksetrtm")  # Replace `yourapp_linkset` with your actual table name

        # Insert new data
        for json_obj in json_objects:
            json_obj = f'{{{json_obj}}}'  # Re-wrap the JSON object
            try:
                linkset = json.loads(json_obj)

                # Ensure correct JSON format
                def transform_value(value):
                    if value is None:
                        return 'null'
                    elif isinstance(value, str):
                        return f'"{value}"'
                    elif isinstance(value, (int, float, bool)):
                        return str(value).lower()
                    else:
                        return value

                link_set_name = transform_value(linkset.get("link_set_name", "N/A"))
                customer = transform_value(linkset.get("customer", "N/A"))
                country_abbreviation = transform_value(linkset.get("country_abbre", "N/A"))
                country = transform_value(linkset.get("country", "N/A"))
                loc = transform_value(linkset.get("loc", "N/A"))
                link = transform_value(linkset.get("link", "N/A"))
                capacity = transform_value(linkset.get("capacity", "N/A"))
                msucapacity = transform_value(linkset.get("msu_capacity", "N/A"))
                custom_field_data = 'false'

                with connection.cursor() as cursor:
                    cursor.execute("""
                        INSERT INTO netbox_linksets_linksetrtm (link_set_name, customer, country_abbreviation, country, loc,link,capacity,msucapacity, custom_field_data)
                        VALUES (%s, %s, %s, %s, %s, %s,%s,%s,%s)
                    """, [link_set_name, customer, country_abbreviation, country, loc,link,capacity,msucapacity, custom_field_data])
                    
            except json.JSONDecodeError:
                print("Error parsing JSON object.")


        return HttpResponseRedirect('/plugins/link-sets/linksets_rtm/')

    except requests.exceptions.RequestException as e:
        return JsonResponse({"status": "error", "message": str(e)})
    