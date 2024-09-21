from django.urls import path
from . import views

urlpatterns = [
    path('linksets/', views.AccessLinksetListView.as_view(), name='linkset_list'),
    path('linksets/<int:pk>/', views.AccessLinksetView.as_view(), name='linkset_detail'),
    path('linksets/add/', views.AccessLinksetEditView.as_view(), name='linkset_add'),
    path('linksets/<int:pk>/edit/', views.AccessLinksetEditView.as_view(), name='linkset_edit'),
    path('linksets/<int:pk>/delete/', views.AccessLinksetDeleteView.as_view(), name='linkset_delete'),
]
