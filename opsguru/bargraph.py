import openpyxl
from openpyxl.chart import BarChart, Reference
import win32com.client as win32
import os

# Create a workbook and add a worksheet
wb = openpyxl.Workbook()
ws = wb.active
ws.title = "Data"

# Sample data
data = [
    ['Category', 'Sales'],
    ['A', 30],
    ['B', 40],
    ['C', 50],
    ['D', 20],
]

# Adding data to the worksheet
for row in data:
    ws.append(row)

# Create a BarChart
chart = BarChart()
chart.title = "Sales by Category"
chart.x_axis.title = "Category"
chart.y_axis.title = "Sales"

# Define data for the chart (including categories and values)
categories = Reference(ws, min_col=1, min_row=2, max_row=5)
values = Reference(ws, min_col=2, min_row=1, max_row=5)
chart.add_data(values, titles_from_data=True)
chart.set_categories(categories)

# Add the chart to the worksheet
ws.add_chart(chart, "E5")  # Position of the chart

# Save the workbook
excel_file = "bar_chart.xlsx"
wb.save(excel_file)

# Open Excel application
excel = win32.Dispatch('Excel.Application')
excel.Visible = False

# Open the Excel file
wb = excel.Workbooks.Open(os.path.abspath(excel_file))
ws = wb.Worksheets("Data")

# Access the chart
chart = ws.ChartObjects(1)  # Index of the chart in the worksheet

# Save the chart as a PNG image
chart.Chart.Export(os.path.abspath("bar_chart.png"))

# Close the workbook and quit Excel
wb.Close(False)
excel.Quit()

# Path to the image file
image_file = os.path.abspath("bar_chart.png")

# Outlook application
outlook = win32.Dispatch('outlook.application')

# Create a new mail item
mail = outlook.CreateItem(0)

# Set the email properties
mail.Subject = "Bar Chart Image"
mail.Body = "Hi Team,\n\nPlease find the attached bar chart image.\n\nBest regards,\n[Your Name]"
mail.To = "group@example.com"  # Replace with your group's email
mail.CC = "cc@example.com"     # Optional: Replace with any CC email addresses
mail.BCC = "bcc@example.com"   # Optional: Replace with any BCC email addresses

# Attach the image file
mail.Attachments.Add(image_file)

# Send the email
mail.Send()

print("Email sent successfully.")