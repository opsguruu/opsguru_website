import pandas as pd
import matplotlib.pyplot as plt

# Load the Excel file
file_path = 'test.xlsx'  # Update with your actual file path
df = pd.read_excel(file_path, sheet_name='sample')

# Convert the 'Date' column to datetime format
df['Date'] = pd.to_datetime(df['Date'])

# Remove commas from the numeric columns and convert them to integers
df['Passed'] = df['Passed'].str.replace(',', '').astype(int)
df['Blocked'] = df['Blocked'].str.replace(',', '').astype(int)

# Plot the data
plt.figure(figsize=(10, 6))
plt.plot(df['Date'], df['Passed'], label='Passed', color='blue')
plt.plot(df['Date'], df['Blocked'], label='Blocked', color='red')

# Add title and labels
plt.title('CLEC Data')
plt.xlabel('Date')
plt.ylabel('Counts')
plt.legend()

# Save the graph as a PNG file
output_path = '/mnt/data/clec_data_graph.png'
plt.savefig(output_path, format='png')

# Show the saved file path
print(f'Graph saved as: {output_path}')
