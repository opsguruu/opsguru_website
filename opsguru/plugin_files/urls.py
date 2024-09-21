from django.urls import path
from . import models, views
from netbox.views.generic import ObjectChangeLogView

urlpatterns = (
    # LinkSets
    path('linksets/', views.LinkSetListView.as_view(), name='linkset_list'),
    path('linksets/add/', views.LinkSetEditView.as_view(), name='linkset_add'),
    path('linksets/<int:pk>/', views.LinkSetView.as_view(), name='linkset'),
    path('update-linksets/', views.update_linksets, name='update_linksets'),
    path('linksets/<int:pk>/edit/', views.LinkSetEditView.as_view(), name='linkset_edit'),
    path('linksets/<int:pk>/delete/', views.LinkSetDeleteView.as_view(), name='linkset_delete'),
    path('linksets/<int:pk>/changelog/', ObjectChangeLogView.as_view(), name='linkset_changelog', kwargs={
        'model': models.LinkSet
    }),

    path('linksets_rtm/', views.LinkSetListView_rtm.as_view(), name='linkset_list_rtm'),
    path('linksets_rtm/add/', views.LinkSetEditView_rtm.as_view(), name='linkset_add_rtm'),
    path('linksets_rtm/<int:pk>/', views.LinkSetView.as_view(), name='linkset_rtm'),
    path('update-linksets_rtm/', views.update_linksets, name='update_linksets_rtm'),
    path('linksets_rtm/<int:pk>/edit/', views.LinkSetEditView_rtm.as_view(), name='linkset_edit_rtm'),
    path('linksets_rtm/<int:pk>/delete/', views.LinkSetDeleteView_rtm.as_view(), name='linkset_delete_rtm'),
    path('linksets_rtm/<int:pk>/changelog/', ObjectChangeLogView.as_view(), name='linkset_changelog_rtm', kwargs={
        'model': models.LinkSet
    }),
)
